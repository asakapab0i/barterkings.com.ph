<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('item_model');
		$this->load->model('message_model');
		$this->load->helper('text');
	}

	public function index(){
		$items = $this->item_model->get_items();
		$data['data'] = $items;
		$this->_load_view('home/index', $data);
	}

	public function item(){
		$data['data'] = $this->item_model->get_items_search();
		$data['search'] = $this->input->get();
		$this->_load_view('home/index', $data);
	}
}