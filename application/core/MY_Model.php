<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $_input_data;

	public function __construct(){

		$this->_get_data();
	}

	public function _get_data(){

		if ($this->input->post()) {
			$this->_input_data = $this->input->post();
		}else{
			$this->_input_data = $this->input->get();
		}

	}

	public function _get_session_data(){

		$this->load->model('account_model');
		$data = $this->account_model->get_session();

		if ($data !== FALSE) {
			return $data;
		}

		return FALSE;

	}

}