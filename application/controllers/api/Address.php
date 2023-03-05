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
class Address extends RestController {

        public function __construct()
    {
        parent::__construct();
        $this->load->model('addressnmodel');//การเรียกช่ายโมดู
    }
    public function address_get()
    {
        $addressID = $this->get('addressID');
        $memberID = $this->get('memberID');

        if($memberID != 0){
            $result = $this->addressnmodel->getAddressAll($memberID);
        }else{
            $result = $this->addressnmodel->getAddressOne($addressID);
        }
        
        $this->response($result,200);
    }

    public function address_post()//รับค่าเปง post
    {
        $address = $this->post('address');
        $postCode = $this->post('postCode');
        $memberID = $this->post('memberID');

        $data = array(
    		"address"		=> $address,
    		"postCode"		=> $postCode,
			"memberID"		=> $memberID,
    	);

       $id = $this->addressnmodel->insertAddress($data); 
        if($id != ''){
    		$result = array(
    			"status"	=> "success",
    			"detail"	=> "Address compleated"
    		);
    	}else{
    		$result = array(
    			"status"	=> "error",
    			"detail"	=> "can not insert Address"
    		);
    	}
        $this->response($result,200);

    }

    public function address_put()//รับค่าเปง post
    {
        $address   = $this->put('address');
        $postCode  = $this->put('postCode');
        $addressID = $this->put('addressID');

        $data = array(
    		"address"		=> $address,
    		"postCode"		=> $postCode,
			"addressID"     => $addressID,
    	);

       $where = "addressID = $addressID";

       $this->addressnmodel->updateAddress($data,$where );

       $result = array(
        "status"	=> "success",
        "detail"	=> "update Address compleated"
    );
        $this->response($result,200);

    }


    public function address_delete($addressID)
    {
        $where = "addressID = $addressID";

        $this->addressnmodel->deleteAddress($where);

        $result = array(
            "status"	=> "success",
            "detail"	=> "delete Address compleated"
        );


        $this->response($result,200);
    }


}