<?php
class ProducttypeModel extends CI_model
{
    
    public function insertProductType($data)
    {
        $this->db->insert("producttype",$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }

    public function getAddressAll($where = "1=1")
    {
		$query = $this->db->select("*")
                     ->from("producttype")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    
    public function getAddressOne($productTypeID)
    {

        $where = "productTypeID = '".$productTypeID."'";
		$query = $this->db->select("*")
                     ->from("producttype")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }
    
    public function updateProductType($data,$where)
    {
        $this->db->set($data);
        $this->db->update("producttype");
        $this->db->where($where);
    }

    public function deleteProductType($where)
    {
        $this->db->delete("producttype");
        $this->db->where($where);
    }

}
