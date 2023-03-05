<?php
defined('BASEPATH') or exit('No direct script access allowed');
/** set header **/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

require(APPPATH . 'libraries/RestController.php');
require(APPPATH . 'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Orders extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ordersmodel');
    }

    public function orders_get()
    {
        $orderID = $this->get("orderID");
        $memberID = $this->get("memberID");
        $status = $this->get("status");

        if($status == "all"){
            $result = $this->ordersmodel->getOrderAll();
        }else{
            if (isset($orderID)) {
                $result = $this->ordersmodel->getOrderOne($orderID,$memberID);
            } else {    
                $where = "orders.memberID = '".$memberID."'";
                $result = $this->ordersmodel->getOrderAll($where);
            }
        }

        
        
        $this->response($result, 200);
    }

    public function orders_post()
    {
        $orderDate = $this->post('orderDate');
        $address = $this->post('address');
        $tel = $this->post('tel');
        $userID = $this->post('userID');
        $ordersDetail = $this->post('ordersDetail');


        $data = array(
            "orderDate" => $orderDate,
            "address"   => $address,
            "tel"       => $tel,
            "userID"    => $userID
        );

        $orderID = $this->ordersmodel->insertOrder($data);

        foreach ($ordersDetail as $item) {
            $data = array(
                "orderID" => $orderID,
                "productID" => $item['productID'],
                "qty"       => $item['qty']
            );
            $this->ordersmodel->insertOrderDetail($data);
        }

        if($orderID > 0){
            $resulte = array(
                "status"    => "success",
                "detail"    => "insert order complated",
                "orderID"   => $orderID
            );
        }else{
            $resulte = array(
                "status"    => "error",
                "detail"    => "can not insert order"
            );
        }

        $this->response($resulte, 200);


    }
}
