<?php

namespace Controllers;

use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\AddressDAO as addressDAO; 
use Controllers\RoomController as RoomController;
use Models\Movie as Movie;
use Models\Cinema as Cinema;
use Models\Room as Room;
use Exception;
use Util\Validate;
use Controllers\HomeController as HomeController;



class CinemaController
{

    private $cinemaDAO;
    private $roomDAO;
    

    function __construct()
    {
        $this->cinemaDAO = new CinemaDAO();
        $this->roomDAO = new RoomDAO();
        
    }


    public function ShowListView()
    {
        if (Validate::Logged() && Validate::AdminLog()) {


            $cinemaList =  $this->GetAll();

            require_once(VIEWS_PATH . "CinemaList.php");

        } else {
            
            HomeController::Index();
        }
    }


    public function ShowAddView($alertMessage = "")
    {
        if (Validate::Logged() && Validate::AdminLog()) {

           require_once(VIEWS_PATH . "AddCinemaView.php");
        } else {
            HomeController::Index();
        }
    }


    public function ShowEditView($idCinema, $alertMessage = "")
    {
      
        if (Validate::Logged() && Validate::AdminLog()) {
            
            require_once(VIEWS_PATH . "EditCinemaView.php");
        } else {
            HomeController::Index();
        }
    }

    public function Add($cinemaName, $address){
        if (Validate::Logged() && Validate::AdminLog()) { /*<---------------------------------------------*/

            $id = 0;
            if ($this->cinemaDAO->getCinemaByName($cinemaName)) {
                $this->ShowAddView("Cine ya existente");
            }

            $cinema = new Cinema();
            $view = new RoomController();

            $cinema->setCinemaName($cinemaName);
            $cinema->setAddress($address);
            $this->cinemaDAO->add($cinema);

            $id = $this->cinemaDAO->GetIdLastCinema($cinemaName);
            echo $id;
            
            $_SESSION["LastIdCinema"] = $id; 

            $view->ShowAddView();
            
        } else {

            HomeController::Index();
        }
    }

    public function Remove($idCinema)
    {
        if (Validate::Logged() && Validate::AdminLog()) {
            $idCinema = Validate::ValidateData($idCinema);

            $cinema = new Cinema();
            $cinema->setIdCinema($idCinema);
            $this->cinemaDAO->remove($cinema);

            $this->ShowListView();
        } else {
            HomeController::Index();
        }
    }

    public function Update($idCinema, $cinemaName, $address)
    {
        if (Validate::Logged() && Validate::AdminLog()) {
            $idCinema = Validate::ValidateData($idCinema);
            $cinemaName = Validate::ValidateData($cinemaName);
            $address = Validate::ValidateData($address);

            $cinema = new Cinema();
            $cinema->setIdCinema($idCinema);
            $cinema->setCinemaName($cinemaName);
            $cinema->setAddress($address);
            
            if ($this->cinemaDAO->UpdateCinema($cinema)) {
                $this->ShowListView();
            } else {

                $this->ShowEditView($idCinema, "Error al cargar cine, verificar nombre");
            }
        } else {
            HomeController::Index();
        }
    }

    public function getCineNameByID($cineID){

        $cine = $this->cinemaDAO->GetCineById($cineID);
        $name = $cine->getCinemaName();
        return $name;
    }
   public function GetAll(){
       $cinemaList = $this->cinemaDAO->GetAll();
       return $cinemaList;
   }

}
