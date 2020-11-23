<?php

namespace DAO;

use Controllers\BaseController;
use \Exception as Exception;
use DAO\UserDAO as IUserDAO;
use Models\User as User;
use Models\Ticket as Ticket;
use DAO\Connection as Connection;
use Interfaces\ITicketsDAO as ITicketsDAO;

class TicketsDAO implements ITicketsDAO
{
    private $connection;
    private $tableName = "tickets";

    public function Add($ticket){
        try{
            $query = "INSERT INTO " . $this->tableName . "( Price , IdRoom , IdSeat , IdOrder) VALUES ( :Price , :IdRoom , :IdSeat , :IdOrder);";
            
            
            $parameters ["Price"]    = $ticket->getPrice();
            $parameters ["IdRoom"]   = $ticket->getIdRoom();
            $parameters ["IdSeat"]   = $ticket->getIdSeat();
            $parameters ["IdOrder"]  = $ticket->getIdOrder();
            
            $connection = Connection :: GetInstance();
            $result = $connection->ExecuteNonQuery($query,$parameters,QueryType::Query);

            return $result;
        }   
        catch (Exception $ex){
            throw $ex;
        }
    }
    function Remove($ticket)
	{
		try {
			$query = "DELETE FROM " . $this->tableName . " WHERE IdTicket = " . $ticket->getIdTicket(). ";";

			$parameters["IdTicket"] = $ticket->getIdTicket();

			$connection = Connection::GetInstance();
			$result = $connection->ExecuteNonQuery($query,$parameters,QueryType::Query);
		} catch (Exception $ex) {
			throw $ex;
		}
	}
    public function GetAll()
	{
		try {
			$ticketList = array();
			$query = "SELECT * FROM " . $this->tableName;
			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$ticket = new Ticket();
				$ticket->setIdTicket($row["IdTicket"]);
				$ticket->setPrice($row["Price"]);
                $ticket->setIdRoom($row["IdRoom"]);
                $ticket->setIdSeat($row["IdSeat"]);
                $ticket->setIdOrder($row["IdOrder"]);
				array_push($ticketList, $ticket);
			}
			return $ticketList;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

    public function UpdateTicket($ticket)
	{
		try {
			$query = "UPDATE " . $this->tableName . " SET IdTicket =:IdTicket , Price = :Price , IdRoom = :IdRoom ,IdSeat = :IdSeat , IdOrder = :IdOrder WHERE IdTicket =" . $ticket->getIdTicket() . ";";

			$parameters ["IdTicket"] = $ticket->getIdTicket();
            $parameters ["Price"]    = $ticket->getPrice();
            $parameters ["IdRoom"]   = $ticket->getIdRoom();
            $parameters ["IdSeat"]   = $ticket->getIdSeat();
            $parameters ["IdOrder"]  = $ticket->getIdOrder();

			$connection = Connection::GetInstance();
			$result = $connection->ExecuteNonQuery($query, $parameters);
			return true;
		} catch (Exception $ex) {
			throw $ex;
		}
	}



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
