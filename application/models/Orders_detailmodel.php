<?php
class Orders_detailmodel extends CI_model
{
    
    public function inserordersdetail($data)
    {
        $this->db->insert("orders_detail",$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }

    public function getorders_detailAll($OrderID)
    {
        $where = "OrderID = '".$OrderID."'";
		$query = $this->db->select("*")
                     ->from("orders_detail")
                     ->join("product","orders_detail.ProductID = product.ProductID","inner")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    
    public function getorders_detaiOne($DetailID)
    {

        $where = "	DetailID = '".$DetailID."'";
		$query = $this->db->select("*")
                     ->from("orders_detail")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }
    
    public function updateordersdetail($data,$where)
    {
        $this->db->set($data);
        $this->db->update("orders_detail");
        $this->db->where($where);
    }

    public function deleteordersdetail($where)
    {
        $this->db->delete("orders_detail");
        $this->db->where($where);
    }

}
