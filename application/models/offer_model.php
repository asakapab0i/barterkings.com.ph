<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer_model extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->model('account_model');
		$this->load->model('message_model');
	}

	public function add_offer(){
		$this->load->helper('date');
		$data = $this->input->post();
		$data['offer_date_inserted'] = date('Y-m-d H:i:s');
		$this->db->insert('offers', $data);

		$data['item_id'] = $this->input->post('offer_item_id');
		$data['offer_item_id'] = $this->input->post('item_id');
		$this->db->insert('offers', $data);

		return TRUE;
	}

	public function get_item_offers($itemid){

		$offerdb = $this->db->select('*')
		->from('offers')
		->join('items', 'offers.offer_item_id = items.id', 'left')
		->join('items_images', 'offers.offer_item_id = items_images.item_id', 'left')
		->where('offers.item_id', $itemid)
		->group_by('offers.offer_id')
		->order_by('offer_date_inserted', 'DESC')
		->get();

		if ($offerdb->num_rows() > 0) {

			return $offerdb->result_array();
		}

		return FALSE;
	}

	public function get_item_offers_by_account_id(){
		$sess = $this->account_model->get_session();

		$offersdb = $this->db->select('*')
		->from('items')
		->where('account_id', $sess[0]['id'])
		->get();

		if ($offersdb->num_rows() > 0) {
			return $offersdb->result_array();
		}

		return FALSE;
	}

	public function get_offered_items_by_account_id($account_id, $limit = 4){
		$sess = $this->account_model->get_session();

		$offered = $this->db->select('*')
		->from('offers')
		->join('items', 'items.id = item_id', 'left')
		->join('items_images', 'items_images.item_id = items.id')
		->join('accounts', 'accounts.id = items.account_id', 'left')
		->where('items.account_id', $sess[0]['id'])
		->or_where('items.account_id', $account_id)
		->group_by('items.id')
		->limit($limit)
		->get();

		if ($offered->num_rows() > 0) {
			return $offered->result_array();
		}

		return FALSE;
	}

	public function save_edit_offer($offerid){
		$this->db->update('offer', $this->input->post())
		->where('offer_id', $offerid);
	}

	public function get_offer_by_id($offerid){
		$offerdb = $this->db->select('*')
		->from('offers')
		->join('items', 'items.id = offers.offer_item_id', 'left')
		->join('accounts', 'accounts.id = items.account_id', 'left')
		->join('items_images', 'offers.offer_item_id = items_images.item_id', 'left')
		->where('offer_id', $offerid)
		->get();

		if ($offerdb->num_rows() > 0) {
			return $offerdb->result_array();
		}

		return FALSE;
	}

	public function is_offer_owner_by_offer_id($account_id, $offer_id){
		$ownerdb = $this->db->select('accounts.id as aid')
		->from('offers')
		->join('items', 'items.id = offers.item_id', 'left')
		->join('accounts', 'items.account_id = accounts.id', 'left')
		->where('offer_id', $offer_id)
		->get();

		if ($ownerdb->num_rows > 0) {
			$data = $ownerdb->result_array();

			if ($data[0]['aid'] == $account_id) {
				return TRUE;
			}
		}

		return FALSE;
	}
}
