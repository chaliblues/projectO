<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		$this->load->model('opinionCategories_model');
		$this->load->model('opinionSubCategories_model');
		$this->load->model('opinions_model');
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
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */