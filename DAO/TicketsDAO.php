<?php

namespace DAO;

use Controllers\BaseController;
use \Exception as Exception;
use DAO\IUserDAO as IUserDAO;
use Models\User as User;
use DAO\Connection as Connection;
use Interfaces\ITicketsDAO as ITicketsDAO;

class TicketsDAO implements ITicketsDAO
{
    private $connection;
    private $tableName = "tickets";

    public function LoadOrders($userId, $todayDate)
    {
        $invokeStoredProcedure = 'CALL GetOrdersByUser(?,?)';
        $parameters["UserId"] = $userId;
        $parameters["TodayDate"] = $todayDate; //Cuando viene en null trae todas las compras historicamente

        $this->connection = Connection::GetInstance();
        return $this->connection->Execute($invokeStoredProcedure, $parameters, QueryType::StoredProcedure);
    }

    public function GetSeatsFromTickets($idOrder)
    {
        $seats = "";
        $query = "SELECT tickets.idseatrow,tickets.idseatcol FROM " . $this->tableName .
            " WHERE tickets.idorder = :OrderId";

        $parameters["OrderId"] = $idOrder;

        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

        foreach ($result as $item) {
            $seats += $item;
        }

        return $seats;
    }
}
