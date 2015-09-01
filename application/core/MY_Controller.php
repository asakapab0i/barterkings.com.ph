<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $_session_data;

	public function __contruct(){
		parent::__contruct();
	}

	public function _load_view($view, $params = NULL){
		$this->load->view('template/header', array('session' => $this->_session_data));
		$this->load->view($view, $params);
		$this->load->view('template/footer');
	}
}