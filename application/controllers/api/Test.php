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

class Test extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('testmodel');
    }

    public function user_get()
    {
        $res = $this->testmodel->getUser();
        $this->response($res, 200);
    }

    public function username_get()
    {
        $userID = $this->get('userID');

        $res = $this->testmodel->getUsername($userID);
        $this->response($res, 200);
    }


    public function user_post()
    {
        $username = $this->post('username');
        $password =  $this->post('password');
        $fname = $this->post('fname');
        $lname = $this->post('lname');
        $email = $this->post('email');

        $data = array(
            "username" => $username,
            "password" => $password,
            "fname" => $fname,
            "lname" => $lname,
            "email" => $email,
        );

        $id = $this->testmodel->insertUser($data);

        if($id > 0){
            $res = array(
                "status" => "success"
            ) ;
        }else{
            $res = array(
                "status" => "error"
            ) ;
        }
        
        $this->response($res, 200);
    }




    /*
    public function test_get()
    {
    	$this->response($result,200);
    }
    */
}
