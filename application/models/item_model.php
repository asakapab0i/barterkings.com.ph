<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends CI_Model {

	private $items;

	public function __construct(){
		parent::__construct();
		$this->load->model('offer_model');

		//$this->output->enable_profiler(true);
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
		$itemdb = $this->db->select('accounts.id, items.account_id, username, name, type, status, value, description, category, size, location')
		->from('items')
		->join('accounts', 'items.account_id = accounts.id', 'left')
		->where('items.id', $itemid)
		->get();

		if ($itemdb->num_rows() == 1) {
			return $itemdb->result();
		}

		return FALSE;
	}

	public function get_items_by_account_id($account_id, $itemid){

		$current_item_offers = $this->offer_model->get_item_offers($itemid);
		if ($current_item_offers !== FALSE) {
			foreach ($current_item_offers as $offer) {
				$cio[] = $offer['offer_item_id'];
			}
			$itemsdb = $this->db->select('*')
			->from('items')
			->group_by('items.id')
			->join('offers', 'offer_item_id = items.id', 'left')
			->where('account_id', $account_id)
			->where_not_in('offer_item_id', $cio)
			//->where('offers.item_id', $itemid)
			->get();
		}else{
			$itemsdb = $this->db->select('*')
			->from('items')
			->group_by('items.id')
			->join('offers', 'offer_item_id = items.id', 'left')
			->where('account_id', $account_id)
			->get();
		}

		if ($itemsdb->num_rows() > 0) {
			return $itemsdb->result_array();
		}
		return FALSE;
	}

	public function get_items($limit = 12, $offset = ''){
		$itemsdb = $this->db->select('items.id as itemid, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
		->from('items')
		->join('items_images', 'item_id = items.id', 'left')
		->limit($limit, $offset)
		->group_by('items.id')
		->get();

		if ($itemsdb->num_rows() > 0) {
			return $itemsdb->result();
		}

		return FALSE;
	}

	public function get_items_search(){
		$search = $this->input->get();

		$itemsdb = $this->db->select('items.id as itemid, name, type, status, value, description, category, size, location, items_images.id as item_imagesid, image, image_thumb')
		->from('items')
		->join('items_images', 'item_id = items.id', 'left')
		->like('name', $search['item'])
		->get();

		if ($itemsdb->num_rows() > 0) {
			return $itemsdb->result();
		}

		return FALSE;
	}

	public function add_item($session_id){
		$data = $this->input->post();
		$data['account_id']	 = $session_id[0]['id'];
		$this->db->insert('items', $data);
		return $this->db->insert_id();
	}

	public function edit_item($itemid){
		$this->db->update('items', $this->input->post())
		->where('id', $itemid);
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
				array_push($images, array('itemid' => $itemid, 'image' => 'default.JPG', 'image_thumb' => 'default_thumb.JPG'));
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
			return $comments->result_array();
		}

		return FALSE;
	}

	public function add_item_comment(){
		$data = $this->input->post();
		$data['comment_date_inserted'] = date('Y-m-d H:i:s');
		return $this->db->insert('item_comments', $data);	
	}


}
