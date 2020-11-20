<?php
    namespace Controllers;

    use Exception;
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
        public function Add($roomNumber,$cantButacas,$precioSala)
        {
           
            if(Validate::Logged() && Validate::AdminLog())
            {
            $roomNumber = Validate::ValidateData($roomNumber);

            $room = new Room();
            $room->setRoomNumber($roomNumber);
            $room->setCantButacas($cantButacas);
            $room->setPrecioSalaRoom($precioSala);

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
        public function AddMoreRoom($id, $roomNumber,$cantButacas,$precioSala)
        {
           
            if(Validate::Logged() && Validate::AdminLog())
            {
            $roomNumber = Validate::ValidateData($roomNumber);

            $room = new Room();
            $room->setRoomNumber($roomNumber);
            $room->setCantButacas($cantButacas);
            $room->setPrecioSala($precioSala);
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

        public function ShowListView()
        {
            if (Validate::Logged() && Validate::AdminLog()) {
                $roomList =  $this->GetAll();
                require_once(VIEWS_PATH . "RoomList.php");

            } else {
            
                HomeController::Index();
            }
        }

        public function ShowEditView($idSala)
        {  
            $room = new RoomController();
            $roomList = $room->GetAll();
            if(Validate::Logged() && Validate::AdminLog())
            {
                require_once(VIEWS_PATH . "EditRoomView.php");
            }
            else
            {
                HomeController:: Index();
            }
        }
        public function Update($idSala, $numeroSala, $asientos, $precio)
    {
        if (Validate::Logged() && Validate::AdminLog()) {
            $idSala     = Validate::ValidateData($idSala);
            $numeroSala = Validate::ValidateData($numeroSala);
            $asientos   = Validate::ValidateData($asientos);
            $precio     = Validate::ValidateData($precio);

            $room = new Room();
            $room->setIdRoom($idSala);
            $room->setRoomNumber($numeroSala);
            $room->setCantButacas($asientos);
            $room->setPrecioSala($precio);
            
            if ($this->roomDAO->UpdateRoom($room)) {
                $this->ShowListView();
            } else {

                $this->ShowEditView($idSala, "Error al cargar Sala, verificar Cine");
            }
        } else {
            HomeController::Index();
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
        public function GetAll()
    {

        $roomList = $this->roomDAO->getAll();
        return $roomList;
    }
      public function getRoomByIdCinema($IdCinema){
        $roomList = $this->getByCine()        
        return $roomList;
      }
    }
