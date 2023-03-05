<?php

class Loginmodel extends CI_model 
{
    public function check($memberID)
    {
        $where = "memberID = '".$memberID."'";
		$query = $this->db->select("*")
                     ->from("member")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }
}
