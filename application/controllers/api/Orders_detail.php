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
class Orders_detail extends RestController {

        public function __construct()
    {
        parent::__construct();
        $this->load->model('orders_detailmodel');//การเรียกช่ายโมดู
    }
    public function orderdetail_get()
    {
        $DetailID = $this->get('DetailID');
        $OrderID= $this->get('OrderID');

        if($OrderID != 0){
            $result = $this->orders_detailmodel->getorders_detailAll($OrderID);
        }else{
            $result = $this->orders_detailmodel->getorders_detailOne($DetailID);
        }
        
        $this->response($result,200);
    }

    public function ordersdetail_post()//รับค่าเปง post
    {
        $OrderID   = $this->post('OrderID');
        $ProductID = $this->post('ProductID');
        $Qty       = $this->post('Qty');

        $data = array(
    		"OrderID"		=> $OrderID,
    		"ProductID"		=> $ProductID,
			"Qty"		    => $Qty,
    	);

       $id = $this->orders_detailmodel->inserordersdetail($data); 
        if($id != ''){
    		$result = array(
    			"status"	=> "success",
    			"detail"	=> "ordersdetai compleated"
    		);
    	}else{
    		$result = array(
    			"status"	=> "error",
    			"detail"	=> "can not insert ordersdetail"
    		);
    	}
        $this->response($result,200);

    }

    public function ordersdetail_put()//รับค่าเปง post
    {
        $OrderID   = $this->put('OrderID');
        $ProductID  = $this->put('ProductID');
        $addressID = $this->put('addressID');
        $DetailID = $this->put('DetailID');
        $Qty =$this->put('qty');
        
        $data = array(
    		"OrderID"		=> $OrderID,
    		"ProductID"		=> $ProductID,
            "Qty"		    => $Qty,
            "DetailID"		=> $DetailID,
			
    	);

       $where = "DetailID = $DetailID";

       $this->orders_detailmodel->updateordersdetail($data,$where );

       $result = array(
        "status"	=> "success",
        "detail"	=> "update ordersdetail compleated"
    );
        $this->response($result,200);

    }


    public function ordersdetail_delete($DetailID)
    {
        $where = "DetailID = $DetailID";

        $this->orders_detailmodel->deleteordersdetail($where);

        $result = array(
            "status"	=> "success",
            "detail"	=> "delete ordersdetail compleated"
        );


        $this->response($result,200);
    }


}