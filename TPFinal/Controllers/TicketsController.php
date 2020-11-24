<?php

namespace Controllers;


use Models\Cinema as Cinema;
use Models\Ticket as Ticket;
use Models\Orders as Order;
use DAO\CinemaDAO as CinemaDAO;
use DAO\OrderDAO as OrderDAO;
use DAO\TicketsDAO as TicketsDAO;

class TicketsController
{
    private $ticketDAO;

    public function __construct()
    {
        $this->ticketDAO = new TicketsDAO();
    }

    public function Add($precio,$room,$seat,$order){
        $ticket = new Ticket();
        $v = new TicketsController();

        $ticket->setPrice($precio);
        $ticket->setIdRoom($room);
        $ticket->setIdSeat($seat);
        $ticket->setIdOrder($order);
      
        $t = $this->ticketDAO->Add($ticket);
        
        $v->ShowTicketView();
        return $t;
    }
    public function Remove($idTicket){
        $idTicket = Validate :: ValidateData($idTicket);
        $ticket = new Ticket();
        $ticket->setIdTicket($idTicket);
        $this->ticketDAO->remove($ticket);

        $this->ShowTicketListView();
    }

    public function Update($id, $p,$r,$s,$o){
        $id = Validate :: ValidateData($id);
        $p  = Validate :: ValidateData($p);
        $r  = Validate :: ValidateData($r);
        $s  = Validate :: ValidateData($s);
        $o  = Validate :: ValidateData($o);

        $ticket = new Ticket();
        $ticket->setIdTicket($id);
        $ticket->setPrice($p);
        $ticket->setIdRoom($r);
        $ticket->setIdSeat($s);
        $ticket->setIdOrder($o);

        if($this->ticketDAO->UpdateTicket($ticket)){
            $this->ShowTicketListView();
        }   else{
            $this->ShowEditTicketView($id, "Error al editar ticket");
        }
    }
    public function GetAll(){
        $ticketList = $this->ticketDAO->GetAll();
        return $ticketList;
    }
  
    public function ShowEditTicketView($id,$alertMessage = ""){
        require_once(VIEWS_PATH . "EditTicketView.php");
    }

    public function ShowTicketView($alertMessage = ""){
        $ticket = $this->GetAll();
        require_once(VIEWS_PATH . "TicketsView.php");
    }

    public function View($inputNombre,$inputEmail,$inputPago,$inputDescripcion,$inputPrecio,$cant,$fecha)
    {
        $this->LoadOrders($inputNombre,$inputEmail,$inputPago,$inputDescripcion,$inputPrecio,$cant,$fecha);
    }

    private function LoadOrders($inputNombre,$inputEmail,$inputPago,$inputDescripcion,$inputPrecio,$cant,$fecha)
    {
        $Orders = $this->ticketDAO->LoadOrders($_SESSION['User']['IdUser'], $fecha);

        $cinemaName = $CinemaDAO->getCinemaName();  
        $address = $CinemaDAO->GetCinemaAddress();
        require_once(VIEWS_PATH . "TicketsView.php");
    }

}
