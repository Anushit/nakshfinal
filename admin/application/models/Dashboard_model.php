<?php
	class Dashboard_model extends CI_Model{

		public function get_all_users(){

			return $this->db->count_all('ci_users');
		}

		

		//--------------------------------------------------------------
		public function get_deactive_users(){

			$this->db->where('is_active', 0);
			return $this->db->count_all_results('ci_users');
		}

		//--------------------------------------------------------------
		
		public function get_photogallery(){
			$this->db->where('type', 1);
			return $this->db->count_all_results('ci_gallery');
		}
		public function get_vide3ogallery(){
			$this->db->where('type', 2);
			return $this->db->count_all_results('ci_gallery');
		}
		
		/// my records 


		
	}

?>
