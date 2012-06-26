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

    public function add_opinion($userID) {
        $this->load->helper('url');

        $data = array(
            'opinionTypeID' => $this->input->post('opinion_type'),
            'opinionSubCategoryID' => $this->input->post('opinion_sub_cat'),
            'opinionTitle' => $this->input->post('opinion_title'),
            'opinionNarrative' => $this->input->post('opinion_text'),
            'userID' => $userID
        );

        return $this->db->insert('opinions', $data);
    }

    public function add_vote($vote_type, $opinionID, $ipAddress, $userID = null) {
        if ($this->checkIfUserHadAlreadyVoted($opinionID, $ipAddress)) {
            return "ALREADY_VOTED";
        } else {
            return $this->save_vote($vote_type, $opinionID, $ipAddress, $userID);
        }
    }

    public function save_vote($vote_type, $opinionID, $ipAddress, $userID = null) {
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
        $status = $this->db->update('opinions', $data);

        if (!$status) {
            return $status;
        }
        return $this->save_user_vote($vote_type, $opinionID, $ipAddress, $userID);
    }

    private function save_user_vote($vote_type, $opinionID, $ipAddress, $userID = null) {
        $this->load->helper('url');
        $data = array(
            'opinionID' => $opinionID,
            'IP' => $ipAddress,
        );

        if ($vote_type == 1) {
            $data['agreeVotes'] = 1;
        } else if ($vote_type == 2) {
            $data['disagreeVotes'] = 1;
        } else if ($vote_type == 3) {
            $data['helpfulVotes'] = 1;
        } else if ($vote_type == 4) {
            $data['funnyVotes'] = 1;
        }

        if ($userID != NULL) {
            $data['userID'] = $userID;
        }

        return $this->db->insert('userVotes', $data);
    }

    private function checkIfUserHadAlreadyVoted($opinionID, $ipAddress) {
        $query = $this->db->get_where('userVotes', array('opinionID' => $opinionID, 'IP' => $ipAddress));
        //$row = $query->row_array();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}