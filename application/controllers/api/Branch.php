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

class Branch extends RestController {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('branchmodel');
    }

    public function branch_get()
    {
        $shopID = $this->get('shopID');
        $branchID = $this->get('branchID');

        if($branchID == 0){
            $result = $this->branchmodel->getBranchAll($shopID);
        }else{
            $result = $this->branchmodel->getBranchOne($branchID);
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