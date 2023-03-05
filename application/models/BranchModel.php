<?php 

/**
 * 
 */
class BranchModel extends CI_model
{
    public function getBranchAll($shopID)
    {
        $where = "shopID = '".$shopID."'";
		$query = $this->db->select("*")
                     ->from("branch")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    
    public function getBranchOne($branchID)
    {

        $where = "branchID = '".$branchID."'";
		$query = $this->db->select("*")
                     ->from("branch")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }




}