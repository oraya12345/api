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

class Member extends RestController {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('membermodel');
    }

    public function index_get($str)
    {
		
    	$result = array(
    		"string_md5"	=> md5($str)
    	);
    	
    	$this->response($result,200);
    }

    public function login_get()
    {
    	$email = $this->get('email');
    	$password = md5($this->get('password'));
    	//$status = $this->get('status');

    	$result = $this->membermodel->loginMember($email,$password);
    	
    	if($result == null){
    		$result = array(
    			'status'	=> 'error',
    			'detail'	=> "username or password incorrect"
    		);
    	}

    	$this->response($result,200);
    }

    public function register_post()
    {
    	$password = $this->post("password");
    	$fname = $this->post("fname");
    	$lname = $this->post("lname");
    	$email = $this->post("email");
		$phone = $this->post("phone");
		$picture = $this->post("picture");

    	$data = array(
    		"password"		=> md5($password),
    		"fname"			=> $fname,
    		"lname"			=> $lname,
			"email"			=> $email,
			"memberStatus"	=> "user",
			"phone"			=> $phone,
			"picture"		=> $picture
    	);

    	$id = $this->membermodel->registerMember($data);

    	if($id != ''){
    		$result = array(
    			"status"	=> "success",
    			"detail"	=> "register compleated",
				"data"		=> $data
    		);
    	}else{
    		$result = array(
    			"status"	=> "error",
    			"detail"	=> "can not register"
    		);
    	}

    	$this->response($result,200);
    }

    public function checkusername_get()
    {
    	$username = $this->get("username");

    	$result = $this->membermodel->checkingUsername($username);

    	$this->response($result,200);
    }

    public function info_get()
    {
        $memberID = $this->get("memberID");
        $result = $this->membermodel->getMemberInfo($memberID);
        $this->response($result,200);
    } 

	public function info_put()
	{
    	$fname = $this->put("fname");
    	$lname = $this->put("lname");
    	$email = $this->put("email");
		$phone = $this->put("phone");
		$memberID = $this->put("memberID");
		$picture = $this->put("picture");

    	$data = array(
    		"fname"			=> $fname,
    		"lname"			=> $lname,
			"email"			=> $email,
			"phone"			=> $phone,
			"picture"		=> $picture
    	);
		$where = "memberID = $memberID";

		$this->membermodel->updateMember($data,$where);

		$result = array(
			"status"	=> "success",
			"detail"	=> "update member compleated"
		);

		$this->response($result,200);
	}

	public function member_get()
	{
		$status = $this->get('status');

		if($status == "all"){
			$result = $this->membermodel->getMember();
		}else{
			$result = array(
				"status"	=> "error",
				"detail"	=> "don't have this status"
			);
		}

		$this->response($result,200);
	}

}