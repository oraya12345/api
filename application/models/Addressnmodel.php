<?php
class Addressnmodel extends CI_model
{
    
    public function insertAddress($data)
    {
        $this->db->insert("address",$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }

    public function getAddressAll($memberID)
    {
        $where = "memberID = '".$memberID."'";
		$query = $this->db->select("*")
                     ->from("address")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    
    public function getAddressOne($addressID)
    {

        $where = "addressID = '".$addressID."'";
		$query = $this->db->select("*")
                     ->from("address")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }
    
    public function updateAddress($data,$where)
    {
        $this->db->set($data);
        $this->db->update("address");
        $this->db->where($where);
    }

    public function deleteAddress($where)
    {
        $this->db->delete("address");
        $this->db->where($where);
    }

}
