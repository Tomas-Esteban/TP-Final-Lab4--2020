<?php

namespace Models;


class Cinema
{
    private $idCinema;
    private $CinemaName;
    private $address;
    

    
    public function getIdCinema()
    {
        return $this->idCinema;
    }

    public function setIdCinema($idCinema)
    {
        $this->idCinema = $idCinema;

        return $this;
    }

    public function getCinemaName()
    {
        return $this->CinemaName;
    }

 
    public function setCinemaName($CinemaName)
    {
        $this->CinemaName = $CinemaName;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}
