<?php

/**
 * 
 */
class MemberModel extends CI_model
{
	public function getMember($where = "1=1")
	{
		$query = $this->db->select("memberID ,fname,lname,phone,email,memberStatus,picture")
			->from("member")
			->where($where)
			->get();
		$result = $query->result();
		return $result;
	}
	public function loginMember($email, $password)
	{
		$where = "email = '$email' AND password = '$password'";
		$query = $this->db->select("*")
			->from("member")
			->where($where)
			->get();
		$result = $query->result();
		return $result;
	}

	public function registerMember($data)
	{
		$this->db->insert("member", $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function checkingUsername($username)
	{
		$where = "username = '$username'";
		$query = $this->db->select("username")
			->from("member")
			->where($where)
			->get();
		$result = $query->result();
		return $result;
	}

	public function getMemberInfo($memberID)
	{
		$where = "memberID = '$memberID'";
		$query = $this->db->select("fname,lname,email,phone,picture")
			->from("member")
			->where($where)
			->get();
		$result = $query->result();
		return $result;
	}

	public function updateMember($data, $where)
	{
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update("member");
	}
}
