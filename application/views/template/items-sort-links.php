<?php 
	if ($this->input->get('price_range')) {
		$range = '?price_range=' .$this->input->get('price_range') . '&';
	}else{
		$range = '?';
	}

?>

<small class="listing-sort-label clearfix">
	Sort by: 
	<a href="<?php echo base_url('home') . $range . "sort=most_recent"; ?>">Most Recent</a> 
	<a href="<?php echo base_url('home') . $range . "sort=most_offers"; ?>">Most Offers</a> 
	<a href="<?php echo base_url('home') . $range . "sort=most_viewed"; ?>">Most Viewed</a> 
	<a href="<?php echo base_url('home') . $range . "sort=most_liked"; ?>">Most Liked</a>
</small>
<!-- <small class="pull-right">
	<a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
	<a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a>
</small> -->