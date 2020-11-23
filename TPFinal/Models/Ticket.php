<?php

namespace Models;

class Ticket{

    private $IdTicket;
    private $price;
    private $idRoom;
    private $idSeat;
    private $idOrder;



    public function getIdTicket(){
        return $this->IdTicket;
    }
    public function setIdTicket($IdTicket){
        $this->idTicket = $IdTicket;
    }

    
    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price = $price;
    }

    
    public function getIdRoom(){
        return $this->idRoom;
    }
    public function setIdRoom($idRoom){
        $this->idRoom = $idRoom;
    }

    
    public function getIdSeat(){
        return $this->idSeat;
    }
    public function setIdSeat($idSeat){
        $this->idSeat = $idSeat;
    }

    
    public function getIdOrder(){
        return $this->idOrder;
    }
    public function setIdOrder($idOrder){
        $this->idOrder = $idOrder;
    }



}