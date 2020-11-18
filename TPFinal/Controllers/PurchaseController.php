<?php

namespace Controllers;

use DAO\MoviesDAO as MoviesDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\ScreeningDAO as ScreeningDAO;
use DAO\UserDAO as UserDAO;
use Models\User as User;
use Models\Screening as Screening;
use Models\Cinema as Cinema;

class PurchaseController
{

    private $MoviesDAO;
    private $CinemaDAO;
    private $ScreeningDAO;

    public function __construct()
    {
        $this->MoviesDAO = new MoviesDAO();
        $this->CinemaDAO = new CinemaDAO();
        $this->ScreeningDAO = new ScreeningDAO();
    }

    public function View($message = ""){
        $cities = $this->LoadCities();

        $screen = new screeningController(); 
        $screenings = $screen->GetAll();
        $movie = new moviesController();
        $cine = new cinemaController();
        
        
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
