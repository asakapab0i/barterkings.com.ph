<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('item_model');
		$this->load->model('account_model');
		$this->load->model('offer_model');
		$this->load->helper('date');
		$this->load->helper('text');
		$this->load->helper('links');

		// $this->output->enable_profiler(true);
	}

	public function index($itemid){
		$this->item($itemid);
	}

	public function item($itemid){
		$item_info = $this->item_model->get_item($itemid);

		$user = $this->account_model->get_session();
		$to_offer = $this->item_model->get_items_by_account_id_v2($user[0]['id'], $itemid);
		$item_images = $this->item_model->get_item_images($itemid);
		$item_images_count = $this->item_model->get_items_images_count($item_images);
		$item_offers = $this->offer_model->get_item_offers($itemid);
		$item_tags = $this->item_model->get_tags($itemid);
		$item_offers_count = ($item_offers !== false ? count($item_offers) : 0);
		$item_comments = $this->item_model->get_item_comments($itemid);
		$item_comments_count = ($item_comments !== false ? count($item_comments) : 0);
		$data['account_id'] = $user[0]['id'];
		$data['editable'] = false;
		$data['item_owner'] = false;

		if ($item_info !== false) {
			if ($user !== false) {
				if ($user[0]['id'] == $item_info[0]['account_id']) {
					$data['editable'] = true;
					$data['item_owner'] = true;
				}
			}
			$data['user'] = $item_info;
			$data['data'] = $item_info;
			$data['to_offer'] = $to_offer;
			$data['tags'] = $item_tags;
			$data['images'] = $item_images;
			$data['images_count'] = $item_images_count;
			$data['offers'] = $item_offers;
			$data['offers_count'] = $item_offers_count;
			$data['comments'] = $item_comments;
			$data['comments_count']  = $item_comments_count;

			$this->_load_view('item/index', $data);
		}else{
			redirect('home');
		}
	}

	public function offer(){
		if ($this->input->post()) {
			$data['_is_logged_in'] = $this->_get_account_info();
			$data['offer_success'] = $this->offer_model->add_offer();
			$data['account'] = $this->account_model->get_session();
			$data['item'] = $this->input->post();
			$this->load->view('template/offer-cart', $data);
		}
	}

	public function add(){
		if ($this->input->post()) {

			if ($this->account_model->get_session()) {
				if ($id = $this->item_model->add_item($this->account_model->get_session())) {
				$name = url_title($this->input->post('name'));
				redirect("item/$id/$name");
				}else{
					$data['categories'] = $this->item_model->get_categories();
					$this->_load_view('item/add', $data);
				}
			}else {
				redirect('account/login');
			}

		}else{
			$data['categories'] = $this->item_model->get_categories();
			$this->_load_view('item/add', $data);
		}
	}

	public function edit($id){
		if ($this->input->post()) {
			$data = $this->input->post();
			$item_id = $data['id'];
			$name = url_title($data['name']);
			$tags = $data['tags'];
			unset($data['tags']);
			unset($data['id']);
			unset($data['_wysihtml5_mode']);
			$this->item_model->edit_item($item_id, $data);
			$this->item_model->add_tags($item_id, $tags);
			redirect("item/{$item_id}/{$name}");
		}else{

			if ($this->account_model->get_session()) {
				$data['item'] = $this->item_model->get_item($id);
				$data['images'] = $this->item_model->get_item_images($id);
				$data['categories'] = $this->item_model->get_categories();
				$data['categories_v2'] = $this->item_model->get_categories_v2();
				$data['sub_categories'] = $this->item_model->get_sub_categories();
				$this->_load_view('item/classified', $data);
			} else {
				redirect('home');
			}
			
		}
	}

	public function favorite(){
		if ($this->input->post()) {

			if ($this->account_model->get_session()) {
				echo $this->item_model->update_favorite($this->input->post('id'), $this->account_model->get_session());
			}

		}
	}

	public function classified(){
		if ($this->input->post()) {
			if ($this->account_model->get_session()) {
				$id = $this->item_model->add_item($this->account_model->get_session());
				$data['item'] = $this->item_model->get_item($id);
				$data['images'] = $this->item_model->get_item_images($id);
				$data['categories'] = $this->item_model->get_categories();
				$data['categories_v2'] = $this->item_model->get_categories_v2();
				$data['sub_categories'] = $this->item_model->get_sub_categories();
				$this->_load_view('item/classified', $data);
			}else{
				redirect('account/login');
			}
			
		}else{
			redirect('item/add');
		}
	}

	public function auction(){
		if ($this->input->post()) {
			$data = $this->input->post();
			$this->_load_view('item/auction', $data);
		}else{
			redirect('item/add');
		}
	}

	public function comment(){
		if($this->input->post('item_id')){
			$this->item_model->add_item_comment();
		}
		$data['itemid'] =  $this->input->post('id');
		$sess_id = $this->account_model->get_session();
		$data['account_id'] = $sess_id[0]['id'];
		$this->load->view('item/comment', $data);
	}

	public function upload($itemid = NULL, $display = FALSE){
		if ($display == TRUE || ($this->input->post() && $_FILES == NULL)) {
			if ($itemid == NULL) {
				$itemid = $this->input->post('id');
			}
			$data['images'] = $this->item_model->get_item_images($itemid);
			$data['item_id'] = $itemid;
			$this->load->view('item/upload', $data);
		}else if($this->input->post() && $itemid != NULL){
			$this->item_model->upload_images($itemid);
		}else{
			echo "Error: item id is null.";
		}
	}

	public function offerlist(){
		if ($this->input->post()) {
			$data['items'] = $this->item_model->get_items_by_account_id_v2($this->input->post('account_id'), $this->input->post('id'));
			$data['item'] = $this->input->post('id');
			$data['offered_items'] = false;
			$this->load->view('template/items-offerlist', $data);
		}	
	}

	public function offeredlist(){
		if ($this->input->post()) {
			$data['items'] = $this->item_model->get_offered_items_from_item_id($this->input->post('account_id'), $this->input->post('id'));
			$data['item'] = $this->input->post('id');
			$data['offered_items'] = true;
			$this->load->view('template/items-offerlist', $data);
		}
	}

	public function delete_image(){
		$this->item_model->delete_item_images($this->input->post());	
	}

	public function remove_offered_item($itemid, $offerid){
		$data = $this->item_model->delete_offered_item($itemid, $offerid);
		echo $data == true ? 'Success' : 'Failed';
	}

	public function get_images($itemid){
		$data['images'] = $this->item_model->get_item_images($itemid);
		$this->load->view('template/images-template', $data);
	}

	public function get_images_count($itemid){
		$images = $this->item_model->get_item_images($itemid);
		echo $this->item_model->get_items_images_count($images);
	}

	public function get_comments($itemid){
		$this->load->helper('date');
		$data['comments'] = $this->item_model->get_item_comments($itemid);
		$this->load->view('template/comments-template', $data);
	}

	public function get_comments_count($itemid){
		$data = $this->item_model->get_item_comments($itemid);
		echo count($data);
	}

	public function get_offered_item(){
		$data['item_offer_id'] = $this->item_model->get_item($this->input->post('offer_item_id'));
		$data['item_id'] = $this->input->post('item_id');
		$data['_is_logged_in'] = $this->_get_account_info();
		$this->load->view('template/offer-cart', $data);
	}

	public function get_tags_json($item_id){
		header('Content-type: application/json');
		echo json_encode($this->item_model->get_tags($item_id));
	}

}