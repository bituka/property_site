<?php

class Members_model extends CI_Model {

	function get_records_by_userid($user_id) {

		//	echo $user_id;  -- echo testing only

		$this->db->select('id, location, type, price, details');
		$this->db->from('house');
		$this->db->where('user_id', $user_id);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function is_logged_in() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != true) {
			// echo 'You don\'t have permission to access this page. <a href="../login">Login</a>';
			// die();
			redirect('login');
		}
	}

	function get_profile_by_userid($user_id) {

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $user_id);

		$query = $this->db->get();

		if ($query->num_rows() === 1) {
			foreach ($query->result() as $row) {
				$data[] = $row;
				
			}
			// print_r($data);die();
			return $data;
		}
	}
}