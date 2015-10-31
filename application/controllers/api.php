<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {

	public $data;

	private $_post_data;
	private $_get_data;

	private $_instance;

	private $_api_id;
	private $_api_pass;
	private $_api_verified;

	public function __construct(){

		parent::__construct();

		$this->_instance =& get_instance();
		$this->_post_data = $this->input->post();
		$this->_get_data = $this->input->get();

	}

	private function _verify_api_credentials(){

		$this->_api_id = 'MyApiId';
		$this->_api_pass = 'MyApiPass';

		if ( $this->data['api_id'] && $this->data['api_pass'] ) {

			if ( $this->_api_id == $this->data['api_id'] && $this->_api_pass == $this->data['api_pass'] ) {
				$this->_api_verified = true;
			}else{
				$this->_api_verified = false;
			}

		}

		if ( $this->_api_verified !== true ) {

			echo "Connection is not verified.";
			exit();

		}

	}

	private function _get_api_params(){

		$errors = false;
		$error_messages = array();

		if ( $this->_post_data !== false ){

			$this->data = $this->_post_data;

		}else if( $this->_get_data !== false ){

			$this->data = $this->_get_data;

		}else{

			$error_messages = 'No data.';

		}

		if ( $data !== false || (is_array($data) && count($data) > 0) ) {

			foreach ($this->data as $key => $value) {

				if ( in_array($key, array('type', 'class', 'method', 'parameters', 'api_id', 'api_pass')) === false ) {

					$errors = true;
					$error_messages[$key] = ucfirst($key) . ' not found.';

				}

			}

		}

		if ( $errors === true ) {

			echo json_encode($error_messages);
			exit();

		}
	}

	public function index(){

		if ( $this->_post_data !== false || $this->_get_data !== false ) {

			$data = $this->_get_api_params();
			$this->_verify_api_credentials(); //verify api

			$type = $this->data['type'];
			$class = $this->data['class'];
			$method = $this->data['method'];
			$parameters = $this->data['parameters'];

			try {			

				switch ($type) {

					case 'controller':
						$this->_instance->load->library('../controllers/' . $class);
						break;
					case 'model':
						$this->_instance->load->model($class);
						break;
					case 'library':
						$this->_instance->load->library($class);
						break;
				}

				echo json_encode( call_user_func(array($this->_instance->$class, $method), $parameters) );

			} catch (Exception $e) {

				echo json_encode($e);	
			}

		}else{

			echo "Error!, No _POST or _GET data.";

		}
	}

	public function v1(){

		$this->index();

	}
	
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */