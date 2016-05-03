<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('account_model');
		$this->load->model('item_model');
		$this->load->model('offer_model');
		$this->load->helper('links');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->_session_data = $this->account_model->get_session();
	}

	public function login($account_id = NULL){
		$this->_data['title'] = 'BarterKings PH - Login account';

		if ($this->_session_data == false && ($this->input->post() !== FALSE || $account_id != NULL) ) {

			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|callback_check_login[' . $this->input->post('email') .']');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if($this->form_validation->run() == FALSE) {
				$this->_load_view('account/login');
			}else{
				redirect('home');
			}

		}else if($this->_session_data == false){
			$this->_load_view('account/login');
		}else{
			redirect('home');
		}
	}

	public function check_login($pass, $user){
		$data['email'] = $user;
		$data['password'] = $pass;
		$login_check = $this->account_model->login(NULL, $data);
		$this->form_validation->set_message('check_login', 'Email or password is incorrect.');
		return ($login_check) ? true : false;
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
		$this->_data['title'] = 'BarterKings PH - Register account';

		if ($this->input->post()) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[accounts.email]');
			$this->form_validation->set_rules('username', 'Nickname', 'required|is_unique[accounts.username]');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() == false ) {
				$this->_load_view('account/register');
			}else{
				$account_id = $this->account_model->register();
				$this->account_model->login($account_id);
				redirect('home');
			}

		}else if($this->_session_data == false){
			$this->_load_view('account/register');
		}else{
			redirect('home');
		}
	}

	public function forgot_password(){
		$this->_data['title'] = 'BarterKings PH - Forgot Password';
		$data['sent'] = false;
		if ($this->input->post()) {
			$data['sent'] = $this->account_model->update_account_hash();
		}
		$this->_load_view('account/forgot_password', $data);
	}

	public function verification(){
			$this->_data['title'] = 'BarterKings PH - Verify Forgot Password';
			$data['verified'] = false;

			if ($this->input->get()) {
				$verified = $this->account_model->verify_forgot_password();
				if ($verified !== false) {
					$this->change_password($verified);
				}else{
					$this->_load_view('account/verification', $data);
				}

			}else{
				$this->_load_view('account/verification', $data);
			}
	}

	public function change_password($verified = false){
		if ($this->input->post()) {
			$this->account_model->change_password();
		}

		$data['user'] = $verified;
		$this->_load_view('account/change_password', $data);
	}

	public function profile($username = NULL){
		$this->_data['title'] = 'BarterKings PH - My profile';

		if ($username != NULL) {
			$account_id = $this->account_model->get_account_id_by_username($username);
			$data['is_logged_in'] = false;
		}else{
			$account_id = $this->account_model->get_session();
			$data['is_logged_in'] = true;
		}

		$account_id = $account_id[0]['id'];

		$data['user'] = $this->account_model->get_account_info_by_account_id($account_id);
		$data['items'] = $this->item_model->get_items_by_account($account_id);
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
		$this->_data['title'] = 'BarterKings PH - Messages';

		if ($this->input->post()) {
			$this->account_model->send($this->input->post());
			$this->_load_view('account/message');
		}else{
			$messages = $this->account_model->get_messages();
			$this->_load_view('account/message');
		}
	}

}
