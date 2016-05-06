<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->load->helper('string');
		$this->load->helper('links');
	}

	public function _upload_create_thumbnail($filename, $account_id){
		$config['image_library'] = 'gd2';
		$config['new_image'] = "./asset/img/profiles_thumbs/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['width']	= 200;
		$config['height']	= 200;
		$this->load->library('image_lib');

		$config['source_image']	= "./asset/img/profiles/" . $filename;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		$image = $this->image_lib->explode_name($filename);

		$file_thumb = $image['name'] . "_thumb" . $image['ext'];
		$file_name = $image['name'] . $image['ext'];

		$this->db->where('id', $account_id);
		$this->db->update('accounts', array('profile_img' => $file_name, 'profile_img_thumb' => $file_thumb));
	}

	public function get_session(){
		$this->_session_data = $this->session->userdata('account');
		if ($this->_session_data !== false) {
			unset($this->_session_data[0]['password']);
			return $this->_session_data;
		}
		return false;
	}

	public function login($account_id = NULL, $form_data = false){

		if ( $this->_get_session_data() === false ) {

			if ($form_data) {
				$this->_input_data['email'] = $form_data['email'];
				$this->_input_data['password'] = $form_data['password'];
			}

			$login_db = $this->db->select('*')
			->from('accounts')
			->where('email', $this->_input_data['email'])
			->where('password', md5($this->_input_data['password']))
			->or_where('id', $account_id)->get();

			//generate token
			$login_data = $login_db->result_array();
			$login_data[0]['api_token'] = md5(time());

			if ($login_db->num_rows() == 1) {

				$this->session->set_userdata('account', $login_data);
				return true;

			} else {

				return false;
			}

		} else {

			$info = $this->_get_session_data();
			return $info[0];

		}

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

	public function get_account_id_by_username($username){
		$account_id = $this->db->select('id')
		->from('accounts')
		->where('username', $username)
		->get();

		if ($account_id->num_rows() > 0) {
			return $account_id->result_array();
		}

		return false;
	}

	public function get_account_id_by_item_id($item_id){
		$account_id = $this->db->select('accounts.id as acc_id')
		->from('items')
		->join('accounts', 'accounts.id = items.account_id', 'left')
		->where('items.id', $item_id)
		->get();

		if ($account_id->num_rows() > 0) {
			$data = $account_id->result_array();
			return $data[0]['acc_id'];
		}

		return FALSE;
	}

	public function get_account_info_by_account_id($account_id){
		$account_info = $this->db->select('*')
		->from('accounts')
		->where('id', $account_id)
		->get();

		if ($account_info->num_rows() > 0) {
			$data = $account_info->result_array();
			if (empty($data[0]['profile_img_thumb'])) {
				$data[0]['profile_img_thumb'] = 'default_thumb.JPG';
			}
			return $data;
		}

		return false;
	}

	public function register(){
		$data = $this->input->post();
		$data['password'] = md5($data['password']);
		unset($data['confirm_password']);
		$this->db->insert('accounts', $data);

		return $this->db->insert_id();
	}

	public function upload_profile(){
		$this->load->library('Upload');
		$this->load->library('image_lib');

		$files = $_FILES['userfile'];
		$_FILES['profile_img[]']['name']= $files['name'];
		$_FILES['profile_img[]']['type']= $files['type'];
		$_FILES['profile_img[]']['tmp_name']= $files['tmp_name'];
		$_FILES['profile_img[]']['error']= $files['error'];
		$_FILES['profile_img[]']['size']= $files['size'];

		$new_image = $this->image_lib->explode_name($files['name']);
		$file_name = url_title(microtime() . '_' .$new_image['name']) . $new_image['ext'];

		$config['upload_path'] = './asset/img/profiles';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '*';
		$config['max_width'] = '';
		$config['max_height'] = '';
		$config['remove_spaces'] = TRUE;
		$config['file_name'] = $file_name;
		$this->upload->initialize($config);

		if ($this->upload->do_upload('profile_img[]')) {
			$sess = $this->get_session();
			$this->_upload_create_thumbnail($file_name, $sess[0]['id']);
		} else {
			return FALSE;
		}
	}

	public function update_account_hash(){
			$hash = random_string('sha1');
			$account = $this->db->select('id, email')->from('accounts')->where('email', $this->input->post('email'))->get();

			if ($account->num_rows() > 0) {
				$data = $account->result_array();
				$this->db->where('id', $data[0]['id']);
				$this->db->update('accounts', array('forgot_password_hash' => $hash));

				$this->email->from('no-reply@pvp5.com', 'PVP5 Email Responder');
				$this->email->to($this->input->post('email'));
				$this->email->subject('Forgot password verification');

				$this->email->message('Your verification key is '. linkify_to_verification($hash, $this->input->post('email')));
				$this->email->send();

				return true;
			}else{
				return false;
			}
	}

	public function verify_forgot_password(){
			$account = $this->db->select('*')
				->from('accounts')
				->where('email', $this->input->get('email'))
				->where('forgot_password_hash', $this->input->get('hash'))
				->get();

				if ($account->num_rows() > 0) {
					// $this->db->where('email', $this->input->get('email'));
					// $this->db->update('accounts', array('forgot_password_hash' => ''));
					return $account->result_array();
				}

				return false;
	}

	public function change_password(){

		if ($this->_get_session_data()) {
			if($this->input->post('password') == $this->input->post('confirm_password')){
				$this->db->where('email', $this->input->post('email'));
				$this->db->update('accounts', array('password' => md5($this->input->post('password'))));
				return true;
			}else{
				return false;
			}
		}else{
			if ($this->input->post('password') == $this->input->post('confirm_password')) {
				$where['forgot_password_hash'] = $this->input->post('hash');
				$where['email'] = $this->input->post('email');
				$update['password'] = md5($this->input->post('password'));
				$update['forgot_password_hash'] = '';
				$this->db->where($where);
				$this->db->update('accounts', $update);
			}
		}
	}

	public function get_settings_labels(){
			$query = $this->db->select('*')->from('settings_labels')->order_by('setting_order', 'ASC')->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
			return false;
	}

}
