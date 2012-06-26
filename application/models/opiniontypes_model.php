<?php
class OpinionTypes_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
    
    //Return latest opinions
	public function getOpinionTypes()
	{
		
		$query = $this->db->get('opinionTypes');
		return $query->result_array();
	
	}

}