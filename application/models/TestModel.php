<?php
class TestModel extends CI_model
{
    public function getUser()
    {
        $query = $this->db->select("userID,username,fname,lname")
            ->from("member")
            ->get();
        $result = $query->result();
        return $result;
    }

    public function getUsername($userID)
    {

        $query = $this->db->select("userID,username,fname,lname")
            ->from("member")
            ->where("userID = '$userID'")
            ->get();
        $result = $query->result();
        return $result;
    }

    public function insertUser($data)
    {
        $this->db->insert("member",$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }

    public function getShop()
    {
        $query = $this->db->select("*")
            ->from("shop")
            ->join("member","shop.memberID = member.memberID")
            ->join("branch","shop.shopID = branch.shopID")
            ->get();
        $result = $query->result();
        return $result;
    }
}
