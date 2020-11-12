<?php
namespace Controllers;

use DAO\ScreeningDAO as ScreeningDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\MoviesDAO as MoviesDAO;
use DAO\RoomDAO as RoomDAO;
use Models\Screening as Screening;
use Models\Cinema as Cinema;
use Models\Movies as Movies;
use Models\Room as Room;

class ScreeningController{

	private $moviesDAO;
	private $screeningDAO;
	private $cinemaDAO;
	
	function __construct()
	{
		$this->moviesDAO = new MoviesDAO();
		$this->screeningDAO = new ScreeningDAO();
		$this->cinemaDAO = new CinemaDAO();
		$this->roomDAO = new RoomDAO();

	}

	public function View($idMovieIMDB){
				$screenings = array();
				$cinemas = array();
				$rooms = array();
				$movies = new Movies();

				if($idMovieIMDB != NULL)
				{
					$movies = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);
					$screenings = $this->screeningDAO->getScreeningByIdMovie($movies);
					$cinemas = $this->cinemaDAO->getAll();
					$rooms = $this->roomDAO->getAll();
				}
				else
				{
					$screenings = $this->screeningDAO->getScreeningByIdMovie($idMovie);
					$cinemas = $this->cinemaDAO->getAll();
				}
				require_once(VIEWS_PATH."ScreeningView.php");
	}
	public function AddScreeningToDatabase($idMovieIMDB,$inputFechaDesde,$inputFechaHasta,$inputHoraInicio,$inputPrice,$inputCinema,$inputSala,$inputDimension,$inputAudio,$inputSubtitulos){
		
		$screening = new Screening();
			
			$movies = $this->moviesDAO->getByIdMovieIMDB($idMovieIMDB);

			$screening->setIdMovieIMDB($movies->getIdMovieIMDB());
			$screening->setIdMovie($movies->getIdMovie());
			$screening->setStartDate($inputFechaDesde);
			$screening->setLastDate($inputFechaHasta);
			$screening->setStartHour($inputHoraInicio);
			
			$duration = $movies->getDuration();
			$dateHour= $inputFechaDesde." ".$inputHoraInicio;
			$stringHour = "+".$duration." minutes";
			$newDate = strtotime($stringHour,strtotime($dateHour));
			$newDate= date('Y-m-d H:i:s', $newDate);

			$screening->setFinishHour($newDate);
			$screening->setPrice($inputPrice);
			$screening->setIdCinema($inputCinema);
			$screening->setIdRoom($inputSala);
			$screening->setDimension($inputDimension);
			$screening->setAudio($inputAudio);
			$screening->setSubtitles($inputSubtitulos);
			
			$screeningsXday = array();
			$screeningsXday = $this->screeningDAO->distinctScreeningPerDay($screening);

			if($screeningsXday != NULL){
				foreach($screeningsXday as $dateScreening){
					$validate = $this->screeningDAO->validateScreening($dateScreening);
					if($validate == false){
						$this->screeningDAO->add($dateScreening);
					}
					else echo "Ya existe una función a esa hora";
				}
			}
			$screenings = array();

			$screenings = $this->screeningDAO->getAll();
			$cinemas = array();
			$rooms = array();

			$screenings = $this->screeningDAO->getScreeningByIdMovie($movies);
			$cinemas = $this->cinemaDAO->getAll();
			$rooms = $this->roomDAO->getAll();



			require_once(VIEWS_PATH."ScreeningView.php");
	}


	public function EditScreening($idMovieIMDB){

		$movies = $this->moviesDAO->getByIdMovieIMDB($_GET['idMovieIMDB']);
		$screening->setStartDate($_GET['inputFechaDesde']);
		$screening->setLastDate($_GET['inputFechaHasta']);
		$screening->setStartHour($_GET['inputHoraInicio']);
		$duration = $movies->getDuration();
		$dateHour=$_GET['inputFechaDesde'] ." ".$_GET['inputHoraInicio'];
		$stringHour = "+".$duration." minutes";
		$newDate = strtotime($stringHour,strtotime($dateHour));
		$newDate= date('Y-m-d H:i:s', $newDate);
		$screening->setFinishHour($newDate);
		$screening->setIdCinema($_GET['inputCinema']);
		$screening->setIdRoom($_GET['inputSala']);
		$screening->setDimension($_GET['dimension']);
		$screening->setIdCinema($_GET['inputCinema']);
		$screening->setIdRoom($_GET['inputSala']);
		$screening->setAudio($_GET['audio']);
		$screening->setPrice($_GET['price']);
		$screening->setSubtitles($_GET['subtitulos']);

		$this->screeningDAO->edit($screening);
	
		require_once(VIEWS_PATH."ScreeningView.php");
	}

	public function RemoveFromDataBase($idMovieIMDB){
		
		if($_GET['IdMovieIMDB'] != null){
			
			$movies = new Movies();
			$screening = new Screening();
			$movies = $this->moviesDAO->getByIdMovieIMDB($_GET['IdMovieIMDB']);
			$screening =$this->screeningDAO->GetScreeningByIdMovie($movies);

			$screening =$this->screeningDAO->remove($movies);
		}
		$idMovieIMDB = $movies->getIdMovieIMDB;
		require_once(VIEWS_PATH . "Views\ScreeningView.php");
	}

}
?>
