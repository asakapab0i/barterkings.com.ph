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
			$data = $this->account_model->get_account_id_by_username($this->_data['recepient']);

			$this->_data['recepient'] = $data[0]['id'];
			$this->_data['account_id'] = $sess[0]['id'];
			$this->_data['is_sent'] = 1;
			$this->_data['is_inbox'] = 1;
			$this->_data['date_sent'] = date('Y-m-d H:i:s');
			$this->db->insert('messages', $this->_data);
		}

		echo "Message sent.";
	}

	public function get_messages_inbox(){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->join('accounts', 'accounts.id = messages.account_id')
		->where('recepient', $sess[0]['id'])
		->where('is_inbox', 1)
		->where('is_trash', 0)
		->order_by('date_sent', 'DESC')
		->get();

		return $this->_return_false_or_data($messages);
	}

	public function get_messages_inbox_unread(){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->join('accounts', 'accounts.id = messages.account_id')
		->where('recepient', $sess[0]['id'])
		->where('is_inbox', 1)
		->where('is_read', 0)
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
		->join('accounts', 'accounts.id = messages.account_id')
		->where('account_id', $sess[0]['id'])
		->order_by('date_sent', 'DESC')
		->where('is_draft', 1)
		->get();

		return $this->_return_false_or_data($messages);
	}

	public function get_messages_trash(){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->join('accounts', 'accounts.id = messages.account_id')
		->where('recepient', $sess[0]['id'])
		->order_by('date_sent', 'DESC')
		->where('is_trash', 1)
		->get();

		return $this->_return_false_or_data($messages);
	}

	public function get_message_by_message_id($message_id){
		$sess = $this->account_model->get_session();

		$messages = $this->db->select('*')
		->from('messages')
		->join('accounts', 'accounts.id = messages.account_id', 'left')
		->where('recepient', $sess[0]['id'])
		->where('is_inbox', 1)
		->where('message_id', $message_id)
		->get();

		return $this->_return_false_or_data($messages);
	}

	public function get_message_replyto_by_message_id($message_id){
		$sendto = $this->db->select('username, subject, message')
		->from('messages')
		->join('accounts', 'accounts.id = messages.account_id')
		->where('message_id', $message_id)
		->get();

		return $this->_return_false_or_data($sendto);
	}

	public function get_username_create_compose_by_account_id($account_id){
			$get_recepient = $this->db->select('username')->from('accounts')->where('id', $account_id)->get();
			return $this->_return_false_or_data($get_recepient);
	}

	public function update_message_is_read($message_id){
		$data = $this->get_message_by_message_id($message_id);

		if ($data[0]['is_read'] == 0) {
			$this->db->where('message_id', $message_id);
			$this->db->update('messages', array('is_read' => 1));
			return true;
		}
		return false;
	}

	public function update_message_is_trash($message_id){
		$this->db->where('message_id', $message_id);
		$this->db->update('messages', array('is_trash' => 1));
	}

	public function update_message_is_untrash($message_id){
		$this->db->where('message_id', $message_id);
		$this->db->update('messages', array('is_trash' => 0));
	}

}
