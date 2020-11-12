<?php
namespace DAO;

use Models\Movies as Movies;
use Models\Cinemas as Cinema;
use Models\Screening as Screening;
use Interfaces\IScreeningDAO as IScreeningDAO;

    class ScreeningDAO implements IScreeningDAO{

        private $connection;
        private $tableName = "Screenings";
        private $movieTableName = "Movies";
        private $cinemaTableName = "Cinemas";
        private $roomTableName = "Rooms";

        public function add($screening){

            try{
                $query = "INSERT INTO " . $this->tableName . " ( IdMovieIMDB,  IdMovie,  StartDate,  LastDate,  StartHour,  FinishHour,  Price,  IdRoom,  IdCinema,  Audio,  Subtitles,  Dimension)
                                                        VALUES (:IdMovieIMDB, :IdMovie, :StartDate, :LastDate, :StartHour, :FinishHour, :Price, :IdRoom, :IdCinema, :Audio, :Subtitles, :Dimension);";
                $finish = $screening->getStartHour();
                $parameters["IdMovieIMDB"] = $screening->getIdMovieIMDB();
                $parameters["IdMovie"] = $screening->getIdMovie();
                $parameters["StartDate"] = $screening->getStartDate();
                $parameters["LastDate"] = $screening->getLastDate();
                $parameters["StartHour"] = $screening->getStartHour();
                $parameters["FinishHour"] = 2;
                $parameters["Price"] = $screening->getPrice();
                $parameters["IdRoom"] = $screening->getIdRoom();
                $parameters["IdCinema"] = $screening->getIdCinema();
                $parameters["Subtitles"] = $screening->getSubtitles();
                $parameters["Audio"] = $screening->getAudio();
                $parameters["Dimension"] = $screening->getDimension();
                
                $this->connection = Connection::GetInstance();
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
                
                return $result;

		        } 
		    catch (Exception $ex){
			    throw $ex;
		        }
        }

    public function GetAll(){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) 
                {
                    $screening = new Screening();
                    $screening->setIdScreening($row["IdScreening"]);
                    $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                    $screening->setIdMovie($row["IdMovie"]);
                    $screening->setStartDate($row["StartDate"]);
                    $screening->setLastDate($row["LastDate"]);
                    $screening->setStartHour($row["StartHour"]);
                    $screening->setFinishHour($row["FinishHour"]);
                    $screening->setPrice($row["Price"]);
                    $screening->setIdRoom($row["IdRoom"]);
                    $screening->setIdCinema($row["IdCinema"]);
                    $screening->setSubtitles($row["Subtitles"]);
                    $screening->setAudio($row["Audio"]);
                    $screening->setDimension($row["Dimension"]);

                    array_push($list,$screening);
                }	
                return $list;
            
		} 
	catch (Exception $ex) 
	{
		return null;
	}

    }

    public function GetScreeningById($idScreening){
        try{
            $list = array();
            $query = "SELECT * FROM" .$this->tableName ."WHERE IdScreening =". $idScreening;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
    
                    
            foreach ($resultSet as $row) {
                    
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setIdMovie($row["IdMovie"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setPrice($row["Price"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setAudio($row["Audio"]);
                $screening->setDimension($row["Dimension"]);
                return $screening;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }
    
        }
    function remove($screening)
        {
            try{
                $query = "DELETE * FROM ".$this->tableName." WHERE IdScreening = " . $screening->getIdScreening();
                    
                $parameters['IdScreening'] = $screening->getIdScreening();
                    
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                
                return null;
            }
        }
        
    public function edit($screening){

        try{
            $query = "UPDATE ". $this->tableName ." SET IdMovieIMDB = :IdMovieIMDB, StartDate = :StartDate, 
            LastDate = :LastDate, IdRoom = :IdRoom, IdCinema = :IdCinema, Dimension = :Dimension,

            Audio = :Audio, Subtitles = :Subtitles, StartHour = :StartHour, FinishHour = :FinishHour, Price = :Price
            WHERE IdScreening = " . $screening->getId() . " ;";
                       
            $parameters["StartDate"] = $screening->getStartDate();
            $parameters["LastDate"] = $screening->getLastDate();
            $parameters["IdRoom"] = $screening->getIdRoom();
            $parameters["IdCinema"] = $screening->getIdCinema();
            $parameters["Dimension"] = $screening->getDimension();
            $parameters["Audio"] = $screening->getAudio();
            $parameters["Price"] = $screening->getPrice();
            $parameters["Subtitles"] = $screening->getSubtitles();
            $parameters["StartHour"] = $screening->getStartHour();
            $parameters["FinishHour"] = $screening->getFinishHour();

                    
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            } 
        catch (Exception $ex){
            throw $ex;
        }
    }
    public function GetScreeningByIdMovie($movies){
        try{
            $list = array();
            $query = "SELECT * FROM " . $this->tableName ." WHERE IdMovieIMDB = ". $movies->getIdMovieIMDB();
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            if($resultSet == null){

                $screening = new Screening();
                $screening->setIdScreening("-");
                $screening->setIdMovieIMDB($movies->getIdMovieIMDB());
                $screening->setIdMovie($movies->getIdMovie());
                $screening->setStartDate("-");
                $screening->setLastDate("-");
                $screening->setStartHour("-");
                $screening->setFinishHour("-");
                $screening->setIdRoom("-");
                $screening->setPrice("-");
                $screening->setIdCinema("-");
                $screening->setSubtitles("-");
                $screening->setAudio($movies->getOriginalLanguage());
                $screening->setDimension("-");

                array_push($list, $screening);
            }

            else{
                $resultSet = $this->connection->Execute($query);
          
                    foreach ($resultSet as $row){
                  
                        $screening = new Screening();
                      
                        $screening->setIdScreening($row["IdScreening"]);
                        $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                        $screening->setIdMovie($row["IdMovie"]);
                        $screening->setStartDate($row["StartDate"]);
                        $screening->setLastDate($row["LastDate"]);
                        $screening->setStartHour($row["StartHour"]);
                        $screening->setFinishHour($row["FinishHour"]);
                        $screening->setPrice($row["Price"]);
                        $screening->setIdRoom($row["IdRoom"]);
                        $screening->setIdCinema($row["IdCinema"]);
                        $screening->setSubtitles($row["Subtitles"]);
                        $screening->setAudio($row["Audio"]);
                        $screening->setDimension($row["Dimension"]);
                        
                        array_push($list, $screening);
                    }
            }
            return $list;
        }  
        catch(Exception $ex){
            return null;
        }

    }

        public function GetScreeningByIdCinema($idCinema){
            try{
                $list = array();
                $query = "SELECT * FROM" .$this->tableName ."WHERE IdCinema =". $idCinema;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                
            foreach ($resultSet as $row) 
            {
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setIdMovie($row["IdMovie"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setPrice($row["Price"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setAudio($row["Audio"]);
                $screening->setDimension($row["Dimension"]);

                return $screening;
            }
            return null;
        }
        catch(Exception $ex)
        {
            return null;
        }

        }
        public function existInDataBase($idMovieIMDB){
            try{
                $list = array();
                $query = "SELECT * FROM " . $this->tableName ." WHERE IdMovieIMDB = ". $idMovieIMDB;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                if($resultSet != null){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }
        }

        
        public function distinctScreeningPerDay($screening){

            $screeningList = array();
            $date = $screening->getStartDate();
            array_push($screeningList, $screening);

            while($screening->getLastDate()> $date){
                $newScreening = new Screening();
                $date = date("Y-m-d", strtotime($date ."+ 1 days"));

                $newScreening->setIdScreening($screening->getIdScreening());
                $newScreening->setIdMovieIMDB($screening->getIdMovieIMDB());
                $newScreening->setIdMovie($screening->getIdMovie());
                $newScreening->setStartDate($date);
                $newScreening->setLastDate($screening->getLastDate());
                $newScreening->setStartHour($screening->getStartHour());
                $newScreening->setFinishHour($screening->getFinishHour());
                $newScreening->setPrice($screening->getPrice());
                $newScreening->setIdRoom($screening->getIdRoom());
                $newScreening->setIdCinema($screening->getIdCinema());
                $newScreening->setSubtitles($screening->getSubtitles());
                $newScreening->setAudio($screening->getAudio());
                $newScreening->setDimension($screening->getDimension());
                
                array_push($screeningList, $newScreening);
            }


            return $screeningList;
        }

    public function GetScreeningByIdRoom($idRoom){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName ." WHERE IdRoom = ". $idRoom;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
    
                    
            foreach ($resultSet as $row) {
                    
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setIdMovie($row["IdMovie"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setPrice($row["Price"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setAudio($row["Audio"]);
                $screening->setDimension($row["Dimension"]);
                return $screening;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }
    
        }
        public function GetScreeningByStartDate($startDate){
        try{
            $list = array();
            $query = "SELECT * FROM " .$this->tableName ." WHERE StartDate = ". $startDate;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
                 
            foreach ($resultSet as $row) {
                        
                $screening = new Screening();
                $screening->setIdScreening($row["IdScreening"]);
                $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                $screening->setIdMovie($row["IdMovie"]);
                $screening->setStartDate($row["StartDate"]);
                $screening->setLastDate($row["LastDate"]);
                $screening->setStartHour($row["StartHour"]);
                $screening->setFinishHour($row["FinishHour"]);
                $screening->setPrice($row["Price"]);
                $screening->setIdRoom($row["IdRoom"]);
                $screening->setIdCinema($row["IdCinema"]);
                $screening->setSubtitles($row["Subtitles"]);
                $screening->setAudio($row["Audio"]);
                $screening->setDimension($row["Dimension"]);
                return $screening;
                }
            }
            catch(Exception $ex)
            {
                return null;
            }

        }

    public function validateScreening($screenP){

        $idRoom = $screenP->getIdRoom();
        $screenList = array();
        $screenList = $this->GetScreeningByIdRoom($idRoom);
        $exist = false;
        var_dump($screenList);
        if($screenList != NULL){
            foreach($screenList as $x){
                if($screenP->getStartDate() == $x->getStartDate()){
                    $exist = true;
                }
            }
        }

        return $exist;
    }
}
