<?php 

if ($this->input->get()) {

	$urls = $this->input->get();

	if (isset($urls['sort']) || (isset($urls['term']) && isset($urls['term'])) ) {
		unset($urls['sort']);
		$url = http_build_query($urls);
	}

}

?>

<small class="listing-sort-label">
	Sort by: 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_recent"; ?>">Most Recent</a> 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_offers"; ?>">Most Offers</a> 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_viewed"; ?>">Most Viewed</a> 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_liked"; ?>">Most Liked</a>
</small>
<small class="pull-right listing-sort-label">
	<!-- <a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
	<a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a> -->
	Order price:
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "order=highest"; ?>">Highest</a> 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "order=lowest"; ?>">Lowest</a> 
	

</small>