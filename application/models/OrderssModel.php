<?php
class OrderssModel extends CI_model
{
    
    public function insertOders($data)
    {
        $this->db->insert("orders",$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }

    public function getOderssAll($memberID)
    {
        $where = "memberID = '".$memberID."'";
		$query = $this->db->select("*")
                     ->from("oders")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    
    public function getOdersOne($OrderID)
    {

        $where = "OrderID = '".$OrderID."'";
		$query = $this->db->select("*")
                     ->from("OrderID")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }
    
    public function updateOrders($data,$where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update("orders");
       
    }

    public function deleteOrders($where)
    {
        $this->db->delete("orders");
        $this->db->where($where);
    }

}
