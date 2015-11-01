<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {

	public $request_data;

	private $error;
	private $error_response;

	private $response;

	private $result;

	private $_instance;

	private $_api_id;
	private $_api_pass;

	private $_api_verified;

	public function __construct(){

		parent::__construct();

		$this->_instance =& get_instance();

		$this->_api_verified = false;

		$this->result = NULL;

		$this->error = false;
		$this->error_response = array();

		if ( $this->input->post() !== false ){

			$this->request_data = $this->input->post();

		} else if ( $this->input->get() !== false ){

			$this->request_data = $this->input->get();

		}


	}

	private function _verify_api_credentials(){

		$this->_api_id = 'MyApiId';
		$this->_api_pass = 'MyApiPass';

		if ( $this->_api_verified === false && (isset($this->request_data) && (isset($this->request_data['api_id']) && isset($this->request_data['api_pass']))) ) {

			if ( $this->_api_id == $this->request_data['api_id'] && $this->_api_pass == $this->request_data['api_pass'] ) {

				$this->_api_verified = true;

			} else {

				$this->_api_verified = false;

			}

		} else if ( $this->_api_verified === false && $this->_get_session_data() !== false ) {

			$this->_api_verified = true;

		}

		if ( $this->_api_verified !== true ) {

			$this->error_response['status'] = 'Error';
			$this->error_response['response'] = "Connection is not verified.";
			echo json_encode($this->error_response);
			exit();

		}

	}

	private function _verify_api_params(){

		if ( $this->request_data !== false || (is_array($this->request_data) && count($this->request_data) > 0) ) {

			foreach ($this->request_data as $key => $value) {

				if ( array_key_exists($key, $this->request_data) === false ) {

					$this->error = true;
					$this->error_response['response'][$key] = ucfirst($key) . ' does not exist.';

				}

			}

		}

		if ( $this->error === true ) {
			
			$this->error_response['status']	= 'Error';
			echo json_encode($this->error_response);
			exit();

		}
	}

	private function _load_and_call_class(){
		
		switch ( $this->request_data['type'] ) {

			case 'controller':

				if ( $this->_instance->load->library_api('../controllers/' . strtolower($this->request_data['class']) . '.php') === false ){

					$this->error = true;
					$this->error_response['status'] = 'Error';
					$this->error_response['response'] = "Class {$this->request_data['class']} not found.";

				}

				break;

			case 'model':

				if ( $this->_instance->load->model_api($this->request_data['class']) === false ) {

					$this->error = true;
					$this->error_response['status'] = 'Error';
					$this->error_response['response'] = "Class {$this->request_data['class']} not found.";

				}

				break;

			case 'library':

				$this->_instance->load->library_api($this->request_data['class']);

				if ( $this->_instance->load->library_api($this->request_data['class']) === false ){

					$this->error = true;
					$this->error_response['status'] = 'Error';
					$this->error_response['response'] = "Class {$this->request_data['class']} not found.";

				}

				break;

		}

		if ( $this->error !== false ) {

			$methods = array_flip(get_class_methods($this->_instance->{$this->request_data['class']}));

			if ( array_search($this->request_data['method'], $methods) !== false ) {

				$object = new ReflectionMethod($this->request_data['class'], $this->request_data['method']);
				$this->result = $object->invokeArgs($this->_instance->{$this->request_data['class']}, $this->request_data['parameters']);

			} else {

				$this->error = true;
				$this->error_response['status'] = 'Error';
				$this->error_response['message'] = "{$this->request_data['class']}::{$this->request_data['method']} does not exists.";

			}

		}

	}

	public function index(){

		$this->_verify_api_credentials(); //verify api
		$this->_verify_api_params();

		if ( $this->request_data !== false ) {

			try {			

				$this->_load_and_call_class();

				if ( $this->error === false ) {

					if ( $this->result !== NULL && $this->result !== false && !empty($this->result) ) {

						echo json_encode($this->result);

					} else if ( $this->result == false && $this->result !== NULL ){

						$this->error_response['status'] = 'Error';
						$this->error_response['response'] =  'No result found.';

						echo json_encode($this->error_response);

					} else {

						$this->error_response['status'] = 'Error'; 
						$this->error_response['response'] = "It's either the class/method doesn't exists or the configuration is wrong.";

						echo json_encode($this->error_response);
					}

				} else {

					echo json_encode($this->error_response);

				}

			} catch (Exception $e) {

				echo json_encode($e->getMessage());	
			}

		} else {

			$this->error_response['status'] = 'Error'; 
			$this->error_response['response'] = "No _POST or _GET data.";

			echo json_encode($this->error_response);

		}
	}

	public function v1(){

		$this->index();

	}

	public function __destruct(){

	}
	
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */