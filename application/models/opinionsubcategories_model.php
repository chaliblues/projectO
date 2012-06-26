<?php

class OpinionSubCategories_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    //Function to get the subcategories
    public function get_subCategories($cat_id = NULL) {
        $query = NULL;
        if ($cat_id != NULL) {
            $query = $this->db->get_where('opinionSubCategories', array('categoryID' => $cat_id));
        } else {
            $query = $this->db->get('opinionSubCategories');
        }
        return $query->result_array();


        return $query->row_array();
    }

    //Return a subcategory object
    public function get_subCategory($id) {
        $query = $this->db->get_where('opinionSubCategories', array('opinionSubCategoryID' => $id));
        return $query->row_array();
    }

}