<?php 

/**
 * 
 */
class ShopModel extends CI_model
{
    public function getShopAll()
    {
		$query = $this->db->select("*")
	                 ->from("shop")
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    
    public function getShopOne($shopID)
    {
        $where = "shopID = '".$shopID."'";
		$query = $this->db->select("*")
                     ->from("shop")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }




}