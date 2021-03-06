<?php
	class Career_model extends CI_Model{

		public function add_career($data){
			$this->db->insert('ci_career', $data);
			return true;
		}
		public function update_schedule($id,$data){
			$this->db->where('id', $id);
			$this->db->update('ci_job_application', $data);
			return true;
		}
		//---------------------------------------------------
		// get all career for server-side datatable processing (ajax based)
		public function get_all_career(){
			$wh =array();
			$SQL ='SELECT * FROM ci_career';
			$wh[] = " deleted = 0";
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}

		public function get_all_job_appliction(){
			$wh =array();
			$SQL ='SELECT ci_job_application.*,ci_career.name as jobname FROM ci_job_application LEFT JOIN ci_career ON (ci_career.id = ci_job_application.career_id)';
			$wh[] = "ci_job_application.deleted = 0";
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


		//---------------------------------------------------
		// Get career detial by ID
		public function get_career_by_id($id){
			$query = $this->db->get_where('ci_career', array('id' => $id,'deleted'=>0));
			return $result = $query->row_array();
		}
			public function get_career_by_slug($slug){
			$query = $this->db->get_where('ci_career', array('slug' => $slug,'deleted'=>0));
			return $result = $query->row_array();
		}
		public function get_jobdetails($id){
			$this->db->select('ci_job_application.*,ci_career.name as job_name');
			$this->db->from('ci_job_application');
			$this->db->join('ci_career', 'ci_job_application.career_id=ci_career.id', 'left');
			$this->db->where('ci_job_application.id', $id);
			$query = $this->db->get();
			return $query->row_array();

			//$query = $this->db->get_where('ci_inquiry', array('id' => $id));
			//return $result = $query->row_array();
		}
		// public function get_jobdetails($id){
		// 	$query = $this->db->get_where('ci_job_application', array('id' => $id));
		// 	return $result = $query->row_array();
		// }
		public function get_scheduleData($id){
			$query = $this->db->get_where('ci_job_application', array('id' => $id,'is_schudule_Interview'=>1));
			return $result = $query->row_array();
		}
		

		//---------------------------------------------------
		// Edit career Record
		public function edit_career($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_career', $data);
			return true;
		}

		//---------------------------------------------------
		// Change career status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_career');
		} 
		
		 public function apply_job($reqdata){
			$this->db->insert('ci_job_application', $reqdata);
			return true;
		}



	}

?>