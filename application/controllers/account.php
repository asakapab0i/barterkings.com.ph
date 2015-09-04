<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
		$this->load->model('item_model');
		$this->load->model('offer_model');
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

	public function profile($username = NULL){
		if ($username != NULL) {
			$account_id = $this->account_model->get_account_id_by_username($username);			
		}else{
			$account_id = $this->account_model->get_session();
		}

		$account_id = $account_id[0]['id'];

		$data['data'] = $this->item_model->get_items_by_account_id($account_id);
		$data['offers'] = $this->offer_model->get_offered_items_by_account_id($account_id);
		$this->_load_view('account/profile', $data);
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
