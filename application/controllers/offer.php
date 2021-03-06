<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('item_model');
		$this->load->model('account_model');
		$this->load->model('offer_model');

		// $this->output->enable_profiler(1);
	}

	public function index(){
		$this->add();
	}

	public function add(){
		if($this->input->post('offer_item_id')){
			return $this->offer_model->add_offer();
		}
		$sess = $this->account_model->get_session();
		$data['items'] = $this->item_model->get_items_by_account_id_v2($sess[0]['id'], $this->input->post('id'));
		$data['itemid'] = $this->input->post('id');
		$this->load->view('offer/add', $data);
	}

	public function view($itemid){
		if ($this->input->post('offer_id')) {
			$this->offer_model->save_edit_offer();
		}
		$data['item'] = $this->input->post('id');
		$this->load->view('offer/view', $data);
	}

	public function view_by_id(){
		$this->load->helper('text');

		$sess_data = $this->account_model->get_session();
		$data['offer'] = $this->offer_model->get_offer_by_id($this->input->post('id'));
		$data['offer_owner'] = $this->offer_model->is_offer_owner_by_offer_id($sess_data[0]['id'], $this->input->post('id'));
		$this->load->view('offer/view_by_id', $data);
	}

	public function get_offers($itemid){
		$this->load->helper('date');
		$this->load->helper('text');
		$data['offers'] = $this->offer_model->get_item_offers($itemid);
		$this->load->view('template/offers-template', $data);
	}

	public function get_offers_count($itemid){
		$offers = $this->offer_model->get_item_offers($itemid);
		echo count($offers);
	}

}