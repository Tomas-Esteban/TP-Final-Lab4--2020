<?php
namespace Controllers;

use Models\Orders as Orders;
use DAO\OrdersDAO as OrdersDAO;

class OrdersController{

    private $orderDAO;

    public function __construct(){
        $this->orderDAO = new OrdersDAO();
    }

    public function Add($SubTotal,$Total,$DatePurcharse,$Discount,$IdUser,$IdScreening){
        $o = new Orders();

        $o->setSubTotal($SubTotal);
        $o->setTotal($Total);
        $o->setDatePurchase($DatePurcharse);
        $o->setDiscount($Discount);
        $o->setIdUser($IdUser);
        $o->setIdScreening($IdScreening);

        $order = $this->orderDAO->Add($o);
        
        return $order;
    }
    public function Remove($idOrder){
        $idOrder = Validate :: ValidateData($idOrder);
        $order = new Order();
        $order->setIdOrder($idOrder);
        $this->orderDAO->remove($order);

        $this->ShowOrderTicketView();
    }

    public function Update($id, $sT,$T,$dP,$D,$u,$s){
        $id  = Validate :: ValidateData($id);
        $sT  = Validate :: ValidateData($sT);
        $T   = Validate :: ValidateData($T);
        $dP  = Validate :: ValidateData($dP);
        $D   = Validate :: ValidateData($D);
        $u   = Validate :: ValidateData($u);
        $s   = Validate :: ValidateData($s);

        $o = new Order();
        $o->setIdOrder($id);
        $o->setSubTotal($sT);
        $o->setTotal($T);
        $o->setDatePurchase($dP);
        $o->setDiscount($D);
        $o->setIdUser($u);
        $o->setIdScreening($s);

        
        if($this->orderDAO->UpdateOrder($o)){
            $this->ShowOrderListView();
        }   else{
            $this->ShowEditTicketView($id, "Error al editar ticket");
        }
    }

    public function GetAll(){
        $orderList = $this->orderDAO->GetAll();
        return $orderList;
    }

    public function ShowEditOrderView($id,$alertMessage = ""){
        require_once(VIEWS_PATH . "EditOrderView.php");
    }



}