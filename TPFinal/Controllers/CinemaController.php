<?php

namespace Controllers;

use DAO\CinemaDAO as CinemaDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\CitiesDAO as CitiesDAO; 
use DAO\AddressDAO as AddressDAO; 

use Controllers\RoomController as RoomController;
use Models\Movie as Movie;
use Models\Cinema as Cinema;
use Models\Room as Room;
use Exception;
use Util\ApiResponse;
use Util\Validate;
use Controllers\HomeController as HomeController;
use Models\City as City;
use Models\State as State;
use Models\Country as Country;
use Models\Address as Address;



class CinemaController
{

    private $cinemaDAO;
    private $roomDAO;

    function __construct()
    {
        $this->cinemaDAO = new CinemaDAO();
        $this->roomDAO = new RoomDAO();
        $this->citiesDAO = new CitiesDAO();
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

            $countryList = array();
            $countryList = $this->citiesDAO->getAllCountries();
            
            $stateList = array();
            $cityList = array();

            foreach ($countryList as $country){
                $stateList = $this->citiesDAO->getStateByCountry($country->getIdCountry());
            }
            foreach ($stateList as $state){
                $cityList = $this->citiesDAO->getCitiesByState($state->getIdState());
            }


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

    public function Add($cinemaName,  $countryName, $stateName, $cityName, $address,$number)
    {
        /*if (Validate::Logged() /*&& Validate::AdminLog()) { /*<---------------------------------------------*/

            $cinemaName =($cinemaName);
            $address = ($address);
            $number = ($number);
            $countryName = ($countryName);
            $stateName = ($stateName);
            $cityName = ($cityName);

            if ($this->cinemaDAO->getCinemaByName($cinemaName)) {
                $this->ShowAddView("Cine ya existente");
            }
            $cinema = new Cinema();
            $addressAdd = new Address();
            $city = new City();
            $city = $this->citiesDAO->getIdCitiesByName($cityName);

            $addressAdd->setStreet($address);
            $addressAdd->setNumberStreet($number);
            $addressAdd->setIdCity($city->getIdCity());
            $this->addressDAO->add($addressAdd);

            $cinema->setCinemaName($cinemaName);
            $cinema->setCountryName($countryName);
            $cinema->setStateName($stateName);
            $cinema->setCityName($cityName);
            $cinema->setNumber($number);
            $cinema->setAddress($this->addressDAO->getIdFromDataBase($addressAdd));

            $this->cinemaDAO->add($cinema);
            RoomController::ShowAddView($cinema);
       /* } else {

            HomeController::Index();
        }*/
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
