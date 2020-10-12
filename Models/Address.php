<?php
namespace Models;

class Address
{
        private $idAdress;
        private $street;
        private $numberStreet;
        private $department;
        private $departmentFloor;
        private $idCity;


        /**
         * Get the value of street
         */ 
        public function getStreet()
        {
                return $this->street;
        }

        /**
         * Get the value of numberStreet
         */ 
        public function getNumberStreet()
        {
                return $this->numberStreet;
        }

        /**
         * Get the value of department
         */ 
        public function getDepartment()
        {
                return $this->department;
        }

        /**
         * Get the value of departmentFloor
         */ 
        public function getDepartmentFloor()
        {
                return $this->departmentFloor;
        }

        /**
         * Get the value of idCity
         */ 
        public function getIdCity()
        {
                return $this->idCity;
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
                $this->idAdress = $idAdress;

                return $this;
        }


}
