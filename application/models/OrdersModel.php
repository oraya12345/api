<?php
    class OrdersModel extends CI_model 
    {
        public function getOrderOne($orderID,$userID)
        {
            $where = "orderID = '".$orderID."' AND userID = '".$userID."'";
            $query = $this->db->select("*")
                     ->from("orders")
                     ->where($where)
	                 ->get();
            $result = $query->result();
            return $result;
        }

        public function getOrderAll($where ="1=1")
        {
            $query = $this->db->select("*")
                     ->from("orders")
                     ->join("member","orders.memberID = member.memberID","inner")
                     ->where($where)
	                 ->get();
            $result = $query->result();
            return $result;
        }

        public function insertOrder($data)
        {
            $this->db->insert("orders",$data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }

        public function insertOrderDetail($data)
        {
            $this->db->insert("orders_detail",$data);
            $insert_id = $this->db->insert_id();
        }
    }
    