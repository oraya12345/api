<?php 

/**
 * 
 */
class ProductModel extends CI_model
{
    public function getProductShop($shopID)
    {
        $where = "branch.shopID = '".$shopID."'";
		$query = $this->db->select("*")
                     ->from("product")
                     ->join('branch','branch.branchID = product.branchID')
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    public function getProductBranch($branchID)
    {
        $where = "product.branchID = '".$branchID."'";
		$query = $this->db->select("*")
                     ->from("product")
                     ->join('branch','branch.branchID = product.branchID')
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    public function getProduct($productID)
    {
        $where = "product.productID = '".$productID."'";
		$query = $this->db->select("*")
                     ->from("product")
                     ->join('branch','branch.branchID = product.branchID')
                     ->where($where)
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

    public function getProductAll()
    {
		$query = $this->db->select("*")
                     ->from("product")
                     ->join('branch','branch.branchID = product.branchID')
	                 ->get();
	    $result = $query->result();
	    return $result;
    }

}