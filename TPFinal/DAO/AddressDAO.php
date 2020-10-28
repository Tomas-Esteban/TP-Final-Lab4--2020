<?php

namespace DAO;

use \PDO as PDO;
use Models\User as User;
use Models\Address as Address;
use DAO\Connection as Connection;
use DAO\QueryType as QueryType;

class AddressDAO
{
    private $connection;
    private $tableName = "addresses";

    public function GetAll()
    {
        $query = "SELECT * FROM " . $this->tableName . ";";
        $parameters = array();
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query, $parameters, QueryType::Query);

            foreach ($result as $row) {
                $address = new Address();
                //$address->setIdAddress($row["IdAddress"]);
                $address->setStreet($row["Street"]);
                $address->setNumberStreet($row["NumberStreet"]);

                array_push($parameters, $address);
            }
            return $parameters;
      
    }


    public function add($address){

        $street = $address->getStreet();
        $numberStreet = $address->getNumberStreet();
        $array = array();
        
        $query = "INSERT INTO ". $this->tableName . "(Street,numberStreet) VALUES (:street,:numberStreet);";
        
        $parameters["street"] = $street;
        $parameters["numberStreet"] = $numberStreet;

        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters,QueryType::Query);

        return $this->getIdFromDataBase($street, $numberStreet);
}


    public function getIdFromDataBase($street, $numberStreet){
                                                    //WHERE (Email = :Email) AND UserPassword = :UserPassword;
        $query = "SELECT * FROM " . $this->tableName . " WHERE Street = :street AND  NumberStreet = :numberStreet ;";
        $parameters = array();

        $parameters["street"] = $street;
        $parameters["numberStreet"] = $numberStreet;
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query,$parameters,QueryType::Query);
    
        try{

            foreach ($result as $row) {
                $address = new Address();
                $address->setIdAdress($row["IdAddress"]);
            }
            return $address->getIdAdress();
        }
        catch (Exception $ex) {
            throw $ex;
        }
    }
}
    
