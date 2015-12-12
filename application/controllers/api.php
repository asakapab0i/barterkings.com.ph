<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {

	private $_request_data;

	private $_error = false;

	private $_result = NULL;
	private $_response = NULL;

	private $_api_verified = false;

	private $_required_parameters = array('type', 'class', 'method');
	private $_optional_parameters = array('parameters');

	public function __construct(){

		parent::__construct();

	}

	private function _get_api_parameters(){

		if ( $this->input->post() !== false ){

			$this->_request_data = $this->input->post();

		} else if ( $this->input->get() !== false ){

			$this->_request_data = $this->input->get();

		} else {

			throw new Exception('No _POST or _GET data.');

		}

	}

	private function _verify_api_parameters(){

		if ( $this->_request_data !== NULL && $this->_request_data !== false && (is_array($this->_request_data) && count($this->_request_data) > 0) ) {

			foreach ($this->_required_parameters as $key => $value) {

				if ( isset($this->_request_data[$value]) === false ) {

					throw new Exception("Required parameter '$value' does not exist.");

				}

			}

			foreach ($this->_request_data as $key => $value) {

				$optional_params = array_flip($this->_optional_parameters);
				$required_params = array_flip($this->_required_parameters);

				if ( isset($required_params[$key]) === false && isset($optional_params[$key])  === false ) {

					throw new Exception("Additional parameter '$key' supplied is not allowed.");
					
				} else {

					if ( isset($this->_request_data['parameters']) && is_array($this->_request_data['parameters']) === false ) {

						throw new Exception("Optional parameter '$key' must be an array.");

					}

				}

			}

		}

	}

	private function _verify_api_credentials(){

		if ( $this->_api_verified === false && $this->_get_session_data() !== false ) {

			$this->_api_verified = true;

		} else {

			throw new Exception('Connection is not verified.');
			
		}

	}

	private function _load_class(){

		switch ( $this->_request_data['type'] ) {

		case 'controller':

			if ( $this->load->library_api('../controllers/' . strtolower($this->_request_data['class']) . '.php') === false ){

				throw new Exception("Controller class '".ucfirst($this->_request_data['class'])."' not found.");
				
			}

			break;

		case 'model':

			if ( $this->load->model_api($this->_request_data['class']) === false ) {

				throw new Exception("Model class '".ucfirst($this->_request_data['class'])."' not found.");
				
			}

			break;

		case 'library':

			if ( $this->load->library_api($this->_request_data['class']) === false ){

				throw new Exception("Library class '".ucfirst($this->_request_data['class'])."' not found.");
				
			}

			break;

		default: 

			throw new Exception('Could\'nt find the class type.');

			break;

		}

	}	

	private function _execute_method(){

		$methods = array_flip(get_class_methods($this->{$this->_request_data['class']}));

		if ( array_search($this->_request_data['method'], $methods) !== false ) {

			$object = new ReflectionMethod($this->_request_data['class'], $this->_request_data['method']);

			if ( isset($this->_request_data['parameters']) ) {

				$this->_result = $object->invokeArgs($this->{$this->_request_data['class']}, $this->_request_data['parameters']);

			} else {

				$this->_result = $object->invoke($this->{$this->_request_data['class']});

			}
			
		} else {

			throw new Exception("Model ".ucfirst($this->_request_data['class'])."::{$this->_request_data['method']}() does not exists.");
			
		}
		
	}

	private function _evaluate_result(){

		if ( $this->_result === NULL ) {

			throw new Exception('No result found.');
			

		} else if ( $this->_result === false ){

			throw new Exception('Operation failed.');
			

		} else if ( $this->_result === true ){

			$this->_setup_success('Operation success.');

		} else {

			$this->_setup_success($this->_result);

		}

	}

	public function index(){

		try {

			$this->_get_api_parameters();
			$this->_verify_api_parameters();
			$this->_verify_api_credentials(); //verify api

			$this->_load_class();
			$this->_execute_method();
			$this->_evaluate_result();

		} catch ( Exception $e ) {

			$this->_setup_error($e->getMessage());	

		}

		$this->_send_response();

	}

	private function _setup_error($message){

		$this->_error = true;
		$this->_response['status'] = 'error';
		$this->_response['response'] = $message;

	}

	private function _setup_success($message){

		$this->_response['status'] = 'success';
		$this->_response['response'] = $message;

	}

	private function _send_response(){

		header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
		echo json_encode($this->_response);

	}

	public function v1(){

		$this->index();

	}

	public function __destruct(){

	}
	
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */