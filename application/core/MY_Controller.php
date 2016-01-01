<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $_data;
	public $_input_data;
	public $_session_data;


	public function __contruct(){

		parent::__contruct();
		$this->_session_data = NULL;

	}

	public function _get_post_data(){

		if ($this->input->post()) {
			$this->_input_data = $this->input->post();
		}else {
			$this->_input_data = $this->input->get();
		}

	}

	public function _load_defaults(){

		$this->_data['_inbox_count'] = ($this->_get_inbox_count() !== FALSE ? count($this->_get_inbox_count()) : 0);
		$this->_data['_is_logged_in']['session_data'] = $session_data = $this->_get_session_data();

	}

	public function _get_inbox_count(){

		$this->load->model('message_model');
		return $this->message_model->get_messages_inbox_unread();

	}

	public function _get_session_data(){

		$this->load->model('account_model');
		$data = $this->account_model->get_session();

		if ($data !== FALSE) {
			return $data;
		}

		return FALSE;

	}

	public function _load_view($view, $params = NULL){

		$this->_load_defaults();
		$this->load->view('template/header', $this->_data);
		$this->load->view($view, $params);
		$this->load->view('template/footer');
		
	}
}