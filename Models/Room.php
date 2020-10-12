<?php 
namespace Models;

class Room 
{
    private $idRoom;
    private $roomNumber;
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