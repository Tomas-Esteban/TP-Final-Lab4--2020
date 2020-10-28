<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\cinema as cinema;
use DAO\QueryType as QueryType;
class cinemaDAO
{
	private $connection;
	private $tableName = "cinemas";
	private $parameters = array();
	public function Add($cinema)
	{
		try {
			$query = "INSERT INTO " . $this->tableName . " (CinemaName, IdAddress) VALUES (:CinemaName, :IdAddress);";

			$parameters["CinemaName"] = $cinema->getCinemaName();
			$parameters["IdAddress"] = $cinema->getAddress();
			
			$this->$connection = Connection::GetInstance();
			$result = $this->$connection->ExecuteNonQuery($query,$parameters,QueryType::Query);
			
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

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query,$parameters,QueryType::Query);
		} catch (Exception $ex) {
			return null;
		}
	}

	public function GetAll()
	{
		try {
			$cinemaList = array();
			$query = "SELECT * FROM " . $this->tableName;
			$this->connection = Connection::GetInstance();
			$result = $this->connection->Execute($query);

			foreach ($result as $row) {
				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setAddress($row["IdAddress"]);
				array_push($cinemaList, $cinema);
			}
			return $cinemaList;
		} catch (Exception $ex) {
			return null;
		}
	}

	public function GetCineById($cinema)
	{

		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE idCinema = " . $cinema->getIdCinema() . ";";
			$this->connection = Connection::GetInstance();
			//$result = $this->connection->execute($query);
			$result = $this->connection->exec($query);

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
			$query = "UPDATE " . $this->tableName . " SET IdCinema = :IdCinema, CinemaName = :CinemaName, IdAddress = :IdAddress WHERE IdCinema =" . $cinema->getIdCinema() . ";";

			$parameters["IdCinema"] = $cinema->getIdCinema();
			$parameters["CinemaName"] = $cinema->getCinemaName();
			$parameters["IdAddress"] = $cinema->getAddress();

			$this->connection = Connection::GetInstance();
			$this->connection->ExecuteNonQuery($query, $parameters);
			return true;
		} catch (Exception $ex) {
			return null;
		}
	}
	public function getCinemaByName($cinema)
	{
		try {
			$query = "SELECT * FROM " . $this->tableName . " WHERE CinemaName = '" . $cinema . "';";

			$this->connection = Connection::GetInstance();

			$result = $this->connection->Execute($query);

			foreach ($result as $row) {
				$cinema = new Cinema();
				$cinema->setIdCinema($row["IdCinema"]);
				$cinema->setCinemaName($row["CinemaName"]);
				$cinema->setAddress($row["IdAddress"]);
				return $cinema;
			}
		} catch (Exception $ex) {
			return null;
		}
	}
}
