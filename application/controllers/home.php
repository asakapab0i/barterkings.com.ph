<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('item_model');
		$this->load->model('message_model');
		$this->load->helper('text');
		$this->load->helper('links');
		$this->load->library('pagination');
		// $this->output->enable_profiler(1);
	}

	public function index(){

		if ($this->input->get('term')) {
			$this->_data['title'] = 'BarterKings PH - Search ' . $this->input->get('term');
			$items = $this->item_model->get_items_search();
			$total_rows = $this->item_model->get_total_items_search();
		}else{
			$this->_data['title'] = 'BarterKings PH - Home';
			$items = $this->item_model->get_items();
			$total_rows = $this->item_model->get_total_items();
		}

		if ($this->input->get() !== false && is_array($this->input->get())) {
			$get_query = '?' . http_build_query($this->input->get());
		}else{
			$get_query = false;
		}

		$config['base_url'] = base_url() . 'home/page';
		$config['total_rows'] = $total_rows;
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links($get_query);
		$data['user'] = $this->_get_session_data();
		$data['data'] = $items;
		$data['search'] = $this->input->get('term');
		$data['total_results'] = $total_rows;
		$this->_load_view('home/index', $data);

	}

	public function page($offset = false){
		if ($this->input->get('term')) {
			$items = $this->item_model->get_items_search();
			$total_rows = $this->item_model->get_total_items_search();
		}else{
			$items = $this->item_model->get_items();
			$total_rows = $this->item_model->get_total_items();
		}

		if ($this->input->get() !== false && is_array($this->input->get())) {
			$get_query = '?' . http_build_query($this->input->get());
		}else{
			$get_query = false;
		}

		$config['base_url'] = base_url() . 'home/page';
		$config['total_rows'] = $total_rows;
		$this->pagination->initialize($config);

		$this->_data['title'] = 'BarterKings PH - Home';
		$data['pagination'] = $this->pagination->create_links($get_query);
		$data['user'] = $this->_get_session_data();
		$data['data'] = $items;
		$data['search'] = $this->input->get('term');
		$data['total_results'] = $total_rows;
		$this->_load_view('home/index', $data);
	}

	public function item(){
		$data['data'] = $this->item_model->get_items_search();
		$data['search'] = $this->input->get();
		$this->_load_view('home/index', $data);
	}
}
