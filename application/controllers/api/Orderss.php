<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/** set header **/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Orderss extends RestController
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('orderssmodel'); //การเรียกใช้โมดูล
    }
    public function orders_get()
    {
        $OrderID = $this->get('OrderID');
        $memberID = $this->get('memberID');

        if ($memberID == 0) {
            $result = $this->orderssmodel->getOdersAll($memberID);
        } else {
            $result = $this->orderssmodel->getOdersOne($OrderID);
        }

        $this->response($result, 200);
    }

    public function orders_post() //รับค่าเปง post
    {
        $OrderDate = $this->post('OrderDate');
        $Address = $this->post('Address');
        $orderStatus = $this->post('orderStatus');
        $payment = $this->post('payment');
        $memberID = $this->post('memberID');

        $data = array(
            "OrderDate"        => $OrderDate,
            "Address"        => $Address,
            "memberID"        => $memberID,
            "orderStatus"    => $orderStatus,
            "payment"        => $payment,
        );

        $id = $this->orderssmodel->insertOders($data);
        if ($id != '') {
            $result = array(
                "status"    => "success",
                "detail"    => "Orders compleated",
                "orderID"   => $id
            );
        } else {
            $result = array(
                "status"    => "error",
                "detail"    => "can not insert Orders"
            );
        }
        $this->response($result, 200);
    }

    public function orders_put() //รับค่าเปง post
    {
        $OrderDate    = $this->put('OrderDate');
        $Address      = $this->put('Address');
        $orderStatus  = $this->put('orderStatus');
        $payment      = $this->put('payment');
        $OrderID      = $this->put('OrderID');

        $data = array(
            "OrderDate"        => $OrderDate,
            "Address"        => $Address,
            "orderStatus"    => $orderStatus,
            "payment"        => $payment,
            "OrderID"        => $OrderID,
        );

        $where = "OrderID = $OrderID";

        $this->orderssmodel->updateOrders($data, $where);

        $result = array(
            "status"    => "success",
            "detail"    => "update Orders compleated"
        );
        $this->response($result, 200);
    }

    public function status_put()
    {
        $OrderID      = $this->put('OrderID');
        $orderStatus  = $this->put('orderStatus');

        $data = array(
            "orderStatus"    => $orderStatus
        );

        $where = "OrderID = $OrderID";

        $this->orderssmodel->updateOrders($data, $where);

        $result = array(
            "status"    => "success",
            "detail"    => "update Orders status completed"
        );
        $this->response($result, 200);
    }


    public function orders_delete($OrderID)
    {
        $where = "orderID = $OrderID";

        $this->orderssmodel->deleteorders($where);

        $result = array(
            "status"    => "success",
            "detail"    => "delete Oders compleated"
        );


        $this->response($result, 200);
    }
}
