<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$fb_config = array(
			'appId' => 217111391957490,
			'secret' => NULL
		);

		$this->load->library('facebook', $fb_config);
	}

	public function index(){

		$user = $this->facebook->getUser();

		echo anchor($this->facebook->getLoginUrl(), 'tst');

	}


}