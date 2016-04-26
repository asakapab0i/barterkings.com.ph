<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
		$this->load->model('item_model');
		$this->load->model('offer_model');
		$this->load->helper('links');
		$this->_session_data = $this->account_model->get_session();
	}

	public function login($account_id = NULL){
		if ($this->_session_data == false && ($this->input->post() !== FALSE || $account_id != NULL) ) {
			if($this->account_model->login($account_id)){
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

	public function login_template(){
		$this->load->view('template/login-template', array('show_or_hide' => 'hide'));
	}

	public function register_template(){
		$this->load->view('template/register-template');
	}

	public function logout(){
		if (!empty($this->_session_data)) {
			$this->account_model->logout();
		}else{
			redirect('home');
		}
	}

	public function register(){
		if ($this->input->post()) {
			$account_id = $this->account_model->register();
			$this->login($account_id);
		}else if($this->_session_data == false){
			$this->_load_view('account/register');
		}else{
			redirect('home');
		}
	}

	public function profile($username = NULL){
		if ($username != NULL) {
			$account_id = $this->account_model->get_account_id_by_username($username);
			$data['is_logged_in'] = false;
		}else{
			$account_id = $this->account_model->get_session();
			$data['is_logged_in'] = true;
		}

		$account_id = $account_id[0]['id'];

		$data['user'] = $this->account_model->get_account_info_by_account_id($account_id);
		$data['items'] = $this->item_model->get_items_by_account_id($account_id, NULL, 5);
		$data['items_count'] = ($data['items'] !== false ? count($data['items']) : 0);
		$data['offers'] = $this->offer_model->get_offered_items_by_account_id($account_id, 4);
		$data['offers_count'] = ($data['offers'] !== false ? count($data['offers']) : 0);

		$this->_load_view('account/profile', $data);
	}

	public function profile_upload(){
		if (isset($_FILES['userfile']) && $_FILES['userfile'] != NULL) {
			$this->account_model->upload_profile();
		}else{
			$sess = $this->account_model->get_session();
			$data['is_logged_in'] = ($sess !== FALSE ? TRUE : FALSE);
			$data['user'] = $this->account_model->get_account_info_by_account_id($sess[0]['id']);
			$this->load->view('template/profile-template', $data);
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
