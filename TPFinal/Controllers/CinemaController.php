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
use Util\ApiResponse;
use Util\Validate;
use Controllers\HomeController as HomeController;
use Models\Address as Address;



class CinemaController
{

    private $cinemaDAO;
    private $roomDAO;
    private $addressDAO;

    function __construct()
    {
        $this->cinemaDAO = new CinemaDAO();
        $this->roomDAO = new RoomDAO();
        $this->addressDAO =  new addressDAO();
       
    }


    public function ShowListView()
    {
        if (Validate::Logged() && Validate::AdminLog()) {


            $cinemaList =  $this->GetAll();

            require_once(VIEWS_PATH . "AddCinemaView.php");

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

            require_once(VIEWS_PATH . "EditCiinemaView.php");
        } else {
            HomeController::Index();
        }
    }

    public function Add($cinemaName, $address,$number)
    {
        if (Validate::Logged() && Validate::AdminLog()) { /*<---------------------------------------------*/

            $cinemaName =$cinemaName;
            $address = $address;
            $number = $number;
            $id = 0;
            if ($this->cinemaDAO->getCinemaByName($cinemaName)) {
                $this->ShowAddView("Cine ya existente");
            }

            $cinema = new Cinema();
            $addressAdd = new Address();
            $addressAdd->setIdAdress($id);
            $addressAdd->setStreet($address);
            $addressAdd->setNumberStreet($number);
            $this->addressDAO->add($addressAdd);
            $cinema->setCinemaName($cinemaName);
            $cinema->setAddress($this->addressDAO->getIdFromDataBase($address,$number));
            $this->cinemaDAO->add($cinema);
            RoomController::ShowAddView($cinema);
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

            /* if ($this->cineDAO->remove($cinema)) Functions::flash("El cine se ha eliminado correctamente.","success");
         else Functions::flash("Hubo un error al eliminar el cine.");
         Functions::redirect("Cine","ShowListView");*/

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
            $cinema = $this->cinemaDAO->getCinemaByName($cinema);
            if ($cinema != null) {
                $cinema->setCinemaName($cinemaName);
                $cinema->setAddress($address);
            }
            if ($this->cinemaDAO->UpdateCinema($cinema)) {
                $this->ShowListView();
            } else {

                $this->ShowEditView($idCinema, "Error al cargar cine, verificar nombre");
            }
        } else {
            HomeController::Index();
        }
    }

    public function GetAll()
    {

        $cinemaList = $this->cinemaDAO->getAll();

        return $cinemaList;
    }
}
