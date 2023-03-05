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

class Login extends RestController {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->model('membermodel');
    }
    public function checklogin_get()
    {
        $memberID = $this->get('memberID');
        $result = $this ->loginmodel->check($memberID);

        
        $this->response($result,200); //ค่า200คือโหลดเสดแล้ว
    }

    public function checklogin_post()
    {
        $memberID = $this->post('memberID');
        echo " waenatiroh :".$memberID;
    }

    public function checklogin_put()
    {
        $memberID = $this->put('memberID');
        echo " waenatiroh : Put".$memberID;
    }

    public function checklogin_delete($memberID)
    {
        
        echo " Delete :".$memberID;
    }
}