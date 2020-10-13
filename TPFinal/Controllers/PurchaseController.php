<?php

namespace Controllers;
use DAO\CitiesDAO as CitiesDAO;
use DAO\MoviesDAO as MoviesDAO;
use DAO\cinemaDAO as CinemasDAO;
use DAO\UserDAO as UserDAO;
use Models\User as User;

class PurchaseController
{
    private $CitiesDAO;
    private $MoviesDAO;
    private $CinemasDAO;

    public function __construct()
    {
        $this->CitiesDAO = new CitiesDAO();
        $this->MoviesDAO = new MoviesDAO();
        $this->CinemasDAO = new CinemasDAO();
    }

    public function View($message = ""){
        $cities = $this->LoadCities();
        require_once(VIEWS_PATH . "PurchaseView.php");
    }

    public function ViewCreditCard($message = ""){
        require_once(VIEWS_PATH . "CreditCardView.php");

    }

    public function LoadCities(){
        return $this->CitiesDAO->GetAll(); 
    }

    public function LoadMovies(){
        $movies = $this->MoviesDAO->GetMoviesByCity($_POST['idCity']); 
        $this->LoadCinemas(); 
    }

    public function Index(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->ViewCreditCard();
        } else {
            $this->View("Ocurrio un error");
        }
    }


}
