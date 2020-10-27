<?php
namespace Models;

class Address
{
        private $idAdress;
        private $street;
        private $numberStreet;
    

        /**
         * Get the value of street
         */ 
        public function getStreet()
        {
                return $this->street;
        }
        public function setStreet($street){
                $this->street = $street;
                return $this;
        }
        /**
         * Get the value of numberStreet
         */ 
        public function getNumberStreet()
        {
                return $this->numberStreet;
        }
        public function setNumberStreet($numberStreet){
                $this->numberStreet= $numberStreet;
                return $this;
        }
        /**
         * Get the value of idAdress
         */ 
        public function getIdAdress()
        {
                return $this->idAdress;
        }

        /**
         * Set the value of idAdress
         *
         * @return  self
         */ 
        public function setIdAdress($idAdress)
        {
                $this->idAdress = ++$idAdress;

                return $this;
        }


}
