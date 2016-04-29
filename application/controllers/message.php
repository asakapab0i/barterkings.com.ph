<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('message_model');
		$this->load->helper('text');
		$this->load->helper('links');
	}

	public function index(){
		$this->_data['title'] = 'BarterKings PH - Messages';
		$count_messages = $this->message_model->get_messages_inbox_unread();
		$data['count_inbox'] = ($count_messages != FALSE ? count($count_messages) : 0);
		$data['messages'] = $this->message_model->get_messages_inbox();
		$this->_load_view('message/main', $data);
	}

	public function inbox(){
		$data['messages'] = $this->message_model->get_messages_inbox();
		$this->load->view('template/message-template', $data);
	}

	public function draft(){
		$this->load->view('template/message-template');
	}

	public function sent(){
		$data['messages'] = $this->message_model->get_messages_sent();
		$this->load->view('template/message-template', $data);
	}

	public function trash(){
		$data['display_tools_untrash'] = true;
		$data['messages'] = $this->message_model->get_messages_trash();
		$this->load->view('template/message-template', $data);
	}

	public function view($message_id){
		$data['display_tools'] = true;
		$data['messages'] = $this->message_model->get_message_by_message_id($message_id);
		$this->message_model->update_message_is_read($message_id);
		$this->load->view('template/message-template', $data);
	}

	public function create(){
		if ($this->input->post('options')) {
			$data['options'] = $this->input->post('options');
			$data['reply'] = $this->message_model->get_username_create_compose_by_account_id($this->input->post('account_id'));
			$this->load->view('template/message-compose-template', $data);
		}else{
			if ($this->input->post()) {
				$this->message_model->create_message_compose();
			}else{
				$this->load->view('template/message-compose-template');
			}
		}
	}

	public function reply($message_id){
		$data['reply'] =  $this->message_model->get_message_replyto_by_message_id($message_id);
		$this->load->view('template/message-compose-template', $data);
	}

	public function forward($message_id){
		$data['forward'] =  $this->message_model->get_message_replyto_by_message_id($message_id);
		$data['forward'][0]['username'] = $this->message_model->get_message_replyto_by_message_id($message_id);
		$this->load->view('template/message-compose-template', $data);
	}

	public function delete($message_id){
		$this->message_model->update_message_is_trash($message_id);
		$data['messages'] = $this->message_model->get_messages_inbox();
		$this->load->view('template/message-template', $data);
	}

	public function undelete($message_id){
		$this->message_model->update_message_is_untrash($message_id);
		$data['messages'] = $this->message_model->get_messages_inbox();
		$this->load->view('template/message-template', $data);
	}
}
