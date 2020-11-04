<?php 
namespace Models;

class Room 
{
    private $idRoom;
    private $roomNumber;
    private $cantButacas;
    private $precioSala;
    private $idCinema;

    public function getIdRoom()
    {
        return $this->idRoom;
    }


    public function setIdRoom($idRoom)
    {
        $this->idRoom = $idRoom;

        return $this;
    }


    public function getRoomNumber()
    {
        return $this->roomNumer;
    }

 
    public function setRoomNumber($roomNumer)
    {
        $this->roomNumer = $roomNumer;

        return $this;
    }
    
    public function getCantButacas()
    {
        return $this->cantButacas;
    }


    public function setCantButacas($cantButacas)
    {
        $this->cantButacas = $cantButacas;

        return $this;
    }
    
    public function getPrecioSala()
    {
        return $this->precioSala;
    }


    public function setPrecioSala($precioSala)
    {
        $this->precioSala = $precioSala;

        return $this;
    }

    
    public function getIdCinema()
    {
        return $this->idCinema;
    }

  
    public function setIdCinema($idCinema)
    {
        $this->idCinema = $idCinema;

        return $this;
    }
}


?>