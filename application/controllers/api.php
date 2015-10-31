<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {

	public $request_data;

	private $_instance;

	private $_api_id;
	private $_api_pass;

	private $_api_verified;

	public function __construct(){

		parent::__construct();

		$this->_instance =& get_instance();

		if ( $this->input->post() !== false ){

			$this->request_data = $this->input->post();

		}else if( $this->input->get() !== false ){

			$this->request_data = $this->input->get();

		}

	}

	private function _verify_api_credentials(){

		$this->_api_id = 'MyApiId';
		$this->_api_pass = 'MyApiPass';

		if ( $this->_api_verified === false && ($this->isset($this->request_data) && ($this->request_data['api_id'] && $this->request_data['api_pass'])) ) {

			if ( $this->_api_id == $this->request_data['api_id'] && $this->_api_pass == $this->request_data['api_pass'] ) {

				$this->_api_verified = true;

			}else{

				$this->_api_verified = false;

			}

		}else if ($this->_api_verified === false && $this->_session_data !== false ) {

			$this->_api_verified = true;

		}


		if ( $this->_api_verified !== true ) {

			$error_messages['status'] = 'Error';
			$error_messages['response'] = "Connection is not verified.";
			echo json_encode($error_messages);
			exit();

		}

	}

	private function _get_api_params(){

		$errors = false;
		$error_messages = array();

		if ( $this->request_data !== false || (is_array($this->request_data) && count($this->request_data) > 0) ) {

			foreach ($this->request_data as $key => $value) {

				if ( in_array($key, array('type', 'class', 'method', 'parameters', 'api_id', 'api_pass')) === false ) {

					$errors = true;
					$error_messages['response'][$key] = ucfirst($key) . ' not found.';

				}

			}

		}

		if ( $errors === true ) {
			$error_messages['status']	= 'Error';
			echo json_encode($error_messages);
			exit();

		}
	}

	public function index(){

		$this->_verify_api_credentials(); //verify api

		if ( $this->request_data !== false ) {

			$data = $this->_get_api_params();
			
			$type = $this->request_data['type'];
			$class = $this->request_data['class'];
			$method = $this->request_data['method'];
			$parameters = $this->request_data['parameters'];

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

				$class_caller = new ReflectionMethod($class, $method);
				$result = $class_caller->invokeArgs($this->_instance->$class, $parameters);

				if ( $result !== NULL && $result !== false ) {

					echo json_encode($result);

				}else if( $result == false && $result !== NULL ){

					$error_messages['status'] = 'Error';
					$error_messages['response'] =  'No result found.';

					echo json_encode($error_messages);

				}else{

					$error_messages['status'] = 'Error'; 
					$error_messages['response'] = "It's either the class/method doesn't exists or configuration is wrong.";

					echo json_encode($error_messages);
				}

			} catch (Exception $e) {

				echo json_encode($e);	
			}

		}else{

			$error_messages['status'] = 'Error'; 
			$error_messages['response'] = "No _POST or _GET data.";

			echo json_encode($error_messages);

		}
	}

	public function v1(){

		$this->index();

	}

	public function __destruct(){
		//var_dump(debug_backtrace());
	}
	
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */