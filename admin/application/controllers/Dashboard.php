<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller {

	public function __construct(){
		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		
		$this->load->model('dashboard_model', 'dashboard_model');
	}

	//--------------------------------------------------------------------------
	public function index(){

		$data['all_users'] = $this->dashboard_model->get_all_users();
		$data['photo_gallery'] = $this->dashboard_model->get_photogallery();
		$data['video_gallery'] = $this->dashboard_model->get_vide3ogallery();
		$tables = array(
				
			    '0' => 'ci_banners',
			    '1' => 'ci_career',
			    '2' => 'ci_categories',
			    '3' => 'ci_cms',
			    '4' => 'ci_gallery',
			    '5' => 'ci_inquiry',
			    '6' => 'ci_job_application',
			    '7' => 'ci_portfolio',
			    '8' => 'ci_products',
			 

		);
		for ($i=0; $i < count($tables); $i++) { 
			$coutnalltable[$tables[$i]] =  $this->db->count_all_results($tables[$i]);
		}


			
		$data['allcounts'] =$coutnalltable;
	
		$data['title'] = 'Dashboard';

		$this->load->view('includes/_header');
    	$this->load->view('dashboard/index', $data);
    	$this->load->view('includes/_footer');
	}

	 
	
}

?>	