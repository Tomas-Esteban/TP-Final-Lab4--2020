<?php

namespace Controllers;

use DAO\MoviesDAO as MoviesDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\UserDAO as UserDAO;
use Models\User as User;

class PurchaseController
{

    private $MoviesDAO;
    private $CinemaDAO;

    public function __construct()
    {
        $this->MoviesDAO = new MoviesDAO();
        $this->CinemaDAO = new CinemaDAO();
    }

    public function View($message = ""){
        $cities = $this->LoadCities();
        require_once(VIEWS_PATH . "PurchaseView.php");
    }

    public function ViewCreditCard($message = ""){
        require_once(VIEWS_PATH . "CreditCardView.php");

    }

    public function LoadCities(){
        return $this->CinemaDAO->GetCinemaAddress(); 
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
