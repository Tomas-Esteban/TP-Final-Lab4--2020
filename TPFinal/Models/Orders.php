<?php
namespace Models;

class Orders{
    private $IdOrder;
    private $SubTotal;
    private $Total;
    private $DatePurchase;
    private $Discount;
    private $idUser;
    private $idScreening;

    public function getIdOrder(){
        return $this->idOrder;
    }
    public function setIdOrder($idOrder){
        $this->idOrder = $idOrder;
    }
    public function getSubTotal(){
        return $this->SubTotal;
    }
    public function setSubTotal($SubTotal){
        $this->SubTotal = $SubTotal;
    }

    public function getTotal(){
        return $this->Total;
    }
    public function setTotal($Total){
        $this->Total = $Total;
    }

    public function getDatePurchase(){
        return $this->DatePurchase;
    }
    public function setDatePurchase($DatePurchase){
        $this->DatePurchase = $DatePurchase;
    }

    public function getDiscount(){
        return $this->Discount;
    }
    public function setDiscount($Discount){
        $this->Discount = $Discount;
    }

    public function getIdUser(){
        return $this->idUser;
    }
    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }

    public function getIdScreening(){
        return $this->idScreening;
    }
    public function setIdScreening($idScreening){
        $this->idScreening = $idScreening;
    }





}