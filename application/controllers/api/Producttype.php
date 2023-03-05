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
class Producttype extends RestController {

    
        public function __construct()
    {
        parent::__construct();
        $this->load->model('producttypemodel');//การเรียกช่ายโมดู
    }
    public function producttype_get()
    {
        $productTypeID = $this->get('productTypeID');

        if($productTypeID != ""){
            $result = $this->producttypemodel->getproducttypeOne($productTypeID);
        }else{
            $result = $this->producttypemodel->getAddressAll();
        }
        
        $this->response($result,200);
    }

    public function ProductType_post()//รับค่าเปง post
    {
        $productTypeName = $this->post('productTypeName');

        $data = array(
    		"productTypeName"		=> $productTypeName
    	);

       $id = $this->producttypemodel->insertProductType($data); 
        if($id != ''){
    		$result = array(
    			"status"	=> "success",
    			"detail"	=> "ProductType compleated"
    		);
    	}else{
    		$result = array(
    			"status"	=> "error",
    			"detail"	=> "can not insert ProductType"
    		);
    	}
        $this->response($result,200);

    }

    public function ProductType_put()//รับค่าเปง post
    {
        $productTypeName   = $this->put('productTypeName');
        $productTypeID = $this->put('productTypeID');

        $data = array(
    		"productTypeName"		=> $productTypeName,
			
    	);

       $where = "productTypeID = $productTypeID";

       $this->producttypemodel->updateProductType($data,$where );

       $result = array(
        "status"	=> "success",
        "detail"	=> "update ProductType compleated"
    );
        $this->response($result,200);

    }


    public function ProductType_delete($productTypeID)
    {
        $where = "productTypeID = $productTypeID";

        $this->producttypemodel->deleteProductType($where);

        $result = array(
            "status"	=> "success",
            "detail"	=> "delete ProductType compleated"
        );


        $this->response($result,200);
    }


}