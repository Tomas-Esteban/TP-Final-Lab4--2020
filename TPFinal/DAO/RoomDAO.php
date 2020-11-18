<?php
    namespace DAO;
    use Models\Room as Room;
    use Exception;

    class RoomDAO
    {
        private $connection;
        private $tableName = "rooms";
       
        public function Add($room)
        {
            try 
            {
                $query = "INSERT INTO " . $this->tableName . " (CinemaId, RoomNumber, Seats, Price) VALUES (:CinemaId, :RoomNumber, :Seats, :Price);";
                $parameters["CinemaId"]   = $room->getIdCinema();
                $parameters["RoomNumber"] = $room->getRoomNumber();
                $parameters["Seats"]      = $room->getCantButacas();
                $parameters["Price"]      = $room->getPrecioSala();
        
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) 
            {
                throw $ex;
            }
        }

        function Remove($room)
        {
            try 
            {
                $query = "DELETE FROM " . $this->tableName . " WHERE idRoom = :idRoom;";
                $parameters['idRoom'] = $room->getIdRoom();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) 
            {
                return $ex;
            }
        }

        public function GetAll()
        {
            try 
            {
                $roomList = array();
                $query = "SELECT * FROM " . $this->tableName;

                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                foreach ($result as $row) 
                {
                    $room = new Room();
                    $room->setIdRoom($row["IdRoom"]);
                    $room->setIdCinema($row["CinemaId"]);
                    $room->setRoomNumber($row["RoomNumber"]);
                    $room->setCantButacas($row["Seats"]);
                    $room->setPrecioSala($row["Price"]);
                 

                    array_push($roomList, $room);
                }
                return $roomList;
            }
            catch (Exception $ex) 
            {
                return $ex;
            }
        }

        public function getRoomById($room)
        {
            try 
            {
                $query = "SELECT * FROM " . $this->tableName . " WHERE idRoom = '" . $room->getIdRoom() . "';";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                foreach ($result as $row)
                {
                    $room->setId($row["idRoom"]);
                    $room->setIdCine($row["CinemaId"]);
                    $room->setRoomNumber($row["RoomNumber"]);
           
                    return $room;
                }
            } 
            catch (Exception $ex) 
            {
                return $ex;
            }
        }

        public function getByCine($cine)
        {
            try 
            {
                $list = array();
                $query = "SELECT * FROM " . $this->tableName . " WHERE id_cine = '" . $cine->getId() . "';";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row) 
                {
                    $sala = new Sala();
                    $sala->setId($row["id_sala"]);
                    $sala->setIdCine($row["id_cine"]);
                    $sala->setNombre($row["nombre"]);
                    $sala->setPrecio($row["precio"]);
                    $sala->setCapacidad($row["capacidad"]);
                    array_push($list, $sala);
                }
                return $list;
            } 
            catch (Exception $ex) 
            {
                return $ex;
            }
        }

        public function UpdateRoom($room)
	    {
		    try {
                $query = "UPDATE " . $this->tableName . " SET IdRoom = :IdRoom, RoomNumber = :RoomNumber, Seats = :Seats, Price = :Price WHERE IdRoom =" . $room->getIdRoom() . ";";

                $parameters["IdRoom"]       = $room->getIdRoom();
                $parameters["RoomNumber"]   = $room->getRoomNumber();
                $parameters["Seats"]        = $room->getCantButacas();
                $parameters["Price"]        = $room->getPrecioSala();

                $connection = Connection::GetInstance();
                $result = $connection->ExecuteNonQuery($query, $parameters);
                return true;
            } 
            catch (Exception $ex) {
	    		return $ex;
		    }
    	}
      
    }
?>