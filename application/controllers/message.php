<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('message_model');
	}

	public function index(){
		$count_messages = $this->message_model->get_messages_inbox();
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
		$this->load->view('template/message-template');
	}

	public function create(){
		if ($this->input->post()) {
			$this->message_model->create_message_compose();
		}else{
			$this->load->view('template/message-compose-template');
		}
	}
}