<?php
class OpinionCategories_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_categories()
	{
		
			$query = $this->db->get('opinionCategories');
			return $query->result_array();
		
		
		return $query->row_array();
	}

}