<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opinions extends CI_Controller {
    
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
	 * Displays a list of the opinions
	 */
	public function listing($subCategoryID=NULL)
	{
		//Check if the user is logged in or not
		if($subCategoryID==NULL)
		{
			redirect('/', 'refresh');
		}
		
		$data['title'] = 'Welcome';
        //Get the opinionCategories and their subs
        $data['opinionCategories'] = $this->opinionCategories_model->get_categories();
        $data['opinionSubCategories'] = $this->opinionSubCategories_model->get_subCategories();
        $data['opinionsList']=$this->opinions_model->get_latestOpinions($subCategoryID);

		$this->load->view('templates/header', $data);
		$this->load->view('home/homeSubCategory', $data);
		$this->load->view('templates/footer');
	}
}

/* End of file opinions.php */
/* Location: ./application/controllers/opinions.php */