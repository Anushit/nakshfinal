<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

	public function __construct(){
		parent::__construct(); 
		$this->load->model('setting_model', 'setting_model'); 
		$this->load->model('category_model', 'category_model');
        $this->load->model('auth_model', 'auth_model');
		$this->load->model('product_model', 'product_model');
		$this->load->model('service_model', 'service_model');
        $this->load->model('portfolio_model', 'portfolio_model'); 
		$this->load->model('cms_model', 'cms_model'); 
		$this->load->model('site_image_model', 'site_image_model');  
		$this->load->model('inquiry_model', 'inquiry_model'); 
		$this->load->model('career_model', 'career_model'); 
        $this->load->model('user_model', 'user_model'); 
        $this->load->model('subadmin_model', 'subadmin_model'); 
        //$this->load->model('admission_model', 'admission_model'); 
        		
	}
 
	public function setting_get($id = null){
		$data = [];
		if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
			$global_data = [];
			$general_settings = [];	
			$all_general_settings = [];		
			$type = $id;
	        $general_settings_data = $this->setting_model->get_general_settings();
	        foreach ($general_settings_data as $skey => $svalue) {
	           $global_data['general_settings'][$svalue['setting_type']][$svalue['setting_name']]= $svalue['filed_value'];
	           $all_general_settings[$svalue['setting_name']]= $svalue['filed_value'];
	        } 
	        if(!empty($type)){
	        	$general_settings = $global_data['general_settings'][$type];
	        }else{
	        	$general_settings = $all_general_settings;
	        } 
			if($general_settings){
				$data = $general_settings;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}
 	
 	public function allcategory_post(){ 
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {        
        	$retdata = [];
            $start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $order_field = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order_by = !empty($this->post('order'))?$this->post('order'):'ASC';

        	$wh = !empty($this->post('where'))?$this->post('where'):'';
			$SQL ='SELECT *,(select count(*) as total from ci_product_to_category as p2c where p2c.category_id=c.id) as totpro FROM ci_categories as c';
			if(!empty($wh))
			{
				$SQL .= " where " . $wh;
			}
			if (($order_field != '')) { 
				$SQL .= " ORDER BY " . $order_field . " " . $order_by;
			}
        	if (($start!=0) || ($limit!=0)) { 
				$SQL .= " LIMIT " . (int)$start . "," . (int)$limit;
			}  
			$query = $this->db->query($SQL);
			$retdata = $query->result_array();
	        /*switch ($type) {
	            case 'count': $retdata = $query->num_rows();
	            case 'array': $retdata = $query->row_array();
	            default: $retdata = $query->result_array();
	        }*/
	        if($retdata){
				$data = $retdata;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }

    public function cms_get($id = null){
		$data = [];
		if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
			$cms_data = []; 
	        $general_cms_data = $this->cms_model->get_cms_by_id($id);
			if($general_cms_data){
				$data = $general_cms_data;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	public function listing_post(){  
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {        
        	$retdata = [];
            $start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $order_field = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order_by = !empty($this->post('order'))?$this->post('order'):'ASC';

        	$wh = !empty($this->post('where'))?$this->post('where'):'';
			$SQL ='SELECT * FROM '.$this->post('table');
			if(!empty($wh))
			{
				$SQL .= " where " . $wh;
			}
			if (($order_field != '')) { 
				$SQL .= " ORDER BY " . $order_field . " " . $order_by;
			}
        	if (($start!=0) || ($limit!=0)) { 
				$SQL .= " LIMIT " . (int)$start . "," . (int)$limit;
			}  
			$query = $this->db->query($SQL);

			$retdata = $query->result_array(); 
			//print_r($SQL);die();
	        if($retdata){
				$data = $retdata;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }

    public function countrylisting_post(){  
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {        
        	$retdata = [];
            $start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $order_field = !empty($this->post('sort'))?$this->post('sort'):"name";
            $order_by = !empty($this->post('order'))?$this->post('order'):'ASC';

        	$wh = !empty($this->post('where'))?$this->post('where'):'';
			$SQL ='SELECT * FROM '.$this->post('table');
			if(!empty($wh))
			{
				$SQL .= " where " . $wh;
			}
			if (($order_field != '')) { 
				$SQL .= " ORDER BY " . $order_field . " " . $order_by;
			}
        	if (($start!=0) || ($limit!=0)) { 
				$SQL .= " LIMIT " . (int)$start . "," . (int)$limit;
			}  
			$query = $this->db->query($SQL);

			$retdata = $query->result_array(); 
			//print_r($SQL);die();
	        if($retdata){
				$data = $retdata;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }
   
    public function galleryDetail_post(){  
		if ($this->input->server('REQUEST_METHOD') == 'POST')
        {        
        	$retdata = [];
            $start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $order_field = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order_by = !empty($this->post('order'))?$this->post('order'):'ASC';

        	$wh = !empty($this->post('where'))?$this->post('where'):'';
			
			$SQL ='SELECT * FROM '.$this->post('table');  
			if(!empty($wh))
			{
				$SQL .= " where " . $wh;
			}

			
			if (($order_field != '')) { 
				$SQL .= " ORDER BY " . $order_field . " " . $order_by;
			}
        	if (($start!=0) || ($limit!=0)) { 
				$SQL .= " LIMIT " . (int)$start . "," . (int)$limit;
			}  
			 
			$query = $this->db->query($SQL);
			$retdata = $query->result_array(); 
	        if($retdata){
				$data = $retdata;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        } 
    }

public function productlist_post(){  
	if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {        
        	$retdata = [];
            $start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $order_field = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order_by = !empty($this->post('order'))?$this->post('order'):'ASC';
            $search = !empty($this->post('search'))?$this->post('search'):'';
          // print_r($search); exit;


        	$wh = !empty($this->post('where'))?$this->post('where'):'';
			$SQL ='SELECT p.*,(select image from ci_product_image pi where pi.product_id=p.id order by sort_order ASC LIMIT 1 ) as image FROM ci_products p';  
            //print_r($SQL);die;
			if(!empty($wh))
			{
				$SQL .= " where " . $wh;
			}
			if(!empty($search))
			{
				$SQL .= "where name like %".$search."%";
			}


			$SQL .= " GROUP by p.id";
			
			if (($order_field != '')) { 
				$SQL .= " ORDER BY " . $order_field . " " . $order_by;
			}
        	if (($start!=0) || ($limit!=0)) { 
				$SQL .= " LIMIT " . (int)$start . "," . (int)$limit;
			}  
			 
			$query = $this->db->query($SQL);
			$retdata = $query->result_array(); 
	        if($retdata){
				$data = $retdata;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        } 
}

public function getproducts_post(){

        if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {      
            $cat_id = !empty($this->post('cat_id'))?$this->post('cat_id'):null;
            $search = !empty($this->post('search'))?$this->post('search'):null;
            $limit = !empty($this->post('per_page'))?$this->post('per_page'):null;
            $page = !empty($this->post('page'))?$this->post('page'):1;
            $start = ($page-1)*$limit;

            $product_data = $this->product_model->allproducts($cat_id,$search,$start,$limit);
            $count_data = $this->product_model->count_product();
            if($product_data){
                
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $product_data,
                    'count_data'=>$count_data
                   
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response("invalid request", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{ 
            $this->response("invalid request", REST_Controller::HTTP_BAD_REQUEST);
        }         
    }

public function saveinquery_post(){ 

		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {        
        	$linkID = ($this->input->post('link_id'))?$this->input->post('link_id'):0;
        	$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('code')." ".$this->input->post('mobile'),
				'subject' => $this->input->post('subject'),
				'message' => $this->input->post('message'),				
				'ip_address' => $_SERVER['REMOTE_ADDR'],
				'inquiry_mode' => 1, 
				'inquiry_type' => !empty($this->input->post('inquiry_type'))?$this->input->post('inquiry_type'):1, 
				'link_id' => $linkID, 
				'created_at' => date('Y-m-d : h:m:s'),
				'updated_at' => date('Y-m-d : h:m:s'),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->inquiry_model->addgernalinquery($data);
			//print_r($result);die();
			$general_settings_data = $this->setting_model->get_general_settings(1);
			foreach ($general_settings_data as $skey => $svalue) {
	           $global_data['general_settings'][$svalue['setting_type']][$svalue['setting_name']]= $svalue['filed_value'];
	           $all_general_settings[$svalue['setting_name']]= $svalue['filed_value'];
	        }  
            if($result){
            	$msg = 'Your inquiry sent successfully to Administrator.';	 
				//sending welcome email to user
				$this->load->helper('email_helper');
				$name = $all_general_settings['application_name']; 
				$body = $this->input->post('message');
				$to = $all_general_settings['email'];
				$subject = $this->input->post('subject');
				$message =  $body;

				$email = send_email($to, $subject, $message, $file = '' , $cc = '');
				if($email){
					$msg = 'Your inquiry sent successfully to Administrator.';	 
				}	
				else{
					$msg = 'Email Error';
				}
			} 
	        if($result){
				$data = [];	
				$this->response([
                    'status' => TRUE,
                    'message' => $msg,
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }

    public function saveadmission_post(){ 
    	//print_r($_POST);die;
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {     

        	
    	//print_r($_FILES);die;
          
        	$data = array(
				'firstname' => $this->input->post('firstname'),
				'middlename' => $this->input->post('middlename'),
				'lastname' => $this->input->post('lastname'),
				'fathername' => $this->input->post('fathername'),
				'mothername' => $this->input->post('mothername'),
				'dob' => $this->input->post('dob'),
				'gender' => $this->input->post('gender'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'class' => $this->input->post('class'),
				'course' => $this->input->post('course'),				
				'address' => $this->input->post('address'),				
				'created_at' => date('Y-m-d : h:m:s'),
				'updated_at' => date('Y-m-d : h:m:s'),
			);
        	//print_r($data);die();
    		$path="upload/";
        	

            //print_r($_FILES['image']['name']);die();
        	if(!empty($_FILES['image']['name']))
				{
										
					$result = $this->functions->file_insert($path,'image','image', '9097152');
				
					if($result['status'] == 1){
						$data['image'] = $path.$result['msg'];
					}
					else{
						$this->session->set_flashdata('error', $result['msg']);
						
					}
				}
				
				
			//print_r($data);die();
			$data = $this->security->xss_clean($data);
			$result = $this->admission_model->addadmission($data);
			//print_r($result);die();
			  
            if($result){
            	$msg = 'Your Addmission Form Received Successfully.';	 
				//sending welcome email to user
				
			} 
	        if($result){
				$data = [];	
				$this->response([
                    'status' => TRUE,
                    'message' => $msg,
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }



	public function category_get($id = null){
		$data = [];
		if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
			$cms_data = []; 
	        $category_data = $this->category_model->get_category_by_slug($id);
			if($category_data){
				$data = $category_data;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	public function totalproduct_post(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {  
        	$start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
           
 			//$category_id = !empty($this->post('category_id'))?$this->post('category_id'):'0';
 			$slug = !empty($this->post('category_id'))?$this->post('category_id'):'0';
 		
 			
 			$reqdata = array(
        		'start'=> $start,
        		'limit'=> $limit,
        		//'category_id'=> $category_id,
        	    'slug'=> $slug,
        		
        	);       
        		
        	$retdata = [];
            $total_product_data = $this->product_model->getTotalProducts($reqdata);
            // print_r($category_id);die;
             
			$data = $total_product_data;	
			$this->response([
                'status' => TRUE,
                'message' => 'Successful.',
                'data' => $data
            ], REST_Controller::HTTP_OK);
			 
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	public function allproducts_post(){ 
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {
			$start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $sort = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order = !empty($this->post('order'))?$this->post('order'):'ASC';
 			$category_id = !empty($this->post('category_id'))?$this->post('category_id'):'0';
 			
 
        	$reqdata = array(
        		'start'=> $start,
        		'limit'=> $limit,
        		'category_id'=> $category_id,
        		'sort'=> $sort,
        		'order'=> $order,
        	); 
        	$retdata = [];
        	$total_product_data = $this->product_model->getProducts($reqdata);
			 
				$data = $total_product_data;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			 
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}


	public function totalservice_post(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {  
        	$start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $sort = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order = !empty($this->post('order'))?$this->post('order'):'ASC'; 
 			
 			$reqdata = array(
        		'start'=> $start,
        		'limit'=> $limit, 
        		'sort'=> $sort,
        		'order'=> $order,
        	);        	
        	$retdata = [];
            $total_service_data = $this->service_model->getTotalService($reqdata);
             
			$data = $total_service_data; 
			$this->response([
                'status' => TRUE,
                'message' => 'Successful.',
                'data' => $data
            ], REST_Controller::HTTP_OK);
			 
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	public function allservice_post(){ 
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {
			$start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $sort = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order = !empty($this->post('order'))?$this->post('order'):'ASC'; 
 
        	$reqdata = array(
        		'start'=> $start,
        		'limit'=> $limit, 
        		'sort'=> $sort,
        		'order'=> $order,
        	); 
        	$retdata = [];
        	$total_service_data = $this->service_model->getService($reqdata);
			 
				$data = $total_service_data;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			 
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	public function portfolioimage_post(){  
		 if ($this->input->server('REQUEST_METHOD') == 'POST') 
        { 
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';

			
            $total_service_data = $this->portfolio_model->get_portfolioim($limit);

                $data = $total_service_data;    
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
             
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
    }

    public function totalportfolio_post(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {  
            $start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $sort = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order = !empty($this->post('order'))?$this->post('order'):'ASC'; 
            
            $reqdata = array(
                'start'=> $start,
                'limit'=> $limit, 
                'sort'=> $sort,
                'order'=> $order,
            );          
            $retdata = [];
            $total_service_data = $this->portfolio_model->getTotalPortfolio($reqdata);
             
            $data = $total_service_data; 
            $this->response([
                'status' => TRUE,
                'message' => 'Successful.',
                'data' => $data
            ], REST_Controller::HTTP_OK);
             
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
    }

    public function allportfolio_post(){ 
        if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {
            $start = !empty($this->post('start'))?$this->post('start'):'0';
            $limit = !empty($this->post('limit'))?$this->post('limit'):'0';
            $sort = !empty($this->post('sort'))?$this->post('sort'):'created_at';
            $order = !empty($this->post('order'))?$this->post('order'):'ASC'; 
 
            $reqdata = array(
                'start'=> $start,
                'limit'=> $limit, 
                'sort'=> $sort,
                'order'=> $order,
            ); 
            $retdata = [];
            $total_service_data = $this->portfolio_model->getportfolio($reqdata);
             
                $data = $total_service_data;    
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
             
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
    }

    

	public function product_get($id = null){

		$data = [];
		if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
			$cms_data = []; 
	        $product_data = $this->product_model->getProductdetail($id);
	        $product_img  = $this->product_model->getProductimages($id);
			if($product_data){
				$data['product'] = $product_data;
				$data['image'] = $product_img;	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response("invalid request", REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{ 
            $this->response("invalid request", REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	

    public function portfolio_get($id = null){
        $data = [];
        if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
            $cms_data = []; 
            $product_data = $this->portfolio_model->getPortfoliodetail($id); 
            $product_img  = $this->portfolio_model->getPortfolioimages(@$product_data['id']);
            
            if($product_data){
                $data['product'] = $product_data;
                $data['image'] = $product_img;  
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
    }

	public function productData_get($id = null){
		$data = [];
		if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
			$cms_data = []; 
	        $product_data = $this->product_model->get_product_by_slug($id);  
			if($product_data){ 
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $product_data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	public function serviceData_get($id = null){
		$data = [];
		if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
			$cms_data = []; 
	        $service_data = $this->service_model->get_service_by_slug($id);  
			if($service_data){ 
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $service_data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}

	public function sideimage_get($id = null){
		$data = [];
		if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {
			$cms_data = []; 
	        $imageData = $this->site_image_model->get_siteimage_by_id($id); 
			if($imageData){ 
				$data['image'] = $imageData['image'];	
				$this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{
				$this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}
 
	public function savenewsletter_post(){ 
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        { 
 			$email = !empty($this->input->post('email'))?$this->input->post('email'):'0'; 
 			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|is_unique[ci_newsletter.email]');
        	if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->response([
                    'status' => FALSE,
                    'message' => "Error",
                    'data' => $data
                ], REST_Controller::HTTP_OK);
			}else{ 
	        	$reqdata = array(
	        		'email'=> $email,
	        		'status' => 1,
	        		'created_at' => date('Y-m-d'),
	        		'updated_at' => date('Y-m-d'),
	        		'deleted' => 0,
	        	); 
	        	$result = $this->newsletter_model->add_newsletter($reqdata);
				$this->response([
	                'status' => TRUE,
	                'message' => 'Successful.',
	                'data' => []
	            ], REST_Controller::HTTP_OK);
			}
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_OK);
        }         
	}

      public function metadata_post(){ 
        if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {
            $table = !empty($this->post('table'))?$this->post('table'):'';
            $slug = !empty($this->post('slug'))?$this->post('slug'):'0';
            $id = !empty($this->post('id'))?$this->post('id'):'0';
            if(!empty($id)){
                $SQL ='SELECT meta_title, meta_keyword, meta_description FROM '.$table.' where id='.$id.'';
            }
            if(!empty($slug)){
                $SQL ='SELECT meta_title, meta_keyword, meta_description FROM '.$table.' where slug="'.$slug.'"';
            }
            $query = $this->db->query($SQL);
            $retdata = $query->row_array(); 
            $data = $retdata;    
            $this->response([
                'status' => TRUE,
                'message' => 'Successful.',
                'data' => $data
            ], REST_Controller::HTTP_OK);
             
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
    }


    public function saveinquerypackage_post(){ 
        if ($this->input->server('REQUEST_METHOD') == 'POST') 
        {       
            
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'), 
                'tour_id' => $this->input->post('tour_id'), 
                'tour_package_id' => $this->input->post('tour_package_id'), 
                'no_of_adult' => $this->input->post('no_of_adult'), 
                'no_of_child' => $this->input->post('no_of_child'),             
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'inquiry_mode' => 1,  
                'created_at' => date('Y-m-d : h:m:s'),
                'updated_at' => date('Y-m-d : h:m:s'),
            );
            $data = $this->security->xss_clean($data);
            $result = $this->inquiry_model->addpackageinquery($data);
            $general_settings_data = $this->setting_model->get_general_settings(1);
            foreach ($general_settings_data as $skey => $svalue) {
               $global_data['general_settings'][$svalue['setting_type']][$svalue['setting_name']]= $svalue['filed_value'];
               $all_general_settings[$svalue['setting_name']]= $svalue['filed_value'];
            }  
           
                $msg = 'Your inquiry sent successfully.';  
            
            if($result){
                $data = []; 
                $this->response([
                    'status' => TRUE,
                    'message' => $msg,
                    'data' => '1'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }  
    }


    ///// Mobile api   start ///////

    public function login_subadmin_post()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $result = [];
            $mobile_no = !empty($this->post('mobile_no')) ? $this->post('mobile_no') :
                $this->response([
                    'status' => FALSE,
                    'message' => 'Mobile no is required',
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);

            $password = !empty($this->post('password')) ? $this->post('password') :
                $this->response([
                    'status' => FALSE,
                    'message' => 'Password is required',
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);

            // $fcm_id = !empty($this->post('fcm_id')) ? $this->post('fcm_id') :
            //     $this->response([
            //         'status' => FALSE,
            //         'message' => 'FCM id is required',
            //         'data' => Null
            //     ], REST_Controller::HTTP_BAD_REQUEST);

            // $device_id = !empty($this->post('device_id')) ? $this->post('device_id') : $this->response([
            //     'status' => FALSE,
            //     'message' => 'Device id is required',
            //     'data' => []
            // ], REST_Controller::HTTP_BAD_REQUEST);

         $logindata = array(
             'mobile_no' => $mobile_no,
             'password' => $password
         );

         $result = $this->auth_model->applogin($logindata);
         
        //  $record = array('fcm_id' => $fcm_id, 'device_id' => $device_id);

         if (empty($result)) {

             $this->response([
                 'status' => FALSE,
                 'message' => 'Invalid Mobile Password',
                 'data' => []
             ], REST_Controller::HTTP_BAD_REQUEST);
         } else {
             // $result = $this->employee_model->get_employee_by_id($result['id']);
                 $data["admin_id"] = $result['admin_id'];
                 $data["username"] = $result['username'];
                 $data["name"] =  $result['firstname'].' '.$result['lastname'];
                 $data["email"] =  $result['email'];
                 $data["mobile_no"] =  $result['mobile_no'];
                 $data["profile_img"] = !empty($result['image']) ? $result['image']:'' ;
                 $data["created_at"] =  $result['created_at'];

             $this->response([
                 'status' => TRUE,
                 'message' => 'login successfully',
                 'data' => $data
             ], REST_Controller::HTTP_OK);
         }
        } else {
         $this->response([
             'status' => FALSE,
             'message' => 'Invalid Request',
             'data' => []
         ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function dashboad_get()
    {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {            
            $data['total_inquiry'] = $this->inquiry_model->totalinquiery();
            $data['today_inquiry'] = $this->inquiry_model->todayinquiery();
                
                $this->response([
                    'status' => FALSE,
                    'message' => "Data fetch successfully",
                    'data' => $data
                ], REST_Controller::HTTP_OK);
        }
    }

    public function product_detail_get($id=null){
        if ($this->input->server('REQUEST_METHOD') == 'GET') 
        {      
            $product__details_data = $this->product_model->get_product_by_slug($id);
            
            if($product__details_data){
                
                $this->response([
                    'status' => TRUE,
                    'message' => 'Successful.',
                    'data' => $product__details_data
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response("invalid request", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{ 
            $this->response("invalid request", REST_Controller::HTTP_BAD_REQUEST);
        }         
    } 


    	public function saveapplyjob_post(){ 
		if ($this->input->server('REQUEST_METHOD') == 'POST') 
        { 
        $email = !empty($this->input->post('email'))?$this->input->post('email'): $this->response(['status' => FALSE,'message' =>"Email required",'data' => [] ], REST_Controller::HTTP_BAD_REQUEST);

		$first_name = !empty($this->input->post('fname'))?$this->input->post('fname'): $this->response(['status' => FALSE,'message' =>"First Name required",'data' => [] ], REST_Controller::HTTP_BAD_REQUEST);	

		$last_name = !empty($this->input->post('lname'))?$this->input->post('lname'): $this->response(['status' => FALSE,'message' =>"Last Name required",'data' => [] ], REST_Controller::HTTP_BAD_REQUEST); 	

		$mobile = !empty($this->input->post('phone'))?$this->input->post('phone'): $this->response(['status' => FALSE,'message' =>"Number required",'data' => [] ], REST_Controller::HTTP_BAD_REQUEST);

		$experience = !empty($this->input->post('experience'))?$this->input->post('experience'): $this->response(['status' => FALSE,'message' =>"experience required",'data' => [] ], REST_Controller::HTTP_BAD_REQUEST);	

		$description = !empty($this->input->post('description'))?$this->input->post('description'): $this->response(['status' => FALSE,'message' =>"description required",'data' => [] ], REST_Controller::HTTP_BAD_REQUEST);

		$cv = !empty($this->input->post('cv'))?$this->input->post('cv'): $this->response(['status' => FALSE,'message' =>"C.V. required",'data' => [] ], REST_Controller::HTTP_BAD_REQUEST);
		$careerdetails = $this->career_model->get_career_by_slug($this->input->post('career_id'));

		$reqdata = array(
	        		'first_name'=>$first_name,
	        		'last_name'=>$last_name,
	        		'career_id'=>$careerdetails['id'],
	        		'mobile'=>$mobile,
	        		'experience'=>$experience, 
	        		'email'=> $email,
	        		'cv'=> $cv,
	        		'description'=>$description,
	        		'created_at' => date('Y-m-d,H:i:s'),
	        		'updated_at' => date('Y-m-d,H:i:s'),
	        		'deleted' => 0,
	        	);

	        	 $result = $this->career_model->apply_job($reqdata);
				$this->response([
	                'status' => TRUE,
	                'message' => 'Apply For '.$careerdetails["name"] .' Successful.',
	                'data' =>$reqdata
	            ], REST_Controller::HTTP_OK);
		}else{ 
            $this->response([
                    'status' => FALSE,
                    'message' => "invalid request",
                    'data' => []
                ], REST_Controller::HTTP_BAD_REQUEST);
        }         
	}
	

}
?>