<?php

namespace Controllers;

use DAO\MoviesDAO    as MoviesDAO;
use DAO\CinemaDAO    as CinemaDAO;
use DAO\ScreeningDAO as ScreeningDAO;
use DAO\UserDAO      as UserDAO;

use Models\User      as User;
use Models\Screening as Screening;
use Models\Cinema    as Cinema;

use Controllers\MoviesController    as MoviesController;
use Controllers\CinemaController    as CinemaController;
use Controllers\ScreeningController as ScreeningController;

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
        
        $screen = $this->ScreeningDAO->GetAll(); 
        $movie  = $this->MoviesDAO->GetAll();
        $cine   = $this->CinemaDAO->GetAll();

        $mC = new MoviesController();
        $sC = new ScreeningController();
        $cC = new CinemaController();

        require_once(VIEWS_PATH . "PurchaseView.php");
    }

    public function ViewCreditCard($message = ""){
        require_once(VIEWS_PATH . "PagoView.php");

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
