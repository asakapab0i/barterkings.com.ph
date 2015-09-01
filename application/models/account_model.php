<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {			

	private $_post_data;

	public function __construct(){
		parent::__construct();
		$this->_post_data = $this->input->post();
	}

	public function get_session(){
		$this->_session_data = $this->session->userdata('account');
		if ($this->_session_data !== false) {
			unset($this->_session_data[0]['password']);
			return $this->_session_data;
		}
		return false;
	}

	public function login(){
		$login_db = $this->db->select('*')
		->from('accounts')
		->where('username', $this->_post_data['username'])
		->where('password', md5($this->_post_data['password']))->get();

		if ($login_db->num_rows() == 1) {
			$this->session->set_userdata('account', $login_db->result_array());
			return true;
		}

		return false;
	}

	public function logout(){
		$this->session->unset_userdata('account');
		$this->session->sess_destroy();
		redirect('home');
	}

	public function get_messages(){
		$sess = $this->get_session();
		$msg = $this->db->select('*')
		->from('account_inbox')
		->where('account_id', $sess[0]['id'])
		->get();

		if ($msg->num_rows() > 0) {
			return $msg->result_array();
		}

		return false;
	}
}
