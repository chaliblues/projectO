<?php

class Opinions_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    //Return latest opinions
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

}