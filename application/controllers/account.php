<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
		$this->_session_data = $this->account_model->get_session();
	}

	public function login(){
		if ($this->_session_data == false && $this->input->post()) {
			if($this->account_model->login()){
				redirect('home');
			}else{
				$this->_load_view('account/login', array('error' => 'Wrong username or password.', 'show_or_hide' => 'open'));
			}
		}else if($this->_session_data == false){
			$this->_load_view('account/login', array('show_or_hide' => 'hide'));
		}else{
			redirect('home');
		}
	}

	public function logout(){
		if (!empty($this->_session_data)) {
			$this->account_model->logout();
		}else{
			redirect('home');
		}
	}

	public function register(){
		if ($this->_session_data != false && $this->input->post()) {
			$this->account_model->register();
		}else if($this->_session_data == false){
			$this->_load_view('account/register');
		}else{
			redirect('home');
		}
	}

	public function profile($username = null){
		if($this->_session_data != false && $this->input->post()){
			$this->account_model->profile($this->input->post());
		}else if ($this->_session_data != false) {
			$this->_load_view('account/profile');
		}
	}

	public function inbox(){
		if ($this->input->post()) {
			$this->account_model->send($this->input->post());
			$this->_load_view('account/message');
		}else{
			$messages = $this->account_model->get_messages();
			$this->_load_view('account/message');
		}
	}

}
