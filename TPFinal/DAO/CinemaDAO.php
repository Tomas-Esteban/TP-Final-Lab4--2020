<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\cinema as cinema;
use DAO\QueryType as QueryType;

class cinemaDAO
{

	private $tableName = "cinemas";
	private $parameters = array();

	public function Add($cinema)
	{
		try {
			$query = "INSERT INTO " . $this->tableName . " (CinemaName, Address) VALUES (:CinemaName, :Address);";

			$parameters["CinemaName"] = $cinema->getCinemaName();
			$parameters["Address"] = $cinema->getAddress();
			
			$connection = Connection::GetInstance();
			$result = $connection->ExecuteNonQuery($query,$parameters,QueryType::Query);
	
			return $result;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	

	function Remove($cinema)
	{
		try {
			$query = "DELETE FROM " . $this->tableName . " WHERE IdCinema = " . $cinema->getIdCinema() . ";";

			$parameters["IdCinema"] = $cinema->getIdCinema();

			$connection = Connection::GetInstance();
			$result = $connection->ExecuteNonQuery($query,$parameters,QueryType::Query);
		} catch (Exception $ex) {
			return null;
		}
	}

	public function GetAll()
	{
		try {
			$cinemaList = array();
			$query = "SELECT * FROM " . $this->tableName;
			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setAddress($row["Address"]);
				array_push($cinemaList, $cinema);
			}
			return $cinemaList;
		} catch (Exception $ex) {
			return $ex;
		}
	}
	
	public function GetIdLastCinema($cinema)
	{
		try {
			$cine =	$this->getCinemaByName($cinema);
			$id = $cine->getIdCinema();
			return $id;
		} catch (Exception $ex) {
			return null;
		}
	}
		
	public function GetCineById($cinema)
	{

		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE idCinema = " . $cinema->getIdCinema() . ";";
			$connection = Connection::GetInstance();
			//$result = $this->connection->execute($query);
			$result = $connection->exec($query);
			foreach ($result as $row) {
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setAddress($row["IdAddress"]);
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}

	public function UpdateCinema($cinema)
	{
		try {
			$query = "UPDATE " . $this->tableName . " SET IdCinema = :IdCinema, CinemaName = :CinemaName, Address = :Address WHERE IdCinema =" . $cinema->getIdCinema() . ";";

			$parameters["IdCinema"] = $cinema->getIdCinema();
			$parameters["CinemaName"] = $cinema->getCinemaName();
			$parameters["Address"] = $cinema->getAddress();

			$connection = Connection::GetInstance();
			$result = $connection->ExecuteNonQuery($query, $parameters);
			return true;
		} catch (Exception $ex) {
			return null;
		}
	}
	public function getCinemaByName($cinema)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE CinemaName = '" . $cinema . "';";

			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setAddress($row["Address"]);
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}
	public function GetCinemaAddress()
    {
		try {
			$addressList = array();
			$query = "SELECT * FROM " . $this->tableName;
			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$address = $row["Address"];
				array_push($addressList, $address);
			}
			return $addressList;
		} catch (Exception $ex) {
			return $ex;
		}
	}
	public function GetCinemaName()
    {
		try {
			$addressList = array();
			$query = "SELECT * FROM " . $this->tableName;
			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$name = $row["CinemaName"];
			}
			return $name;
		} catch (Exception $ex) {
			return $ex;
		}
    }
	public function getCinemaByID($idCinema)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE idCinema = " . $idCinema . ";";

			$connection = Connection::GetInstance();
			$result = $connection->Execute($query);

			foreach ($result as $row) {
				$cinema = $row["CinemaName"];
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}
}
