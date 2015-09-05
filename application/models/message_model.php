<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {

	private $_data;

	public function __construct(){
		parent::__construct();	
		$this->load->model('account_model');
		$this->_data = $this->input->post();
	}

	public function _return_false_or_data($query_object){
		if ($query_object->num_rows() > 0) {
			return $query_object->result_array();	
		}
		return FALSE;
	}

	public function create_message_compose($auto_send = NULL){
		if ($auto_send != NULL) {
			$this->db->insert('messages', $auto_send);
		}else{
			$sess = $this->account_model->get_session();
			$data = $this->account_model->get_account_id_by_username($this->_data['to']);

			$this->_data['to'] = $data[0]['id'];
			$this->_data['account_id'] = $sess[0]['id'];
			$this->_data['is_sent'] = 1;
			$this->_data['is_inbox'] = 1;
			$this->_data['date_sent'] = date('Y-m-d H:i:s');
			$this->db->insert('messages', $this->_data);
		}

		return $this->db->insert_id();
	}

	public function get_messages_inbox(){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->join('accounts', 'accounts.id = messages.account_id')
		->where('to', $sess[0]['id'])
		->where('is_inbox', 1)
		->order_by('date_sent', 'DESC')
		->get();

		return $this->_return_false_or_data($messages);
	}

	public function get_messages_sent(){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->join('accounts', 'accounts.id = messages.account_id')
		->where('account_id', $sess[0]['id'])
		->where('is_inbox', 1)
		->order_by('date_sent', 'DESC')
		->get();

		return $this->_return_false_or_data($messages);
	}

	public function get_messages_draft(){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->where('account_id', $sess[0]['id'])
		->where('is_draft', 1)
		->get();

		return $this->_return_false_or_data($messages);
	}

	public function get_messages_trash(){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->where('account_id', $sess[0]['id'])
		->where('is_trash', 1)
		->get();

		return $this->_return_false_or_data($messages);
	}

}