<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	private $_post_data;
	private $_get_data;

	public function __construct(){
		parent::__construct();

		$this->_post_data = $this->input->post();
		$this->_get_data = $this->uri->uri_to_assoc();
	}

	public function index(){

		if ($this->_post_data !== false || $this->_get_data !== false) {

			if ($this->_post_data !== false) 
				$data = $this->_post_data;
			else
				$data = $this->_get_data;

			$controller = $data['controller'];
			$method = $data['method'];
			$parameter = $data['parameters'];

			try {			
				return $this->$controller->method($parameters);	
			} catch (Exception $e) {
				return $e;	
			}
		}else{
			echo "Error!, No _POST data.";
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */