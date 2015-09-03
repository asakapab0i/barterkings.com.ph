<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {

	private $_post_data;
	private $_get_data;
	private $_instance;

	public function __construct(){
		parent::__construct();

		$this->_instance =& get_instance();
		$this->_post_data = $this->input->post();
		$this->_get_data = $this->input->get();
	}

	public function _assign_api_params(){
		$errors = false;
		$error_messages = array();
		if ($this->_post_data !== false){
			$data = $this->_post_data;
		}else{
			$data = $this->_get_data;
		}

		foreach ($data as $key => $value) {
			if (in_array($key, array('model', 'method', 'parameters')) === false) {
				$errors = true;
				$errors_messages[$key] = $key . ' Not found.';
			}
		}

		if ($errors == true) {
			echo json_encode($errors_messages);
			die();
		}else{
			return $data;
		}
	}

	public function index(){

		if ($this->_post_data !== false || $this->_get_data !== false) {

			$data = $this->_assign_api_params();
			$model = $data['model'];
			$method = $data['method'];
			$parameter = $data['parameters'];

			try {			
				//$this->_instance->load->library('../controllers/' . $controller);
				$this->_instance->load->model($model);
				echo json_encode($this->_instance->$model->$method($parameter['item']));
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */