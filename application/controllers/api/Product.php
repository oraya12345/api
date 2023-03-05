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

class Product extends RestController {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('productmodel');
    }

    public function product_get()
    {
        $shopID = $this->get('shopID');
        $branchID = $this->get('branchID');
        $productID = $this->get('productID');
        if(isset($branchID)){
            $result = $this->productmodel->getProductBranch($branchID);
        }else if(isset($productID)){
            $result = $this->productmodel->getProduct($productID);
        }else{
            $result = $this->productmodel->getProductShop($shopID);
        }

        $this->response($result, 200);//ตัวส่งข้อมูล
        
    }

    

}