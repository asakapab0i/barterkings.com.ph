<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('item_model');
		$this->load->model('message_model');
		$this->load->helper('text');
		$this->load->helper('links');

		// $this->output->enable_profiler(1);
	}

	public function index($sort = 'all'){

		if ($this->input->get('term')) {
			$items = $this->item_model->get_items_search();
		}else{
			$items = $this->item_model->get_items();
		}

		$data['data'] = $items;
		// var_dump($items);
		$data['total_results'] = $items != false ? count($items) : 0;
		$this->_load_view('home/index', $data);

	}

	public function item(){
		$data['data'] = $this->item_model->get_items_search();
		$data['search'] = $this->input->get();
		$this->_load_view('home/index', $data);
	}
}