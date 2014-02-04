<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('opinionCategories_model');
        $this->load->model('opinionSubCategories_model');
        $this->load->model('opinions_model');
        $this->load->model('users_model');
        $this->load->model('opiniontypes_model');
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
        if (isset($this->session->userdata['userID'])) {
            $data['userID'] = $this->session->userdata['userID'];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('home/home', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Function to handle the login-authentication
     */
    public function loginSubmit() {
        //Validate the form
        $this->load->library('form_validation');

        //Set form rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

        //Set custom message
        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_message('valid_email', 'Invalid %s.');

        if ($this->form_validation->run() == FALSE) {
            //An error occurred
            $this->index();
        } else {
            //get the form values
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            //Authenticate
            $authResult = $this->users_model->authenticate_user($email, $password);
            if ($authResult == NULL) {
                //Failed authentication
                $this->session->set_flashdata('authStatus', 'Wrong email/password combination.'); //Set auth session
                $this->index();
            } else {
                $this->session->set_flashdata('authStatus', 'Logged in'); //Set auth session
                //Set user session
                $data = array(
                    'userID' => $authResult['userID'],
                    'userName' => $authResult['userName'],
                    'userNames' => $authResult['userNames'],
                    'age' => $authResult['age'],
                    'gender' => $authResult['gender'],
                    'mobileNo' => $authResult['mobileNo'],
                    'email' => $authResult['email'],
                    'logged_in' => TRUE,
                );

                $this->session->set_userdata($data);
                $this->index();
            }
        }
    }

    /**
     * Function to handle the logout
     */
    public function logout() {
        //Destroy session
        $this->session->sess_destroy();
        redirect('home', 'refresh');
    }

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */