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

?>