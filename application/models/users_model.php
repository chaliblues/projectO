<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
    
    //Return user object
	public function get_user($id)
	{
		$query = $this->db->get_where('users', array('userID' => $id));
		return $query->row_array();
	}

	//Create user object
	public function create_user($userArray)
	{
		$data = array(
               'email' => $userArray['email'],
               'userName' => $userArray['userName'],
               'userNames' => $userArray['userNames'],
               'password' => $userArray['password'],
            );

		$result=$this->db->insert('users', $data); 
		return $result;

	}

	//Update user object
	public function update_user($id,$userArray)
	{
		$data = array(
               'email' => $userArray['email'],
               'userName' => $userArray['userName'],
               'userNames' => $userArray['userNames'],
               'mobileNo' => $userArray['mobileNo'],
            );

		$this->db->where('userID', $id);
		$result=$this->db->update('users', $data); 
		return $result;

	}

	//Update user object
	public function update_password($id,$password)
	{
		$data = array(
               'password' =>$password,
            );

		$this->db->where('userID', $id);
		$result=$this->db->update('users', $data); 
		return $result;

	}

	//Authenticate user
	public function authenticate_user($email,$password)
	{
		$query = $this->db->get_where('users', array('email' => $email,'password'=>$password));
		if($query->num_rows()>0)
		{
			//Authenticate user 
			return $query->row_array();

		}else{
			//User not found
			return NULL;
		}
		
	}

	//Forgot Password
	public function forgotPassword($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		if($query->num_rows()>0)
		{
			//Authenticate user 
			return 1;

		}else{
			//User not found
			return NULL;
		}
		
	}

}