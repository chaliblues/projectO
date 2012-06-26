<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		$this->load->model('opinionCategories_model');
		$this->load->model('opinionSubCategories_model');
		$this->load->model('opinions_model');
		$this->load->model('users_model');
		//Load helpers
		$this->load->helpers('users');
		$this->load->helpers('opinions');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		
		$data['title'] = 'Welcome';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions();

		$this->load->view('templates/header', $data);
		$this->load->view('home/home', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Home - Logged in Page for this controller.
	 */
	public function home()
	{
		$data['title'] = 'Home';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions();

		$this->load->view('templates/header', $data);
		$this->load->view('home/homeLoggedIn', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Sign up user profile 
	 */
	public function signUp()
	{
		$data['title'] = 'Sign Up';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions();

		$this->load->view('templates/header', $data);
		$this->load->view('users/signUp', $data);
		$this->load->view('templates/footer');
	}
    
    /**
	 * Function to handle the signUpSubmit
	 */
	public function signUpSubmit()
	{
		
		
		//Validate the form
        $this->load->library('form_validation');

        //Set form rules
		$this->form_validation->set_rules('email_s', 'Email', 'trim|required|valid_email|is_unique[users.email.userID.'.$this->session->userdata('userID').']');
		$this->form_validation->set_rules('userName_s', 'Username', 'trim|required|is_unique[users.userName.userID.'.$this->session->userdata('userID').']');
        $this->form_validation->set_rules('userNames_s', 'Names', 'trim|required');
		$this->form_validation->set_rules('password_s', 'Password', 'trim|min_length[5]|required|md5');
        //Set custom message
        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_message('valid_email', 'Invalid %s.');

		if ($this->form_validation->run() == FALSE)
		{
			//An error occurred
			$this->signUp();
		}
		else
		{
			//get the form values
			$email = $this->input->post('email_s');
			$userName = $this->input->post('userName_s');
			$userNames = $this->input->post('userNames_s');
			$password = $this->input->post('password_s');

			//Update user
			$userArray=array('email' =>$email,
                              'userName'=>$userName,
                              'userNames'=>$userNames,
                              'password'=>$password,
			 );
			$result=$this->users_model->create_user($userArray);
			
			if($result!=1)
			{
				//Failed edit
				$this->session->set_flashdata('signUpStatus', '<font color="red">An error occurred, please try again.</font>');
				$this->signUp();
			}else{
				$this->session->set_flashdata('editStatus', '<font color="green">Successfully signed up</font>');//Set auth session
				$authResult=$this->users_model->authenticate_user($email,$password);
				//Set new user session
				$data = array(
				   'userID'    => $authResult['userID'],
                   'userName'  => $authResult['userName'],
                   'userNames' => $authResult['userNames'],
                   'age'       => $authResult['dateOfBirth'],
                   'gender'    => $authResult['gender'],
                   'mobileNo'  => $authResult['mobileNo'],
                   'email'     => $authResult['email'],
                   'logged_in' => TRUE,
                );

				$this->session->set_userdata($data);
				redirect('users/editProfile', 'refresh');
			}
			
		}
	}

	/**
	 * User profile 
	 */
	public function profile($id=NULL)
	{
		$data['title'] = 'Profile';
		$data['userID']=(int)$id;
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions();

		$this->load->view('templates/header', $data);
		$this->load->view('users/profile', $data);
		$this->load->view('templates/footer');
	}

    /**
	 * Forgot password 
	 */
	public function forgotPassword()
	{
		$data['title'] = 'Forgot Password';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions();

		$this->load->view('templates/header', $data);
		$this->load->view('users/forgotPassword', $data);
		$this->load->view('templates/footer');
	}

	    /**
	 * Function to handle the forgotPassword submit
	 */
	public function forgotPasswordSubmit()
	{
		
		
		//Validate the form
        $this->load->library('form_validation');

        //Set form rules
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
        //Set custom message
        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_message('valid_email', 'Invalid %s.');

		if ($this->form_validation->run() == FALSE)
		{
			//An error occurred
			$this->forgotPassword();
		}
		else
		{
			//get the form values
			$email = $this->input->post('email');
			
			$result=$this->users_model->forgotPassword($email);
			
			if($result!=1)
			{
				//Failed edit
				$this->session->set_flashdata('editStatus', '<font color="red">That email address is not in our records.</font>');
				$this->forgotPassword();
			}else{
				$this->session->set_flashdata('editStatus', '<font color="green">Successfully edited profile.</font>');//Set auth session
			
				$this->forgotPassword();
			}
			
		}
	}


    /**
	 * Change password 
	 */
	public function changePassword()
	{
		$data['title'] = 'Change Password';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions();

		$this->load->view('templates/header', $data);
		$this->load->view('users/changePassword', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Function to handle the changePasswordSubmit
	 */
	public function changePasswordSubmit()
	{
		
		
		//Validate the form
        $this->load->library('form_validation');

        //Set form rules
        $this->form_validation->set_rules('password', 'New Password', 'trim|min_length[5]|required|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'Confirm Password', 'trim|required');
        //Set custom message
        $this->form_validation->set_message('required', '%s is required.');
        

		if ($this->form_validation->run() == FALSE)
		{
			//An error occurred
			$this->changePassword();
		}
		else
		{
			//get the form values
			
			$password = $this->input->post('password');
			
			$result=$this->users_model->update_password($this->session->userdata('userID'),$password);
			
			if($result!=1)
			{
				//Failed edit
				$this->session->set_flashdata('editStatus', '<font color="red">An error occurred, please try again.</font>');
				$this->changePassword();
			}else{
				$this->session->set_flashdata('editStatus', '<font color="green">Successfully changed  password.</font>');//Set auth session
				$this->logout();
			}
			
		}
	}

	/**
	 * Edit user profile 
	 */
	public function editProfile()
	{
		$data['title'] = 'Edit Profile';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions();

		$this->load->view('templates/header', $data);
		$this->load->view('users/editProfile', $data);
		$this->load->view('templates/footer');
	}

    /**
	 * Function to handle the editProfileSubmit
	 */
	public function editProfileSubmit()
	{
		
		
		//Validate the form
        $this->load->library('form_validation');

        //Set form rules
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email.userID.'.$this->session->userdata('userID').']');
		$this->form_validation->set_rules('userName', 'userName', 'trim|required|is_unique[users.userName.userID.'.$this->session->userdata('userID').']');
        $this->form_validation->set_rules('userNames', 'userNames', 'trim|required');
		$this->form_validation->set_rules('mobileNo', 'mobileNo', 'trim|required|is_unique[users.mobileNo.userID.'.$this->session->userdata('userID').']');
        //Set custom message
        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_message('valid_email', 'Invalid %s.');

		if ($this->form_validation->run() == FALSE)
		{
			//An error occurred
			$this->editProfile();
		}
		else
		{
			//get the form values
			$email = $this->input->post('email');
			$userName = $this->input->post('userName');
			$userNames = $this->input->post('userNames');
			$mobileNo = $this->input->post('mobileNo');

			//Update user
			$userArray=array('email' =>$email,
                              'userName'=>$userName,
                              'userNames'=>$userNames,
                              'mobileNo'=>$mobileNo,
			 );
			$result=$this->users_model->update_user($this->session->userdata('userID'),$userArray);
			
			if($result!=1)
			{
				//Failed edit
				$this->session->set_flashdata('editStatus', '<font color="red">An error occurred, please try again.</font>');
				$this->editProfile();
			}else{
				$this->session->set_flashdata('editStatus', '<font color="green">Successfully edited profile.</font>');//Set auth session
				//Set new user session
				$data = array(
                   'userName'  => $userName,
                   'userNames' => $userNames,
                   'mobileNo'  => $mobileNo,
                   'email'     => $email,
                  
                );

				$this->session->set_userdata($data);
				$this->editProfile();
			}
			
		}
	}


	/**
	 * Function to handle the login-authentication
	 */
	public function loginSubmit()
	{
		
		
		//Validate the form
        $this->load->library('form_validation');

        //Set form rules
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');

        //Set custom message
        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_message('valid_email', 'Invalid %s.');

		if ($this->form_validation->run() == FALSE)
		{
			//An error occurred
			$this->index();
		}
		else
		{
			//get the form values
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			//Authenticate
			$authResult=$this->users_model->authenticate_user($email,$password);
			if($authResult==NULL)
			{
				//Failed authentication
				$this->session->set_flashdata('authStatus', 'Wrong email/password combination.');//Set auth session
				$this->index();
			}else{
				$this->session->set_flashdata('authStatus', 'Logged in');//Set auth session
				//Set user session
				$data = array(
				   'userID'    => $authResult['userID'],
                   'userName'  => $authResult['userName'],
                   'userNames' => $authResult['userNames'],
                   'age'       => $authResult['dateOfBirth'],
                   'gender'    => $authResult['gender'],
                   'mobileNo'  => $authResult['mobileNo'],
                   'email'     => $authResult['email'],
                   'logged_in' => TRUE,
                );

				$this->session->set_userdata($data);
				$this->home();
			}
			
		}
	}

	/**
	 * Function to handle the logout
	 */
	public function logout(	)
	{
	  //Destroy session
      $this->session->sess_destroy();

      redirect('home', 'refresh');
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */