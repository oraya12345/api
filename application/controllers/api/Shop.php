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

class Shop extends RestController {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('shopmodel');
    }

    public function shop_get()
    {
        $shopID = $this->get('shopID');
        
        if($shopID == 0){
            $result = $this->shopmodel->getShopAll();
        }else{
            $result = $this->shopmodel->getShopOne($shopID);
        }
        
        $this->response($result,200);
    }


    
/*
    public function test_get()
    {
    	$this->response($result,200);
    }
    */
}