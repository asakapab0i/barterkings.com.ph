<?php 

	function linkify_to_item($id, $name){
		echo base_url('item') . '/' . $id . '/' . url_title($name);
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