<?php
namespace DAO;

use Controllers\BaseController;
use \Exception as Exception;
use DAO\IUserDAO as IUserDAO;
use Models\User as User;
use Models\Orders as Orders;
use DAO\Connection as Connection;

class OrdersDAO 
{
    private $connection;
    private $tableName = "orders";

    public function Add($order){
        try{
            $query = "INSERT INTO " . $this->tableName . "( SubTotal , Total , DatePurchase, Discount , IdUser,IdScreening) VALUES ( :SubTotal, :Total ,:DatePurchase,:Discount,:IdUser,:IdScreening);";
            
            
            $parameters ["SubTotal"]       = $order->getSubTotal();
            $parameters ["Total"]          = $order->getTotal();
            $parameters ["DatePurchase"]   = $order->getDatePurchase();
            $parameters ["Discount"]       = $order->getDiscount();
            $parameters ["IdUser"]         = $order->getIdUser();
			$parameters ["IdScreening"]    = $order->getIdScreening();
			
            $connection = Connection :: GetInstance();
            $result = $connection->ExecuteNonQuery($query,$parameters,QueryType::Query);
            

            return $result;
        }   
        catch (Exception $ex){
            throw $ex;
        }
    }
    function Remove($order)
	{
		try {
			$query = "DELETE FROM " . $this->tableName . " WHERE IdOrder = " . $order->getIdOrder(). ";";

			$parameters["IdOrder"] = $order->getIdOrder();

			$connection = Connection::GetInstance();
			$result = $connection->ExecuteNonQuery($query,$parameters,QueryType::Query);
		} catch (Exception $ex) {
			throw $ex;
		}
	}
    public function GetAll()
	{
		try {
			$orderList = array();
			$query = "SELECT * FROM " . $this->tableName;
			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$order = new Order();
				$order->setIdOrder($row["IdOrder"]);
				$order->setSubTotal($row["SubTotal"]);
                $order->setTotal($row["Total"]);
                $order->setDatePurchase($row["DatePurchase"]);
                $order->setDiscount($row["Discount"]);
                $order->setIdUser($row["IdUser"]);
                $order->setIdScreening($row["IdScreening"]);
				array_push($orderList, $order);
			}
			return $orderList;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

    public function UpdateOrder($order)
	{
		try {
			$query = "UPDATE " . $this->tableName . " SET IdOrder =:IdOrder , SubTotal = :SubTotal , Total = :Total ,DatePurchase = :DatePurchase , Discount = :Discount , IdUser = :IdUser , IdScreening = :IdScreening WHERE IdOrder =" . $order->getIdOrder() . ";";

            $parameters ["IdOrder"]        = $order->getIdOrder();
            $parameters ["SubTotal"]       = $order->getSubTotal();
            $parameters ["Total"]          = $order->getTotal();
            $parameters ["DatePurchase"]   = $order->getDatePurchase();
            $parameters ["Discount"]       = $order->getDiscount();
            $parameters ["IdUser"]         = $order->getIdUser();
            $parameters ["IdScreening"]    = $order->getIdScreening();

			$connection = Connection::GetInstance();
			$result = $connection->ExecuteNonQuery($query, $parameters);
			return true;
		} catch (Exception $ex) {
			throw $ex;
		}
    }
    public function GetIdLastOrder($o)
	{
		try {
			$order = $this->getOrderByUser($o);
            $id    = $order->getIdOrder();
            if($id == null){
                $id = 1;
            }
			return $id;
		} catch (Exception $ex) {
			return null;
		}
    }
    public function getOrderByUser($u)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE IdUser = '" . $u->getIdUser()     . "';";

			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$order = new Order();
				$order->setIdOrder($row["IdOrder"]);
				$order->setSubTotal($row["SubTotal"]);
                $order->setTotal($row["Total"]);
                $order->setDatePurchase($row["DatePurchase"]);
                $order->setDiscount($row["Discount"]);
                $order->setIdUser($row["IdUser"]);
                $order->setIdScreening($row["IdScreening"]);
				return $order;
			}
		} catch (Exception $ex) {
			return null;
		}
	}
}