<?php

class Opinions_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    //Return latest opinions
<<<<<<< HEAD
	public function get_latestOpinions($subCatID=NULL)
	{
		if($subCatID==NULL)
		{
			$query = $this->db->get('opinions');
		    return $query->result_array();
		}else{
			$query = $this->db->get_where('opinions', array('opinionSubCategoryID	' => $subCatID));
		    return $query->result_array();
		}
		
	
	}

	//Return opinion type
	public function get_opinionType($id)
	{
		
		$query = $this->db->get_where('opinionTypes', array('opinionTypeID' => $id));
		return $query->row_array();
	
	}
=======
    public function get_latestOpinions() {
        $query = $this->db->from('opinions');
        //$query = $this->db->get('opinions');
        $query = $this->db->order_by('dateModified', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //Return opinion type
    public function get_opinionType($id) {

        $query = $this->db->get_where('opinionTypes', array('opinionTypeID' => $id));
        return $query->row_array();
    }

    public function add_opinion() {
        $this->load->helper('url');

        $data = array(
            'opinionTypeID' => $this->input->post('opinion_type'),
            'opinionSubCategoryID' => $this->input->post('opinion_sub_cat'),
            'opinionTitle' => $this->input->post('opinion_title'),
            'opinionNarrative' => $this->input->post('opinion_text'),
            'userID' => 1
        );

        return $this->db->insert('opinions', $data);
    }

    public function add_vote($opinionID, $vote_type) {
        $query = $this->db->get_where('opinions', array('opinionID' => $opinionID));
        $opinion = $query->row_array();
        
        $data = array();
        $this->load->helper('url');

        if ($vote_type == 1) {
            $data['agreeVotes'] = $opinion['agreeVotes'] + 1;
        } else if ($vote_type == 2) {
            $data['disagreeVotes'] = $opinion['disagreeVotes'] + 1;
        } else if ($vote_type == 3) {
            $data['helpfulVotes'] = $opinion['helpfulVotes'] + 1;
        } else if ($vote_type == 4) {
            $data['funnyVotes'] = $opinion['funnyVotes'] + 1;
        }
       
        $this->db->where('opinionID', $opinionID);
        $this->db->update('opinions', $data);
    }
>>>>>>> 59e7b0df32feb6a7e1438077214e2985a406a510

}