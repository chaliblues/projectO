<?php

class Opinion_reviews_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add_opinion_review($userID = NULL, $name = NULL, $email = NULL) {
        $this->load->helper('url');

        $data = array(
            'opinionID' => $this->input->post('opinion_id'),
            'opinionReview' => $this->input->post('opinion_review'),
        );

        if ($userID != NULL) {
            $data['userID'] = $userID;
        } else {
            if ($name != NULL) {
                $data['name'] = $name;
            }
            if ($email != NULL) {
                $data['email'] = $email;
            }
        }
        return $this->db->insert('opinionReviews', $data);
    }

    //Function to get the subcategories
    public function get_opinionReviews($opinion_id = NULL) {
        $query = NULL;
        if ($opinion_id != NULL) {
            $query = $this->db->get_where('opinionReviews', array('opinionID' => $opinion_id));
        } else {
            $query = $this->db->get('opinionReviews');
        }
        return $query->result_array();


        return $query->row_array();
    }

}