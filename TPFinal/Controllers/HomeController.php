<?php

namespace Controllers;


use DAO\UserDAO as UserDAO;
use Exception;
use Models\User as User;

class HomeController 
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public static function Index()
    {
        require_once(VIEWS_PATH."HomeView.php");
    }

    public function View($alertMessage = "")
    {
        require_once(VIEWS_PATH . "HomeView.php");
    }

}
