<?php
    namespace Controllers;

    use Models\Room as Room;
    use Models\Cinema as Cinema;
    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Util\Validate as Validate;
    use Controllers\HomeController as HomeController;

    class RoomController 
    {
        private $roomDAO;
        private $cinemaDAO;
    
        function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            
        }
        public function Add( $roomNumber)
        {
           
            if(Validate::Logged() && Validate::AdminLog())
            {
            $roomNumber = Validate::ValidateData($roomNumber);

            $room = new Room();
            $room->setRoomNumber($roomNumber);
            if($_SESSION["LastIdCinema"]){
                $room->setIdCinema($_SESSION["LastIdCinema"]);
                $this->roomDAO->Add($room); 
                unset($_SESSION["LastIdCinema"]);
            }

            HomeController:: Index();
            
            }
            else
            {
                HomeController:: Index();
            }
            
        }
        public function AddMoreRoom($id, $roomNumber)
        {
           
            if(Validate::Logged() && Validate::AdminLog())
            {
            $roomNumber = Validate::ValidateData($roomNumber);

            $room = new Room();
            $room->setRoomNumber($roomNumber);
            $room->setIdCinema($id);
            $this->roomDAO->Add($room); 
            HomeController:: Index();
            }
            else
            {
                HomeController:: Index();
            }
            
         
        }
        public function ShowAddView()
        {  
            $cine = new cinemaController();
            $cinemaList = $cine->GetAll();
            if(Validate::Logged() && Validate::AdminLog())
            {
                require_once(VIEWS_PATH . "AddRoomView.php");
            }
            else
            {
                HomeController:: Index();
            }
        }
        public function Remove($idRoom)
        {    
            if(Validate::Logged() && Validate::AdminLog())
            {
            $idRoom = Validate::ValidateData($idRoom);
            $room = new Room();
            $room->setIdRoom($idRoom);
            $room = $this->roomDAO->getRoomNumber($room);
            $idCine = $room->getIdCine();
            }
            else
            {
                HomeController:: Index();
            }
        }
      
    }
