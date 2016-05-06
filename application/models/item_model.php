<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends MY_Model {

	private $items;

	public function __construct(){
		parent::__construct();
		$this->load->model('offer_model');
		$this->load->helper('url');
	}

	public function _upload_create_thumbnail($images, $itemid, $imageid){
		$config['image_library'] = 'gd2';
		//$config['source_image']	= "./asset/img/items/" . $filename;
		$config['new_image'] = "./asset/img/items_thumbs/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['width']	= 200;
		$config['height']	= 200;
		$this->load->library('image_lib');

		if($imageid != 'null'){
			$this->delete_item_images(array('imageid' =>$imageid));
		}

		foreach ($images as $filename) {
			$config['source_image']	= "./asset/img/items/" . $filename;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();

			$image = $this->image_lib->explode_name($filename);

			$file_thumb = $image['name'] . "_thumb" . $image['ext'];
			$file_name = $image['name'] . $image['ext'];

			$this->db->insert('items_images', array('image_thumb' => $file_thumb, 'image' => $file_name, 'item_id' => $itemid));
		}
	}

	public function get_item($itemid){

		if ($itemid === false) {
			$itemid = $this->_input_data['itemid'];
		}

		$itemdb = $this->db->select('category_labels.category_name,category_labels.category_class,category_labels.category_color,offers.*,items_images.*, accounts.profile_img_thumb, accounts.id, items.id as itemid, items.account_id, username, name, type, status, value, description, category, size, location')
		->from('items')
		->join('offers', 'offer_item_id = items.id', 'left')
		->join('items_images', 'items_images.item_id = items.id', 'left')
		->join('category_labels', 'category_labels.category_id = items.category', 'left')
		->join('accounts', 'items.account_id = accounts.id', 'left')
		->where('items.id', $itemid)
		->group_by('items.id')
		->get();

		if ($itemdb->num_rows() == 1) {
			return $itemdb->result_array();
		}

		return FALSE;
	}

	public function get_tags($item_id){
		$itemdb  = $this->db->select('tags.tag_term')->from('tags')->where('tag_parent', $item_id)->get();

		if ($itemdb->num_rows() > 0) {
			return $itemdb->result_array();
		}

		return FALSE;

	}

	public function get_categories(){

		$category = $this->db->select('category_labels.*, COUNT(category) as category_count')->from('category_labels')->join('items', 'items.category = category_id', 'left')->group_by('category_id')->get()->result_array();
		$sub_category = $this->db->select('*')->from('sub_category')->get()->result_array();

		$categories = array();

		foreach ($category as $key => $cat) {
			foreach ($sub_category as $key => $subcat) {
				if ($cat['category_id'] == $subcat['sub_category_id']) {
					$categories[$cat['category_name']]['sub_category'][] = $subcat['sub_category_name'];
					$categories[$cat['category_name']]['icon'] = $cat['category_icon'];
					$categories[$cat['category_name']]['color'] = $cat['category_color'];
					$categories[$cat['category_name']]['id'] = $cat['category_id'];
					$categories[$cat['category_name']]['count'] = $cat['category_count'];
					$categories[$cat['category_name']]['link'] = $cat['category_class'];
				}else {
					$categories[$cat['category_name']]['sub_category'] = NULL;
					$categories[$cat['category_name']]['icon'] = $cat['category_icon'];
					$categories[$cat['category_name']]['color'] = $cat['category_color'];
					$categories[$cat['category_name']]['id'] = $cat['category_id'];
					$categories[$cat['category_name']]['count'] = $cat['category_count'];
					$categories[$cat['category_name']]['link'] = $cat['category_class'];
				}
			}
		}

		return $categories;
	}


	public function get_category_by_id($id){
		$category = $this->db->select('*')->from('category_labels')->where('category_id', $id)->get()->result_array();

		return $category[0];
	}

	public function get_categories_v2(){
		$category = $this->db->select('*')->from('category_labels')->get()->result_array();

		return $category;
	}

	public function get_sub_categories(){
		$subcategory = $this->db->select('*')->from('sub_category')->get()->result_array();

		return $subcategory;
	}

	public function get_available_items_to_offer($account_id, $item_id){
		$items = $this->db->select('items.id, items.name')->from('items')->join('offers', 'offers.item_id = items.id', 'left')->where("offers.offer_item_id != $item_id")->group_by('items.id')->get()->result_array();

		return $items;
	}

	public function get_offered_items_from_item_id($item_id){

		$items = $this->db->select('offer_id, items.id as a_item_id, items.*, accounts.*, items_images.image_thumb')
		->from('items')->join('offers', 'offers.item_id = items.id', 'left')
		->join('accounts', 'accounts.id = items.account_id', 'left')
		->join('items_images', 'items_images.item_id = items.id', 'left')
		->where("offers.offer_item_id = $item_id")->group_by('items.id')
		->get()->result();

		return $items;

	}

	public function get_offered_items_from_item_id_and_account_id($account_id, $item_id){

		$items = $this->db->select('offer_id, items.id as a_item_id, items.*, accounts.*, items_images.image_thumb')
		->from('items')->join('offers', 'offers.item_id = items.id', 'left')
		->join('accounts', 'accounts.id = items.account_id', 'left')
		->join('items_images', 'items_images.item_id = items.id', 'left')
		->where("offers.offer_item_id = $item_id")->group_by('items.id')
		->where("accounts.id = $account_id")
		->get()->result();

		return $items;

	}

	public function get_items_by_account_id($account_id = NULL, $itemid = NULL, $limit = 4){
		if ($itemid !== NULL) {
			$current_item_offers = $this->offer_model->get_item_offers($itemid);
		}else{
			$current_item_offers = FALSE;
		}

		if ($current_item_offers !== FALSE) {
			foreach ($current_item_offers as $offer) {
				$cio[] = $offer['offer_item_id'];
			}
			$itemsdb = $this->db->select('items.id as a_item_id, items.*, accounts.*, items_images.image_thumb, offers.* ')
			->from('items')
			->group_by('items.id')
			->join('offers', 'offer_item_id = items.id', 'left')
			->join('items_images', 'items_images.item_id = items.id', 'left')
			->join('accounts', 'accounts.id = items.account_id', 'left')
			->where('account_id', $account_id)
			->where_not_in('offer_item_id', $cio)
			->where('offers.item_id', $itemid)
			->limit($limit)
			->get();
		}else{
			$itemsdb = $this->db->select('items.id as a_item_id, items.*, accounts.*, items_images.image_thumb, offers.* ')
			->from('items')
			->join('offers', 'offer_item_id = items.id', 'left')
			->join('items_images', 'items_images.item_id = items.id', 'left')
			->join('accounts', 'accounts.id = items.account_id', 'left')
			->group_by('items.id')
			->where('account_id', $account_id)
			->limit($limit)
			->get();
		}

		if ($itemsdb->num_rows() > 0) {
			return $itemsdb->result();
		}
		return FALSE;
	}

	public function get_items_by_account_id_v2($account_id = NULL, $itemid = NULL){
		if ($itemid !== NULL) {
			$current_item_offers = $this->offer_model->get_item_offers($itemid);
		}else{
			$current_item_offers = FALSE;
		}

		if ($current_item_offers !== FALSE) {
			foreach ($current_item_offers as $offer) {
				$cio[] = $offer['offer_item_id'];
			}

			$itemsdb = $this->db->select('items.id as a_item_id, items.*, items_images.image_thumb ')
			->from('items')
			->join('items_images', 'items_images.item_id = items.id', 'left')
			->group_by('items.id')
			->where('account_id', $account_id)
			->where_not_in('items.id', $cio)
			->get();
		}else{
			$itemsdb = $this->db->select('items.id as a_item_id, items.*, items_images.image_thumb ')
			->from('items')
			->join('items_images', 'items_images.item_id = items.id', 'left')
			->group_by('items.id')
			->where('account_id', $account_id)
			->get();
		}

		if ($itemsdb->num_rows() > 0) {
			return $itemsdb->result();
		}
		return FALSE;
	}

	public function get_items_by_account($account_id, $limit = 5){
		$this->_input_data['get_items_by_account_id'] = true;
		$this->_input_data['account_id'] = $account_id;
		$this->_input_data['limit'] = $limit;

		return $this->get_items();
	}

	private function _get_advance_search(){

		$search = array();

		if ($this->_input_data['term']) {
			$search['name'] = $this->_input_data['term'];
		}

		if ($this->_input_data['limit']) {
			$search['limit'] = $this->_input_data['limit'];
		}

		if ($this->_input_data['offset']) {
			$search['offset'] = $this->_input_data['offset'];
		}

		if ($this->_input_data['price_range']) {
			$search['value'] = $this->_input_data['price_range'];
		}

		if ($this->_input_data['ad_age']) {
			$search['date_posted'] = $this->_input_data['ad_age'];
		}

		return $search;

	}

	public function _query_sort_search($limit, $offset, $price_range, $ad_age, $sort, $operator, $order, $datenow, $daterange, $cat_prefix, $cat_value){

		if ($this->_input_data['sort'] == 'most_recent') {

			if (isset($this->_input_data['get_total_rows'])) {
				$itemsdb = $this->db->select('COUNT(items.id) as id')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				// ->where("value $operator", $price_range)
				// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age == 1 ? 7 : $ad_age , false)
				->where($cat_prefix, $cat_value)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}else{
				$itemsdb = $this->db->select('COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				// ->where("value $operator", $price_range)
				// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age == 1 ? 7 : $ad_age , false)
				->where($cat_prefix, $cat_value)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}

			return $itemsdb;

		}else if ($this->_input_data['sort'] == 'most_offers'){

			if (isset($this->_input_data['get_total_rows'])) {
				$itemsdb = $this->db->select('COUNT(items.id) as id')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age == 1 ? 7 : $ad_age , false)
				->having('COUNT(offers.offer_item_id) >', 0, false)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->order_by('COUNT(offers.item_id)', 'desc')
				->get();
			}else{
				$itemsdb = $this->db->select('COUNT(offers.offer_item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age == 1 ? 7 : $ad_age , false)
				->having('COUNT(offers.offer_item_id) >', 0, false)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->order_by('COUNT(offers.item_id)', 'desc')
				->get();
			}

			return $itemsdb;

		}else if ($this->_input_data['sort'] == 'all'){

			if (isset($this->_input_data['get_total_rows'])) {
				$itemsdb = $this->db->select("COUNT('items.id') as id")
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}else {
				$itemsdb = $this->db->select('COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}

			return $itemsdb;

		}

		return false;

	}

	public function _query_sort_search_term($term, $limit, $offset, $price_range, $ad_age, $sort, $operator, $order, $datenow, $daterange, $cat_prefix, $cat_value){

		if ($this->_input_data['sort'] == 'most_recent') {

			if ($this->_input_data['get_total_rows']) {
				$itemsdb = $this->db->select('COUNT(items.id) as id')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				->like("name", $term)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}else{
				$itemsdb = $this->db->select('COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age == 1 ? 7 : $ad_age , false)
				->like("name", $term)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}

			return $itemsdb;

		}else if ($this->_input_data['sort'] == 'most_offers') {

			if (isset($this->_input_data['get_total_rows'])) {
				$itemsdb = $this->db->select('COUNT(items.id) as id')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age == 1 ? 7 : $ad_age , false)
				->like("name", $term)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}else{
				$itemsdb = $this->db->select('COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age == 1 ? 7 : $ad_age , false)
				->like("name", $term)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}

			return $itemsdb;

		}else if ($this->_input_data['sort'] == 'all') {

			if (isset($this->_input_data['get_total_rows'])) {
				$itemsdb = $this->db->select('COUNT(items.id) as id')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				->like("name", $term)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}else{
				$itemsdb = $this->db->select('COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id')
				->join('offers', 'offer_item_id = items.id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category', 'left')
				->where($cat_prefix, $cat_value)
				// ->where("value $operator", $price_range)
				->like("name", $term)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}

			return $itemsdb;

		}

		return false;

	}

	public function get_total_items(){
		$this->_input_data['get_total_rows'] = true;
		$total_rows = $this->get_items();
		return $total_rows;
	}

	public function get_total_items_search(){
		$this->_input_data['get_total_rows'] = true;
		$total_rows = $this->get_items_search();
		return $total_rows;
	}

	public function get_items($limit = 10, $offset = '', $price_range = 100, $ad_age = 1, $sort = ''){
		$operator = '<=';
		$order = "desc";

		if ($this->uri->segment(3)) {
			$offset = $this->uri->segment(3);
		}

		if (isset($this->_input_data['limit'])) {
			$limit = $this->_input_data['limit'];
		}

		if (isset($this->_input_data['price_range'])) {
			$price_range = $this->_input_data['price_range'];
			if ($price_range > 100000) {
				$operator = '>=';
			}
		}

		if (isset($this->_input_data['ad_age'])) {
			$ad_age = $this->_input_data['ad_age'];
		}

		if (isset($this->_input_data['order'])) {
			$order = $this->_input_data['order'];
		}

		if (isset($this->_input_data['page'])) {
			$page = $this->_input_data['page'];
		}else{
			$page = 1;
		}

		if (isset($this->_input_data['category'])) {

			$categories = $this->get_categories_v2();
			$cat_prefix = "category_id";
			foreach ($categories as $key => $value) {
				if ($value['category_class'] == $this->_input_data['category']) {
					$cat_value = $value['category_id'];
					break;
				}
			}

		}else {
			$cat_prefix = "category_id !=";
			$cat_value = 0;
		}


		$datenow = date('Y-m-d');
		$daterange = date('Y-m-d', strtotime($datenow . "- $ad_age  day"));

		if (isset($this->_input_data['sort'])) {
			$itemsdb = $this->_query_sort_search($limit, $offset, $price_range, $ad_age, $sort, $operator, $order, $datenow, $daterange, $cat_prefix, $cat_value);
		}else{

			if (isset($this->_input_data['get_total_rows'])) {
				$itemsdb = $this->db->select('COUNT(items.id) as id')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category')
				->join('offers', 'offer_item_id = items.id', 'left')
				// ->where("value $operator", $price_range)
				->where($cat_prefix, $cat_value)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();

				return $itemsdb->num_rows();
			}else if(isset($this->_input_data['get_items_by_account_id'])){
				$itemsdb = $this->db->select('category_labels.*, COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category')
				->join('offers', 'offer_item_id = items.id', 'left')
				// ->where("value $operator", $price_range)
				->where($cat_prefix, $cat_value)
				->where('accounts.id', $this->_input_data['account_id'])
				->limit($this->_input_data['limit'])
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}else{
				$itemsdb = $this->db->select('category_labels.*, COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category')
				->join('offers', 'offer_item_id = items.id', 'left')
				// ->where("value $operator", $price_range)
				->where($cat_prefix, $cat_value)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}

			// $itemsdb = $this->db->select('category_labels.*, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
			// ->from('items')
			// ->join('items_images', 'item_id = items.id', 'left')
			// ->join('accounts', 'accounts.id = items.account_id')
			// ->join('category_labels', 'category_labels.category_id = items.category')
			// ->where("value $operator", $price_range)
			// ->where($cat_prefix, $cat_value)
			// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age, false)
			// ->limit($limit, $offset)
			// ->group_by('items.id')
			// ->order_by('value', $order)
			// ->get();
		}

		if (isset($this->_input_data['get_total_rows'])) {
			return $itemsdb->num_rows();
		}

		if ($itemsdb->num_rows() > 0) {
			return $itemsdb->result();
		}

		return FALSE;
	}

	public function get_items_search($limit = 10, $offset = '', $price_range = 100, $ad_age = 1, $sort = 'desc'){

		$operator = '<=';
		$order = 'desc';

		if ($this->uri->segment(3)) {
			$offset = $this->uri->segment(3);
		}

		if (isset($this->_input_data['limit'])) {
			$limit = $this->_input_data['limit'];
		}

		if (isset($this->_input_data['offset'])) {
			$offset = $this->_input_data['offset'];
		}

		if (isset($this->_input_data['term'])) {
			$term= $this->_input_data['term'];
		}

		if (isset($this->_input_data['price_range'])) {
			$price_range = $this->_input_data['price_range'];
			if ($price_range > 100000) {
				$operator = '<=';
			}
		}

		if (isset($this->_input_data['ad_age'])) {
			$ad_age = $this->_input_data['ad_age'];
		}

		if (isset($this->_input_data['order'])) {
			$order = $this->_input_data['order'];
		}

		if (isset($this->_input_data['category'])) {

			$categories = $this->get_categories_v2();
			$cat_prefix = "category_id";
			foreach ($categories as $key => $value) {
				if ($value['category_class'] == $this->_input_data['category']) {
					$cat_value = $value['category_id'];
					break;
				}
			}

		}else {
			$cat_prefix = "category_id !=";
			$cat_value = 0;
		}

		$datenow = date('Y-m-d');
		$daterange = date('Y-m-d', strtotime($datenow . "- $ad_age  day"));

		if (isset($this->_input_data['sort'])) {
			$itemsdb = $this->_query_sort_search_term($term, $limit, $offset, $price_range, $ad_age, $sort, $operator, $order, $datenow, $daterange, $cat_prefix, $cat_value);
		}else{
			// $itemsdb = $this->db->select('username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
			// ->from('items')
			// ->join('items_images', 'item_id = items.id', 'left')
			// ->join('accounts', 'accounts.id = items.account_id')
			// ->like('name', $term)
			// ->where("value $operator", $price_range)
			// ->where($category, NULL, false)
			// ->where("DATEDIFF(CURDATE(), date_posted) <=", $ad_age, false)
			// ->limit($limit, $offset)
			// ->group_by('items.id')
			// ->order_by('value', $order)
			// ->get();

			if (isset($this->_input_data['get_total_rows'])) {
				$itemsdb = $this->db->select('COUNT(items.id) as id')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category')
				->join('offers', 'offer_item_id = items.id', 'left')
				->like('name', $term)
				// ->where("value $operator", $price_range)
				->where($cat_prefix, $cat_value)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();

				return $itemsdb->num_rows();
			}else{
				$itemsdb = $this->db->select('category_labels.*, COUNT(offers.item_id) as offers, username, items.id as item_id, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
				->from('items')
				->join('items_images', 'item_id = items.id', 'left')
				->join('accounts', 'accounts.id = items.account_id', 'left')
				->join('category_labels', 'category_labels.category_id = items.category')
				->join('offers', 'offer_item_id = items.id', 'left')
				->like('name', $term)
				// ->where("value $operator", $price_range)
				->where($cat_prefix, $cat_value)
				->limit($limit, $offset)
				->group_by('items.id')
				->order_by('value', $order)
				->order_by('date_posted', 'desc')
				->get();
			}

		}

		if (isset($this->_input_data['get_total_rows'])) {
			return $itemsdb->num_rows();
		}

		if ($itemsdb->num_rows() > 0) {
			return $itemsdb->result();
		}

		return FALSE;
	}

	public function get_item_names_by_term($name){
		$db = $this->db->select('name')->from('items')->like('name', $name)->get();
		if ($db->num_rows() > 0) {
			return $db->result_array();
		}
		return false;
	}

	public function add_item($session_id){
		$data = $this->input->post();
		$data['account_id']	 = $session_id[0]['id'];
		$data['date_posted'] = date('Y-m-d');
		$this->db->insert('items', $data);

		return $this->db->insert_id();
	}

	public function add_tags($itemid, $tags){
		foreach ($tags as $key => $value) {
			$this->db->insert('tags', array('tag_term' => $value, 'tag_parent' => $itemid));
		}
		return true;
	}

	public function update_wishlist($item_id, $unwishlist = false){
		$account_id = $this->_get_session_data()[0]['id'];
		$data = $this->db->get_where('wishlist', array('item_id' => $item_id, 'account_id' => $account_id));
		if ($unwishlist) {
			$this->db->where(array('item_id' => $item_id, 'account_id' => $account_id));
			$this->db->delete('wishlist');
			return 'true unwishlist';
		}else if($data->num_rows() == 0) {
			$this->db->insert('wishlist', array('item_id' => $item_id, 'account_id' => $account_id));
			return 'true wishlist';
		}
		return 'false';
	}

	public function fetch_wishlist($item_id, $account_id, $unfavorite = false){
		$data = $this->db->get_where('wishlist', array('item_id' => $item_id, 'account_id' => $account_id));
		if ($data->num_rows() > 0) {
			return $data->result_array();
		}
	}

	public function update_favorite($item_id, $account_id, $unfavorite = false){
		$account_id = $account_id[0]['id'];
		$data = $this->db->get_where('favorites', array('item_id' => $item_id, 'account_id' => $account_id));

		if ($unfavorite) {
			$this->db->where(array('item_id' => $item_id, 'account_id' => $account_id));
			$this->db->delete('favorites');
			return 'true unfavorite';
		}else if($data->num_rows() == 0) {
			$this->db->insert('favorites', array('item_id' => $item_id, 'account_id' => $account_id));
			return 'true favorite';
		}
		return 'false';
	}

	public function fetch_favorite($item_id, $account_id){
		$data = $this->db->get_where('favorites', array('item_id' => $item_id, 'account_id' => $account_id));
		if ($data->num_rows() > 0) {
			return $data->result_array();
		}
	}

	public function edit_item($itemid, $data){
		$this->db->where('id', $itemid);
		$this->db->update('items', $data);
		return TRUE;
	}

	public function delete_item($itemid){
		$this->db->delete('items')
		->where('id', $itemid);
		return TRUE;
	}

	public function get_images($itemid){
		$imgdb = $this->db->select('*')
		->from('items_images')
		->where('item_id', $itemid)->get();

		if ($imgdb->num_rows() > 0) {
			return $imgdb->result_array();
		}

		return FALSE;
	}

	public function upload_images($itemid){
		$this->load->library('Upload');
		$this->load->library('image_lib');

		$imageid = $this->input->post('imageid');

		$config['upload_path'] = './asset/img/items';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '*';
		$config['max_width'] = '';
		$config['max_height'] = '';
		$config['remove_spaces'] = TRUE;
		$files = $_FILES['userfile'];
		$_FILES['images[]']['name']= $files['name'];
		$_FILES['images[]']['type']= $files['type'];
		$_FILES['images[]']['tmp_name']= $files['tmp_name'];
		$_FILES['images[]']['error']= $files['error'];
		$_FILES['images[]']['size']= $files['size'];

		$new_image = $this->image_lib->explode_name($files['name']);
		$images[] = $fileName = url_title(microtime() . '_' .$new_image['name']) . $new_image['ext'];

		$config['file_name'] = $fileName;
		$this->upload->initialize($config);

		if ($this->upload->do_upload('images[]')) {
			$this->_upload_create_thumbnail($images, $itemid, $imageid);
			redirect("item/upload/$itemid/1");
		} else {
			return FALSE;
		}
	}

	public function get_item_images($itemid){
		$img = $this->db->select('*')
		->from('items_images')
		->where('item_id', $itemid)->get();

		if ($img->num_rows() > 0) {
			if ($img->num_rows() == 4) {
				return $img->result_array();
			}

			$images = $img->result_array();
			for ($i=0; $i < 3; $i++) {
				if (count($images) == 4) {
					return $images;
				}
				array_push($images, array('itemid' => $itemid, 'image' => 'default.png', 'image_thumb' => 'default_thumb.png'));
			}
			return $images;
		}

		return FALSE;
	}

	public function get_items_images_count($items_images){
		$i = 0;
		if ($items_images !== FALSE) {
			foreach ($items_images as $image) {
				if (isset($image['id'])) {
					$i++;
				}
			}
			return $i;
		}
		return $i;
	}

	public function delete_item_images($data){
		$this->load->helper('file');

		$img = $this->db->select('image, image_thumb')
		->from('items_images')
		->where('id', $data['imageid'])->get();

		if ($img->num_rows() > 0) {
			$result = $img->result();
			unlink('./asset/img/items_thumbs/' . $result[0]->image_thumb);
			unlink('./asset/img/items/' . $result[0]->image);

			return $this->db->delete('items_images', array('id' => $data['imageid']));
		}
	}

	public function get_item_comments($itemid){
		$comments = $this->db->select('*')
		->from('item_comments')
		->join('accounts', 'accounts.id = account_id', 'left')
		->where('item_id', $itemid)
		->order_by('comment_date_inserted', 'DESC')
		->get();

		if ($comments->num_rows() > 0) {
			$data = $comments->result_array();
			if (empty($data[0]['profile_img_thumb'])) {
				$data[0]['profile_img_thumb'] = 'default_thumb.JPG';
			}

			return $data;
		}

		return FALSE;
	}

	public function add_item_comment(){
		if ($this->_get_session_data() && $this->input->post()) {
			$data = $this->input->post();
			$data['account_id'] = $this->_get_session_data()[0]['id'];
			$data['comment_date_inserted'] = date('Y-m-d H:i:s');
			return $this->db->insert('item_comments', $data);
		}
	}

	public function delete_offered_item($item_id, $item_offer_id){
		$where['item_id'] =  $item_id;
		$where['offer_item_id'] = $item_offer_id;
		$this->db->where($where);
		$this->db->delete('offers');

		$where['item_id'] =  $item_offer_id;
		$where['offer_item_id'] = $item_id;
		$this->db->where($where);
		$this->db->delete('offers');

		return true;
	}

	public function get_saved_searches(){
		if($this->_get_session_data()){
			$account_id = $this->_get_session_data()[0]['id'];
			$saved_searches = $this->db->query("SELECT saved_searches.*, COUNT(items.id) as result FROM saved_searches LEFT JOIN items ON INSTR(UPPER(items.name), UPPER(saved_searches.keyword)) > 0 WHERE saved_searches.account_id =".$account_id." GROUP BY saved_searches.keyword, saved_searches.id, saved_searches.url_query, saved_searches.keyword");
			// echo $this->db->last_query();
			if ($saved_searches->num_rows() > 0) {
				return $saved_searches->result_array();
			}
		}else{
			return false;
		}
	}

	public function post_saved_searches($data = false){
		if ($this->_get_session_data()) {
			if ($data) {
				return $this->db->insert('saved_searches', $data);
			}else{
				$data = $this->input->post();
				return $this->db->insert('saved_searches',
				array(
					'keyword' => $data['term'],
					'url_query' => $data['url_query'],
					'is_favorite' => 1,
					'account_id' => $this->_get_session_data()[0]['id'],
					'date_created' => date('Y-m-d H:i:s')
					)
				);
			}
		}
	}

}
