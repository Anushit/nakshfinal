<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Inquiry extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		check_premissions($this->router->fetch_class(), $this->router->fetch_method());
		check_user_premissions($this->session->userdata('admin_id'), $this->router->fetch_class(), $this->router->fetch_method());
		$this->load->model('inquiry_model', 'inquiry_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->library('mailer');
	}

	public function index(){
		
		$data['title'] = 'Inquirys List';
		//$data['country'] = $this->inquiry_model->getallcountry();
		$this->load->view('includes/_header', $data);
		$this->load->view('inquiry/inquiry_list');
		$this->load->view('includes/_footer');
	}

	public function package_inquiry()
	{
		$data['title'] = 'Inquirys List';

		$this->load->view('includes/_header', $data);
		$this->load->view('inquiry/package_inquiry');
		$this->load->view('includes/_footer');
	}


	public function assign_inquiry($id=NULL){
		// if($this->session->userdata('admin_id')!=1){
		// 	$check_authentic = $this->inquiry_model->assign_inquirys(array('inquiry_id'=>$id,'user_id'=>$this->session->userdata('admin_id')));
		// 	if($id==NULL or empty($check_authentic) ){
		// 		$this->session->set_flashdata('error', 'Unauthenticated Access');
		// 		redirect(base_url('inquiry'));
				
		// 	}
		// }
		
		//$data['title'] ='Assign Inquiry List';
		$data['inquiry_id'] =$id;
		//print_r($data['assigninquery']); exit;

		if($this->input->post('submit')){

			$this->form_validation->set_rules('user', 'User Name', 'trim|strip_tags|xss_clean|required');

			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 					
					'user_id' => $this->input->post('user'),
					
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header', $data);
				$this->load->view('inquiry/assign_inquiry',$data);
				$this->load->view('includes/_footer');
			}
			else{
				$alredyassign = $this->inquiry_model->get_assing_inquiry_by_id($id);
				if($alredyassign) {
			
					$changedata = array(
						'decline_date'=>date('Y-m-d,h:m:s'),
						'status' => 0,
						'updated_at'=>date('Y-m-d,h:m:s'),
					);
					$this->inquiry_model->update_inquiry($changedata,$id,$data['iser_id']);
				}
				
				$data = array(
					'user_id' => $this->input->post('user'),
					'inquiry_id' => $id,
					'status' => 1,
					'assign_date' => date('Y-m-d,h:m:s'),
					'created_at' => date('Y-m-d,h:m:s'),
					'updated_at' => date('Y-m-d,h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->inquiry_model->add_assign_inquiry($data);
				if($result){

					$this->session->set_flashdata('success', 'Inquiry has been Assign successfully!');
					redirect(base_url('inquiry/assign_inquiry/'.$id));
				}
			}

		}else{
				$this->load->view('includes/_header', $data);
				$this->load->view('inquiry/assign_inquiry',$data);
				$this->load->view('includes/_footer');

		}
	}
	
	public function datatable_json(){	
		$where = []; 
		if(!empty($_REQUEST['inquery_date'])){
			$where[] = " DATE(ci_inquiry.created_at) = '".$_REQUEST['inquery_date']."'"; 
		}

		
		if(!empty($_REQUEST['inquiry_type'])){
			$where[] = "ci_inquiry.inquiry_type = '".$_REQUEST['inquiry_type']."'"; 
		}
		if(!empty($_REQUEST['inquiry_mode'])){
			$where[] = "ci_inquiry.inquiry_mode = '".$_REQUEST['inquiry_mode']."'"; 
		}
		
		$records = $this->inquiry_model->get_all_inquiry($where);
		//print_r($records);die;
		$data = array(); 

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$itmname = "";
			$action = "";

			$action .= '<a title="View" class="detail btn btn-sm btn-primary" href="'.base_url('inquiry/details/'.$row['id']).'"> <i class="fa fa-eye"></i></a>';


			if(@$this->general_user_premissions['inquiry']['is_delete']==1){
				$action .='<a title="Delete Inquiry" class="delete btn btn-sm btn-danger"onclick="return confirm(\'Do you want to delete ?\')" href="'.base_url('inquiry/delete/'.$row['id']).'"> <i class="fa fa-trash"></i></a>';
			}       
                    if ($row['follow_up']==1) {
                            $action .='<span class="fa fa-flag-o" style="color:green;float:right;"></span>';
                    	
                    }else{
                    	$action .= '<span onclick="Follow_up('.$row["id"].',1)" style="cursor:pointer;" class="btn btn-sm btn-info"><i class="fa fa-flag" ></i></span>';
                    }
                    

                    if($row['is_approved']!=0){
                        if($row["is_approved"]==1){
                            $action .='<span class="fa fa-thumbs-up" style="color:green;float:right;"></span>';
                        }else{
                            $action .='<span class="fa fa-thumbs-down" style="color:red;float:right"></span>';
                        }
                    }else{
                        $action .= '<span onclick="approveRejectVideo('.$row["id"].',1)" style="cursor:pointer;float:right"> <i class="fa fa-thumbs-up"></i></span><span onclick="approveRejectVideo('.$row["id"].',2)" style="cursor:pointer;float:right"  > <i class="fa fa-thumbs-down" ></</span>';
                    }
                   
			
			if($row['inquiry_type'] == 1){ 
				$inquiry_type = 'Gernal'; 
			}elseif($row['inquiry_type'] == 2){
				$inquiry_type = 'Product'; 
				$itmname = '<br> ('.$row['itm_name'].')';
			}elseif($row['inquiry_type'] == 3){
				$inquiry_type = 'Service'; 
				$itmname = '<br> ('.$row['itm_name'].')';
			}
			// $username = $row['firstname'].' '.$row['lastname'];
			// if(empty($row['firstname'])){
			// 	$username= "<p class='text-center font-weight-bold'> - </p>";
			// }
			$data[]= array(
				++$i,
				$row['name'],  
				$row['email'],
				$row['mobile'],
				'<span>'.$inquiry_type.$itmname.'</span>',
				//$username,
				$row['ip_address'],
				date_time($row['created_at']),$action
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function todayinqury(){
		
		$data['title'] = 'Today Inquirys List';

		$this->load->view('includes/_header', $data);
		$this->load->view('inquiry/inquiry_list_today');
		$this->load->view('includes/_footer');
	}
	public function datatable_json_today(){				   					   
		$records = $this->inquiry_model->get_alltoday_inquiry();
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$name = "";
			$action = "";
		
			if(@$this->general_user_premissions['inquiry']['is_delete']==1){
				$action .='<a title="Delete Inquiry" class="delete btn btn-sm btn-danger"onclick="return confirm(\'Do you want to delete ?\')" href="'.base_url('inquiry/delete/'.$row['id']).'"> <i class="fa fa-trash"></i></a>';
			}

                    if($row['is_approved']!=0){
                        if($row["is_approved"]==1){
                            $action .='<span class="badge bg-success">Approved</span>';
                        }else{
                            $action .='<span class="badge bg-danger">Rejected</span>';
                        }
                    }else{
                        $action .= '<span onclick="approveRejectVideo('.$row["id"].',1)" style="cursor:pointer;" class="badge bg-success">Approve</span><br><span onclick="approveRejectVideo('.$row["id"].',2)" style="cursor:pointer;" class="badge bg-danger">Reject</span>';
                    }
		
			if($row['inquiry_type'] == 1){ 
				$inquiry_type = 'Gernal'; 
			}elseif($row['inquiry_type'] == 2){
				$inquiry_type = 'Product'; 
				$name = '<br> ('.$row['itm_name'].')';
			}elseif($row['inquiry_type'] == 3){
				$inquiry_type = 'Service'; 
				$name = '<br> ('.$row['itm_name'].')';
			}
			$username = $row['firstname'].' '.$row['lastname'];
			if(empty($row['firstname'])){
				$username= "<p class='text-center font-weight-bold'> - </p>";
			}
			$data[]= array(
				++$i,
				$row['name'],  
				$row['email'],
				$row['mobile'],
				'<span>'.$inquiry_type.$name.'</span>',
				$username,
				$row['ip_address'],
				date_time($row['created_at']),
				'<a title="Assign Inquiry" class="update btn btn-sm btn-warning" href="'.base_url('inquiry/assign_inquiry/'.$row['id']).'"> <i class="fa fa-user"></i></a>  
				 
				
				'.$action
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
	
	//-----------------------------------------------------------
	public function change_status(){   
		$this->inquiry_model->change_status();
	}

	public function add(){
		
		

		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'name', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('subject', 'Subject', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('inquiry_type', 'Inquiry type', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|strip_tags|xss_clean|is_unique[ci_admin.email]');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('inquiry_mode', 'Inquiry mode', 'trim|strip_tags|xss_clean|required');
			//$this->form_validation->set_rules('country', 'country', 'trim|strip_tags|xss_clean|required');
			//$this->form_validation->set_rules('city_id', 'City', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('message', 'message', 'trim|strip_tags|xss_clean|required');
			
			

			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$error['user'] = array( 					
					'name' => $this->input->post('name'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'), 
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile_no'),
					'inquiry_mode' =>  $this->input->post('inquiry_mode'),
					'inquiry_type' => $this->input->post('inquiry_type')
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('inquiry/add_inquiry', $data);
				$this->load->view('includes/_footer'); 
			}
			else{
				
				$item = "";

				if($this->input->post('inquiry_type')==2){
					if(empty($this->input->post('item_id'))){
						$this->session->set_flashdata('error', 'Select Product Required !');
						redirect(base_url('inquiry/add'));
					}
					$item = $this->input->post('item_id');
				}
				if($this->input->post('inquiry_type')==3){
					if(empty($this->input->post('item_id'))){
						$this->session->set_flashdata('error', 'Select Service Required !');
						redirect(base_url('inquiry/add'));
					}
					$item = $this->input->post('item_id');
				}
				//$referral_id = 1;
				// if(!empty($this->input->post('referral_id'))){
				// 	$referral_id = $this->input->post('referral_id');
				// }
				$data = array(
					'name' => $this->input->post('name'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'), 
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile_no'),
					'inquiry_mode' =>  $this->input->post('inquiry_mode'),
					'inquiry_type' => $this->input->post('inquiry_type'),
					'country' =>  $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city_id'),
					'link_id' => $item,
					//'referral_id'=>$referral_id,
					'created_by' =>$this->session->userdata('admin_id'),
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'created_at' => date('Y-m-d,h:m:s'),
					'updated_at' => date('Y-m-d,h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->inquiry_model->add_inquiry($data);
				 if($result){
				// 	$assign = array(
				// 	'user_id' => $this->session->userdata('admin_id'),
				// 	'inquiry_id' => $result,
				// 	'status' => 1,
				// 	'assign_date' => date('Y-m-d,h:m:s'),
				// 	'created_at' => date('Y-m-d,h:m:s'),
				// 	'updated_at' => date('Y-m-d,h:m:s'),
				// );
				// $assign = $this->security->xss_clean($assign);
				// $result_assign = $this->inquiry_model->add_assign_inquiry($assign);
					$this->session->set_flashdata('success', 'Inquiry has been added successfully!');
					redirect(base_url('inquiry'));
				}
			}
		}
		else{
			$data['title'] = 'Add Inquiry';

			$this->load->view('includes/_header', $data);
			$this->load->view('inquiry/add_inquiry');
			$this->load->view('includes/_footer');
		}
		
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{		
		$data = array('deleted'=>1,'deleted_at'=>date('Y-m-d,H:s:i'));
		$this->db->where(array('id' => $id));
		$this->db->update('ci_inquiry', $data);
		$this->session->set_flashdata('success', 'Inquiry has been deleted successfully!');
		redirect(base_url('inquiry'));

		
	}
 
	
	public function delete_package_inquiry($id = 0)
	{		
		$data = array('deleted'=>1,'deleted_at'=>date('Y-m-d,H:s:i'));
		$this->db->where(array('id' => $id));
		$this->db->update('ci_tour_booking', $data);
		$this->session->set_flashdata('success', 'Inquiry has been deleted successfully!');
		redirect(base_url('inquiry/package_inquiry'));

		
	}

	public function datatable_json_packages(){				   					   
		$records = $this->inquiry_model->get_all_packages_inquiry();
		
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$name = "";
			
			$data[]= array(
				++$i,
				$row['user_name'],  
				$row['email'],
				$row['mobile'],
				$row['name'],
				$row['title'],
				$row['no_of_adult'],
				$row['no_of_child'],
				$row['ip_address'],
				date_time($row['created_at']),
				'  
				
				<div class="btn-group">
					  <a class="btn dropdown-toggle btn btn-sm btn-primary" data-toggle="dropdown" href="#">
					  	<i class="fa fa-reply"> </i>
					    <span class="caret"></span>
					  </a>
					  <ul class="dropdown-menu">
					  <a class="dropdown-item" href="'.base_url('inquiry/send_replymail_package/'.$row['id']).'">
					    <li> Reply Mail</li></a>
					  </ul>
				</div> 
				<a title="Delete Inquiry" class="delete btn btn-sm btn-danger"onclick="return confirm(\'Do you want to delete ?\')" href="'.base_url('inquiry/delete_package_inquiry/'.$row['id']).'"> <i class="fa fa-trash"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

		public function send_replymail_package($id=NULL){
		
		$data['inquiry_data']=$this->inquiry_model->get_package_inquiry_by_id($id);
			

		if($this->input->post('submit')){
			$this->form_validation->set_rules('subject', 'subject', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|strip_tags|xss_clean|required');
			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('inquiry/add_mail_package', $data);
				$this->load->view('includes/_footer');
			}
			else{

				$attachment= "";
				$path="assets/img/mail_doc/"; 				
				if(!empty($_FILES['attachment']['name']))
				{
					$type = "image";
					if ($_FILES['attachment']['type'] == 'application/pdf') {
						$type = "pdf";
					}

					$result = $this->functions->file_insert($path, 'attachment', $type, '9097152');
					if($result['status'] == 1){
						$attachment= $path.$result['msg'];
					}
					else{
						$this->session->set_flashdata('error', $result['msg']);
						redirect(base_url('inquiry/send_replymail_package'), 'refresh');
					}
				}
				$data = array(
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					'attachment' => $attachment,
					'inquiry_id' => $id,
					'followup_date'=>date('Y-m-d,h:m:s'),
					'created_by' => $this->session->userdata('admin_id'),
					'created_at' => date('Y-m-d,h:m:s'),
					'updated_at' => date('Y-m-d,h:m:s'),
					
				);

				$data = $this->security->xss_clean($data);
				$result = $this->inquiry_model->add_package_inquiry_followup($data);
				
				if($result){

					$this->load->helper('email_helper');

					$to = $data['inquiry_data']['email'];
					$subject = $this->input->post('subject');
					$msg = $this->input->post('message');
					$body = $this->mailer->global_template($msg);
					$message = $body;
					$senddata = send_email($to, $subject, $message, $attachment , $cc = '');
					if($senddata){
						$this->session->set_flashdata('success', 'Mail has been Send successfully!');
						redirect(base_url('inquiry/send_replymail_package/'.$id));
					}else{

						$this->session->set_flashdata('error', 'Somthing Want to wrong send mail');
					  		redirect(base_url('inquiry/send_replymail_package'), 'refresh');
					}

				}else{
					$this->session->set_flashdata('error', 'Somthing Want to wrong ');
					  		redirect(base_url('inquiry/send_replymail_package'), 'refresh');
					}
			}
		}
		else{

			$data['title'] = 'Add Mail';

			$this->load->view('includes/_header', $data);
			$this->load->view('inquiry/add_mail_package', $data);
			$this->load->view('includes/_footer');
		}
		
	}

	public function datatable_json_package_reply_mail($id){		
		$records = $this->inquiry_model->get_all_package_reply_mail($id);
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			if(!empty($row['attachment'])){ $attachment = '<a href="'.base_url().$row['attachment'].'" download><i class="fa fa-download "></i></a>'; 
			}else{
				$attachment = 'No Attachment';
			}
			$data[]= array(
				++$i,
				$row['inquirymail'],  
				$row['message'],
				$attachment,
				$row['subject'],
				date_time($row['followup_date']),
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	//---------------------------------------------------------------
	//  Export Categories PDF 
	public function create_inquiry_pdf(){
		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_inquirys'] = $this->inquiry_model->get_inquirys_for_export();		 
		$this->load->view('inquiry/inquiry_pdf', $data);
	}

	//---------------------------------------------------------------	
	// Export data in CSV format 
	public function export_csv(){ 

	   // file name 
		$filename = 'inquirys_'.date('Y-m-d').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

	   // get data 
		$all_inquirys = $this->inquiry_model->get_inquirys_for_export();		 

	   // file creation 
		$file = fopen('php://output', 'w');

		$header = array("ID", "Name", "Email" ,"Mobile", "Inquiry Type", "subject", "message", "ip_address", "Created Date"); 

		fputcsv($file, $header);
		foreach ($all_inquirys as $key=>$line){ 

			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	} 

	public function send_replymail($id=NULL){
		if($this->session->userdata('admin_id')!=1){
			$check_authentic = $this->inquiry_model->assign_inquirys(array('inquiry_id'=>$id,'user_id'=>$this->session->userdata('admin_id')));
			if($id==NULL or empty($check_authentic) ){
				$this->session->set_flashdata('error', 'Unauthenticated Access');
				redirect(base_url('inquiry'));
				
			}
		}
		
		$data['inquiry_data']=$this->inquiry_model->get_inquiry_by_id($id);
		$data['creatby']=$this->inquiry_model->get_created_by_id($data['inquiry_data']['created_by']);
		

		if($this->input->post('submit')){
			$this->form_validation->set_rules('subject', 'subject', 'trim|strip_tags|xss_clean|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|strip_tags|xss_clean|required');
			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('inquiry/add_mail', $data);
				$this->load->view('includes/_footer');
			}
			else{

				$attachment= "";
				$path="assets/img/mail_doc/"; 				
				if(!empty($_FILES['attachment']['name']))
				{
					$type = "image";
					if ($_FILES['attachment']['type'] == 'application/pdf') {
						$type = "pdf";
					}

					$result = $this->functions->file_insert($path, 'attachment', $type, '9097152');
					if($result['status'] == 1){
						$attachment= $path.$result['msg'];
					}
					else{
						$this->session->set_flashdata('error', $result['msg']);
						redirect(base_url('inquiry/send_replymail'), 'refresh');
					}
				}
				$data = array(
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					'attachment' => $attachment,
					'type' => 1,
					'inquiry_id' => $id,
					'followup_date'=>date('Y-m-d,h:m:s'),
					'created_by' => $this->session->userdata('admin_id'),
					'created_at' => date('Y-m-d,h:m:s'),
					'updated_at' => date('Y-m-d,h:m:s'),
					
				);

				$data = $this->security->xss_clean($data);
				$result = $this->inquiry_model->add_inquiry_followup($data);

				if($result){

					$this->load->helper('email_helper');

					$to = $data['inquiry_data']['email'];
					$subject = $this->input->post('subject');
					$msg = $this->input->post('message');
					$body = $this->mailer->global_template($msg);
					$message = $body;
					$senddata = send_email($to, $subject, $message, $attachment , $cc = '');
					if($senddata){
						$this->session->set_flashdata('success', 'Mail has been Send successfully!');
						redirect(base_url('inquiry'));
					}else{

						$this->session->set_flashdata('error', 'Somthing Want to wrong send mail');
					  		redirect(base_url('inquiry/send_replymail'), 'refresh');
					}

				}else{
					$this->session->set_flashdata('error', 'Somthing Want to wrong ');
					  		redirect(base_url('inquiry/send_replymail'), 'refresh');
					}
			}
		}
		else{

			$data['title'] = 'Add Mail';

			$this->load->view('includes/_header', $data);
			$this->load->view('inquiry/add_mail', $data);
			$this->load->view('includes/_footer');
		}
		
	}


	public function send_replysms($id=NULL){
		if($this->session->userdata('admin_id')!=1){
			$check_authentic = $this->inquiry_model->assign_inquirys(array('inquiry_id'=>$id,'user_id'=>$this->session->userdata('admin_id')));
			if($id==NULL or empty($check_authentic) ){
				$this->session->set_flashdata('error', 'Unauthenticated Access');
				redirect(base_url('inquiry'));
				
			}
		}
		$data['inquiry_data']=$this->inquiry_model->get_inquiry_by_id($id);
		$data['creatby']=$this->inquiry_model->get_created_by_id($data['inquiry_data']['created_by']);
		

		if($this->input->post('submit')){
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					'message' => $this->input->post('message'),
					
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('inquiry/send_sms', $data);
				$this->load->view('includes/_footer');
			}
			else{

				$data = array(

					'message' => $this->input->post('message'),
					'type' => 2,
					'inquiry_id' => $id,
					'followup_date'=>date('Y-m-d'),
					'created_by' => $this->session->userdata('admin_id'),
					'created_at' => date('Y-m-d,h:m:s'),
					'updated_at' => date('Y-m-d,h:m:s'),
					
				);

				$data = $this->security->xss_clean($data);
				$result = $this->inquiry_model->add_inquiry_followup($data);

				if($result){
					$this->session->set_flashdata('success', 'SMS has been Send successfully!');
						redirect(base_url('inquiry'));
										
				}else{
					$this->session->set_flashdata('error', 'Somthing Want to wrong ');
					  		redirect(base_url('inquiry/send_replysms'), 'refresh');
					}
			}
		}
		else{

			$data['title'] = 'Reply SMS';

			$this->load->view('includes/_header', $data);
			$this->load->view('inquiry/send_sms', $data);
			$this->load->view('includes/_footer');
		}
		
	}
	public function send_replywhtup($id=NULL){
		if($this->session->userdata('admin_id')!=1){
			$check_authentic = $this->inquiry_model->assign_inquirys(array('inquiry_id'=>$id,'user_id'=>$this->session->userdata('admin_id')));
			if($id==NULL or empty($check_authentic) ){
				$this->session->set_flashdata('error', 'Unauthenticated Access');
				redirect(base_url('inquiry'));
				
			}
		}
		$data['inquiry_data']=$this->inquiry_model->get_inquiry_by_id($id);
		$data['creatby']=$this->inquiry_model->get_created_by_id($data['inquiry_data']['created_by']);
		
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					'message' => $this->input->post('message'),
					
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('inquiry/send_whatsapp', $data);
				$this->load->view('includes/_footer');
			}
			else{

				$data = array(

					'message' => $this->input->post('message'),
					'type' => 3,
					'inquiry_id' => $id,
					'followup_date'=>date('Y-m-d'),
					'created_by' => $this->session->userdata('admin_id'),
					'created_at' => date('Y-m-d,h:m:s'),
					'updated_at' => date('Y-m-d,h:m:s'),
					
				);

				$data = $this->security->xss_clean($data);
				$result = $this->inquiry_model->add_inquiry_followup($data);

				if($result){
					$this->session->set_flashdata('success', 'Whatsapp message has been Send successfully!');
						redirect(base_url('inquiry'));
										
				}else{
					$this->session->set_flashdata('error', 'Somthing Want to wrong ');
					  		redirect(base_url('inquiry/send_replywhtup'), 'refresh');
					}
			}
		}
		else{

			$data['title'] = 'Reply Whatsapp';

			$this->load->view('includes/_header', $data);
			$this->load->view('inquiry/send_whatsapp', $data);
			$this->load->view('includes/_footer');
		}
		
	}
	public function datatable_json_reply_mail($id){		
		$records = $this->inquiry_model->get_all_reply_mail($id);
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			if(!empty($row['attachment'])){ $attachment = '<a href="'.base_url().$row['attachment'].'" download><i class="fa fa-download "></i></a>'; 
			}else{
				$attachment = 'No Attachment';
			}
			$data[]= array(
				++$i,
				$row['inquirymail'],  
				$row['message'],
				$attachment,
				$row['subject'],
				date_time($row['followup_date']),
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function datatable_json_reply_sms($id){			   			
		   
		$records = $this->inquiry_model->get_all_reply_msg($id);
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$data[]= array(
				++$i,
				$row['mob_number'],  
				$row['message'],
				date_time($row['followup_date'])
			);
		} 
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function datatable_json_reply_whatsapp($id){			   			
		   
		$records = $this->inquiry_model->get_all_reply_whatsapp($id);
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$data[]= array(
				++$i,
				$row['mob_number'],  
				$row['message'],
				date_time($row['followup_date']),
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	public function get_inqirytype_data(){
		
		$type = $this->input->post('type');
		$result = "";
		if($type == 1){
			$res = array('status' => FALSE, 'data' => '');
		}
		if($type == 2){
			$data = $this->product_model->get_products();
			$result .= '<label for="inquiry_type" class="col-sm-6 control-label">Selcet Product <span class="red">*</span></label>';
			$result.='<select name="item_id"  class="form-control">
            <option value="">Select Product</option>';
            foreach ($data as  $value) {
				$result .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
			}
            $result .= '</select>';
			$res = array('status' => TRUE, 'data' => $result);  
                  
		}
		if($type == 3){

			$data = $this->service_model->get_service();
			$result .= '<label for="inquiry_type" class="col-sm-6 control-label">Selcet Service <span class="red">*</span></label>';
			$result .= '<select value=""  class="form-control" name="item_id">';
			$result .= '<option> Selcet Service </option>';
			foreach ($data as  $value) {
				$result .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
			}
			$result .= '</select>';
			$res = array('status' => TRUE, 'data' => $result);
		}	
			echo json_encode($res); exit;
	}


	public function manage_inquiry_page($id=NULL){
		if($this->session->userdata('admin_id')!=1){
			$check_authentic = $this->inquiry_model->assign_inquirys(array('inquiry_id'=>$id,'user_id'=>$this->session->userdata('admin_id')));
			if($id==NULL or empty($check_authentic) ){
				$this->session->set_flashdata('error', 'Unauthenticated Access');
				redirect(base_url('inquiry'));				
			}
		}
		$data['inquiry_data']=$this->inquiry_model->get_inquiry_by_id($id);
		$data['creatby']=$this->inquiry_model->get_created_by_id($data['inquiry_data']['created_by']);
		if($id == Null || empty($data['inquiry_data'])){
			redirect(base_url('inquiry'));
		}

		if($this->input->post('submit')){
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$error = array(
					'errors' => validation_errors()
				);
				$data['user'] = array( 
					'message' => $this->input->post('message'),
					
				);
				$this->session->set_flashdata('errors', $error['errors']);
				$this->load->view('includes/_header');
				$this->load->view('inquiry/manage_inquiry', $data);
				$this->load->view('includes/_footer');
			}
			else{

				$data = array(

					'comments' => $this->input->post('message'),
					'inquiry_id' => $id,
					'followup_date'=>date('Y-m-d'),
					'next_followup_date'=>$this->input->post('next_followup_date'),
					'created_by' => $this->session->userdata('admin_id'),
					'created_at' => date('Y-m-d,h:m:s'),
					'updated_at' => date('Y-m-d,h:m:s'),
					
				);

				$data = $this->security->xss_clean($data);
				$result = $this->inquiry_model->add_inquiry_followupdetail($data);

				if($result){
					$this->session->set_flashdata('success', 'Inquiry followup has been Send successfully!');
						redirect(base_url('inquiry'));
										
				}else{
					$this->session->set_flashdata('error', 'Somthing Want to wrong ');
					  		redirect(base_url('inquiry/manage_inquiry'), 'refresh');
					}
			}
		}
		else{

			$data['title'] = 'Inquiry Follow Up';

			$this->load->view('includes/_header', $data);
			$this->load->view('inquiry/manage_inquiry', $data);
			$this->load->view('includes/_footer');
		}
		
	}
	public function datatable_json_followuplist($id){			   			
		$method ="-" ;
		$records = $this->inquiry_model->get_all_followup_details($id);
		$data = array();

		$i=0;
		foreach ($records['data']  as $row) 
		{  
			if(!empty($row['attachment']) ){ 
				$attachment = '<a href="'.base_url().$row['attachment'].'" download><i class="fa fa-download "></i></a>'; 
			}elseif(isset($row['type']) AND $row['type']==1){
				$attachment = 'No Attachment';
			}else{
				$attachment = '-- ';
			}
			if(isset($row['type']) AND $row['type']==1){ 
				$method = '<i class="fa fa-envelope"i> Mail</i>';
		 	}elseif(isset($row['type']) AND $row['type']==2){ 
		 		$method = '<i class="fa fa fa-commenting-o "> SMS </i>';
			}elseif(isset($row['type']) AND $row['type']==3){ 
				$method = '<i class="fa fa fa-whatsapp "> Whatsapp</i>';
			}else{
				$method = '<i class="fa fa-arrow-up "> Follow Up</i>';
			}
			if(isset($row['next_followup_date']) AND $row['next_followup_date']!=NULL){
				$nextfollowdate = date_time($row['next_followup_date']);
			}else{
				$nextfollowdate ="--";
			}
			if(isset($row['subject'])){ 
				$subject = $row['subject'];
			}else{
				$subject = " - ";
			}
			if(isset($row['comments'])){ 
				$comments = $row['comments'];
			}elseif(isset($row['message'])){
				$comments = $row['message'];
			}else{
				$comments = " - ";
			}

			$data[]= array(
				++$i,
				$method,  
				$subject,
				$comments,
				$attachment,
				date_time($row['followup_date']),
				$nextfollowdate
			);
		} 
		$records['data']=$data;
		echo json_encode($records);						   
	}
	public function get_state(){
		$countryId = $this->input->post('type'); 
		$query = $this->db->get_where('ci_state', array('is_active'=>1,'country_id'=>$countryId));
		$result = $query->result_array();
		
			  $data = '<select name="state" id="state"  class="form-control">
	            <option value="">Select State</option>' ;
	           foreach ($result as $key => $value) {
	           $data .= '<option value="'.$value["id"].' "'.set_value("state").'>'. $value["name"].'
	            </option>';
	            } 
	           $data .= '</select>';
		
		$res = array('status' => TRUE, 'data' => $data);
			
			echo json_encode($res); exit;
	}
	public function get_city(){
		$stateId = $this->input->post('type'); 
		$query = $this->db->get_where('ci_city', array('is_active'=>1,'state_id'=>$stateId));
		$result = $query->result_array();
		
			  $data = '<select name="city" id="city" class="form-control">
	            <option value="">Select City</option>' ;
	           foreach ($result as $key => $value) {
	           $data .= '<option value="'.$value["id"].' "'.set_value("city").'>'. $value["name"].'
	            </option>';
	            } 
	           $data .= '</select>';
		
		$res = array('status' => TRUE, 'data' => $data);
			
			echo json_encode($res); exit;
	}

	  public function approvereject(){  
         //die("sss");
       /* echo "heyyyy";die;*/
        $is_approved = $this->input->get('is_approved'); 
        //print_r($is_approved);die;

        $id = $this->input->get('id');
        //echo $id;die;
       
       $res =  $this->inquiry_model->approve_reject($id,$is_approved);

       /*echo "jo".$res; die;*/
    }

    	  public function followup(){  
         //die("sss");
       /* echo "heyyyy";die;*/
        $followup = $this->input->get('follow_up'); 
        //print_r($is_approved);die;

        $id = $this->input->get('id');
        //echo $id;die;
       
       $res =  $this->inquiry_model->followup_record($id,$followup);

       /*echo "jo".$res; die;*/
    }

    public function details($id = 0){

		
			$data['title'] = 'Show Details';
			$data['details'] = $this->inquiry_model->get_details_by_id($id);
			//print_r($data);die;
			
			$this->load->view('includes/_header', $data);
			$this->load->view('inquiry/inquiry_details', $data);
			$this->load->view('includes/_footer');
	
   }
}

?>