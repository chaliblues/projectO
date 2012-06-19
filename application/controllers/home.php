<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('javascript');
        $this->load->model('opinionCategories_model');
        $this->load->model('opinionSubCategories_model');
        $this->load->model('opinions_model');
        $this->load->model('opiniontypes_model');
        $this->load->model('opinion_reviews_model');
        //Load helpers
        $this->load->helpers('users');
        $this->load->helpers('opinions');
    }

    /**
     * Index Page for this controller.
     */
    public function index() {
        $data['title'] = 'Welcome';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList'] = $this->opinions_model->get_latestOpinions();
        $data['opinionTypes'] = $this->opiniontypes_model->getOpinionTypes();

        $this->load->view('templates/header', $data);
        $this->load->view('home/home', $data);
        $this->load->view('templates/footer');
    }

    function post_action() {
        if (($_POST['username'] == "") || ($_POST['password'] == "")) {
            $message = "Please fill up blank fields";
            $bg_color = "#FFEBE8";
        } elseif (($_POST['username'] != "myusername") || ($_POST['password'] != "mypassword")) {
            $message = "Username and password do not match.";
            $bg_color = "#FFEBE8";
        } else {
            $message = "Username and password matched.";
            $bg_color = "#FFA";
        }

        $output = '{ "message": "' . $message . '", "bg_color": "' . $bg_color . '" }';
        echo $output;
    }

    function add_opinion() {
        $this->opinions_model->add_opinion();
        $message = "Success";
        $output = '{ "message": "' . $message . '"}';
        echo $output;
    }

    function get_subcategories() {
        if ($_POST['categoryID'] != NULL) {
            $categoryID = $_POST['categoryID'];
            $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories($categoryID);
        } else {
            $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        }

        $output = json_encode($data);

        // $output = '{ "subCategories": "'.$output.'"'; 
        echo $output;
    }
    
    function add_opinion_review() {
        $this->opinion_reviews_model->add_opinion_review();
        $message = "Success";
        $output = '{ "message": "' . $message . '"}';
        echo $output;
    }
    
    function get_opinion_reviews() {
        if (isset($_POST['opinionID']) and $_POST['opinionID'] != NULL) {
            $opinionID = $_POST['opinionID'];
            $data['opinionReviews'] = $this->opinion_reviews_model->get_opinionReviews($opinionID);
        } else {
            $data['opinionReviews'] = $this->opinion_reviews_model->get_opinionReviews();
        }

        $output = json_encode($data);

        // $output = '{ "subCategories": "'.$output.'"'; 
        echo $output;
    }


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */