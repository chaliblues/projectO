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

}