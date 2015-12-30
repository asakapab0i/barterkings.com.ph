<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $_input_data;

	public function __construct(){

		$this->_get_post_data();
	}

	public function _get_post_data(){

		$this->_input_data = $this->input->post();

		if ( isset($this->_input_data['parameters']) ) {

			foreach ($this->_input_data['parameters'] as $key => $value) {

				$this->_input_data[$key] = $value;

			}

			unset($this->_input_data['parameters']);

		}
		
	}

	public function _get_session_data(){

		$this->load->model('account_model');
		$data = $this->account_model->get_session();

		if ($data !== FALSE) {
			return $data;
		}

		return FALSE;

	}

}