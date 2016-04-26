<?php

	function echo_if_not_empty($var, $default = ''){
		if ($var) {
			echo $var;
		}else {
			echo $default;
		}
	}

	function linkify_to_item($id, $name){
		echo base_url('item') . '/' . $id . '/' . url_title($name);
	}

	function linkify_to_compare($item, $item_offer){
		echo base_url('item') . '/' . 'compare/' . $item . '/' . $item_offer;
	}

	function linkify_to_tags($tag_term, $tag_id, $_get = NULL){
		if ($_get !== NULL && is_array($_get)) {
			unset($_get['tag']);
			$url = '?' . http_build_query($_get) . '&';
		}else{
			$url = '?';
		}

		echo base_url('home') . $url ."tag=" . urlencode($tag_term) . '&id=' . $tag_id;
	}

	function linkify_to_images($image_thumb){
		echo base_url('asset/img/items_thumbs') . '/' . $image_thumb;
	}

	function linkify_to_profile($profile){
		echo base_url('profile') . '/' . $profile;
	}

	function linkify_to_add(){
		echo base_url('item/add');
	}

	function linkify_to_edit($id){
		echo base_url('item/edit/' . $id);
	}

	function linkify_to_category($category, $_get = NULL){

		if ($_get !== NULL && is_array($_get)) {
			unset($_get['category']);
			$url = '?' . http_build_query($_get) . '&';
		}else{
			$url = '?';
		}

		echo base_url('home') . $url ."category=$category";
	}

?>
