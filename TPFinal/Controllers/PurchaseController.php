<?php

namespace Controllers;

use DAO\MoviesDAO      as MoviesDAO;
use DAO\CinemaDAO      as CinemaDAO;
use DAO\ScreeningDAO   as ScreeningDAO;
use DAO\UserDAO        as UserDAO;
use DAO\OrdersDAO      as OrdersDAO;
use DAO\TicketDAO      as TicketDAO;

use Models\User      as User;
use Models\Screening as Screening;
use Models\Cinema    as Cinema;
use Models\Orders    as Orders;
use Models\Ticket    as Ticket;

use Controllers\MoviesController    as MoviesController;
use Controllers\CinemaController    as CinemaController;
use Controllers\ScreeningController as ScreeningController;
use Controllers\TicketController    as TicketController;
use Controllers\OrdersController    as OrdersController;
use Controllers\ProfileController   as ProfileController;

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

    public function ViewCreditCard($cant,$sss){
        
        $screen = $this->ScreeningDAO->GetAll(); 
       
        foreach($screen as $s){
            
            if($s->getIdScreening() == $sss){
                $precio = $s->getPrice() * $cant ;
                $fecha = $s->getStartDate();
                $room = $s->getIdRoom();
                $des =  0.9;
                $total = ($s->getPrice() * $des);     
                $oC = new OrdersController();
                $uC = new ProfileController();
                $u = $_SESSION['User'];
                $id = $u[0];
                $o = $oC->Add($s->getPrice(),$des,$fecha,$des,$id,$s->getIdScreening());
            }
        }
        
        require_once(VIEWS_PATH . "PagoView.php");

    }

    public function LoadMovies(){
        $movies = $this->MoviesDAO->GetMoviesByCity($_POST['idCity']); 
        $this->LoadCinemas(); 
    }

    public function Index(){
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $cant = $_POST['inputCantAsientos'];
            $sss  = $_POST['inputFuncion'];
          

            $this->ViewCreditCard($cant,$sss);
        } else {
            $this->View("Ocurrio un error");
        }
    }


}
