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

	public function item($itemid, $get_data = false){
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
			$this->_data['title'] = "BarterKings PH - " . $item_info[0]['name'];
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

			if ($get_data !== false) {
				return $data;
			}

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
		$this->_data['title'] = 'BarterKings PH - Add an item';

		if ($this->input->post()) {

			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Item Name', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			$data['categories'] = $this->item_model->get_categories();

			if ($this->form_validation->run() == false ) {
					$this->_load_view('item/add', $data);
			}else{
				if ($this->account_model->get_session()) {
					if ($id = $this->item_model->add_item($this->account_model->get_session())) {
						$name = url_title($this->input->post('name'));
						redirect('item/edit/' . $id);
						//redirect("item/$id/$name");
					}else{
						$this->_load_view('item/add', $data);
					}
				}else {
					redirect('account/login');
				}

			}



		}else{
			$data['categories'] = $this->item_model->get_categories();
			$this->_load_view('item/add', $data);
		}
	}

	public function edit($id){
		$this->_data['title'] = 'BarterKings PH - Edit an item';

		if ($this->input->post()) {
			$data = $this->input->post();
			$item_id = $data['id'];
			$name = url_title($data['name']);
			$tags = (isset($data['tags'])) ? $data['tags'] : false;
			unset($data['tags']); unset($data['id']); unset($data['_wysihtml5_mode']);

			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Item Name', 'required');
			$this->form_validation->set_rules('value', 'Price', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() == false) {
				$data['item'] = $this->item_model->get_item($id);
				$data['images'] = $this->item_model->get_item_images($id);
				$data['categories'] = $this->item_model->get_categories();
				$data['categories_v2'] = $this->item_model->get_categories_v2();
				$data['sub_categories'] = $this->item_model->get_sub_categories();
				$this->_load_view('item/classified', $data);
			}else{
				$this->item_model->edit_item($item_id, $data);
				$this->item_model->add_tags($item_id, $tags);
				redirect("item/{$item_id}/{$name}");
			}

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

	public function compare($item_id, $item_offer_id){
			$this->_data['title'] = 'BarterKings PH - Compare items';

			$data['item']	= $this->item($item_id, true);
			$data['item_offer'] = $this->item($item_offer_id, true);

			$this->_load_view('item/compare', $data);
	}

	public function favorite(){
		if ($this->input->post()) {
			if ($this->account_model->get_session()) {
				echo $this->item_model->update_favorite($this->input->post('itemid'), $this->account_model->get_session());
			}else{
				echo 'failed';
			}
		}
	}

	public function unfavorite(){
			if ($this->input->post()) {
				if ($this->account_model->get_session()) {
					echo $this->item_model->update_favorite($this->input->post('itemid'), $this->account_model->get_session(), true);
				}else{
					echo 'failed';
				}
			}
	}

	public function fetch_favorite($item_id, $account_id){
			return $this->item_model->fetch_favorite($item_id, $account_id);
	}

	public function wishlist(){
		if ($this->input->post()) {
			if ($this->_get_session_data()) {
				echo $this->item_model->update_wishlist($this->input->post('itemid'));
			}else{
				echo 'failed';
			}
		}
	}

	public function unwishlist(){
			if ($this->input->post()) {
				if ($this->_get_session_data()) {
					echo $this->item_model->update_wishlist($this->input->post('itemid'), true);
				}else{
					echo 'failed';
				}
			}
	}

	public function fetch_wishlist(){
		return $this->item_model->fetch_wishlist($item_id, $account_id);
	}

	public function classified(){
		$this->_data['title'] = 'BarterKings PH - Classified item';

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
			$data['items'] = $this->item_model->get_offered_items_from_item_id($this->input->post('id'));
			$data['item'] = $this->input->post('id');
			$data['offered_items'] = true;
			$this->load->view('template/items-offerlist', $data);
		}
	}

	public function offeredlist_by_account(){
		if ($this->input->post()) {
			$data['items'] = $this->item_model->get_offered_items_from_item_id_and_account_id($this->input->post('account_id'), $this->input->post('id'));
			$data['item'] = $this->input->post('id');
			$data['offered_items'] = true;
			$data['user'] = true;
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

	public function get_item_names_json($term){
		header('Content-type: application/json');
		$data = $this->item_model->get_item_names_by_term($term);
		$dataset = [];
		if (is_array($data) && count($data) > 0) {
			foreach($data as $k => $v){
				$dataset[] = $v['name'];
			}
			echo json_encode($dataset);
		}
	}

	public function saved_searches(){
		$data['searches'] = $this->item_model->get_saved_searches();
		$this->load->view('template/saved_searches-template', $data);
	}

	public function post_saved_searches(){
		echo $this->item_model->post_saved_searches();
	}

	public function delete_saved_searches(){
		if ($this->input->post()) {
			echo $this->item_model->delete_saved_searches();
		}
	}

	public function update_saved_searches(){
		if ($this->input->post()) {
			echo $this->item_model->update_saved_searches();
		}
	}

}
