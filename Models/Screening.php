<?php

	namespace Models;

    class Screening{
        
        private $idScreening;
	private $idMovie;
        private $idMovieIMDB;
        private $startDate;
        private $lastDate;
        private $idRoom;
        private $idCinema;
        private $Dimension;
		    private $Audio;
		    private $Price;
        private $Subtitles;
        private $startHour;
        private $finishHour;

	public function getIdScreening(){
		return $this->idScreening;
	}

	public function setIdScreening($idScreening) {
		$this->idScreening = $idScreening;
	}
	public function getIdMovie() {
		return $this->idMovie;
	}

	public function setIdMovie($idMovie) {
		$this->idMovie = $idMovie;
	}
	    
	public function getIdMovieIMDB() {
		return $this->idMovieIMDB;
	}

	public function setIdMovieIMDB($idMovieIMDB) {
		$this->idMovieIMDB = $idMovieIMDB;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function setStartDate($startDate) {
		$this->startDate = $startDate;
	}

	public function getLastDate() {
		return $this->lastDate;
	}

	public function setLastDate($lastDate) {
		$this->lastDate = $lastDate;
	}

	public function getIdRoom() {
		return $this->idRoom;
	}

	public function setIdRoom($idRoom) {
		$this->idRoom = $idRoom;
	}

	public function getIdCinema() {
		return $this->idCinema;
	}

	public function setIdCinema($idCinema) {
		$this->idCinema = $idCinema;
	}

	public function getDimension() {
		return $this->dimension;
	}

	public function setDimension($dimension) {
		$this->dimension = $dimension;
	}

	public function getAudio() {
		return $this->idAudio;
	}

	public function setAudio($audio) {
		$this->idAudio = $audio;
	}

	public function getSubtitles() {
		return $this->Subtitles;
	}

	public function setSubtitles($subtitles) {
		$this->subtitles = $subtitles;
	}

	public function getStartHour() {
		return $this->startHour;
	}

	public function setStartHour($startHour) {
		$this->startHour = $startHour;
	}

	public function getFinishHour() {
		return $this->finishHour;
	}

	public function setFinishHour($finishHour) {
		$this->finishHour = $finishHour;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

}
?>
