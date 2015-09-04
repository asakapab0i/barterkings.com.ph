<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->inbox();
	}

	public function inbox(){
		$this->_load_view('message/main');
	}

	public function draft(){

	}

	public function create(){

	}

	public function edit(){

	}

	public function delete(){

	}
}