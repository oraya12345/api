<?php
class productsmodel extends CI_model
{
    
    public function insertProduct($data)
    {
        $this->db->insert("product",$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }

    public function getProductAll($where)
    {
		$query = $this->db->select("*")
                     ->from("product")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    
    public function getProductOne($ProductID)
    {

        $where = "ProductID = '".$ProductID."'";
		$query = $this->db->select("*")
                     ->from("product")
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }
    
    public function updateProduct($data,$where)
    {
        $this->db->where($where);
        $this->db->set($data);
        $this->db->update("product");
    }

    public function deleteProduct($where)
    {
        $this->db->where($where);
        $this->db->delete("product");
    }

}
