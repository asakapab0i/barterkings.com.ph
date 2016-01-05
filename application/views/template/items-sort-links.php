<?php 

if ($this->input->get()) {

	$urls = $this->input->get();

	if (isset($urls['sort']) || (isset($urls['term']) && isset($urls['term'])) ) {
		unset($urls['sort']);
		$url = http_build_query($urls);
	}

}

?>

<small class="listing-sort-label clearfix">
	Sort by: 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_recent"; ?>">Most Recent</a> 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_offers"; ?>">Most Offers</a> 
	<!-- <a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_viewed"; ?>">Most Viewed</a> 
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=most_liked"; ?>">Most Liked</a> -->
	<a href="<?php echo base_url('home') .(isset($url) ? '?' . $url . '&' : '?' ) . "sort=all"; ?>">All</a>
</small>
<small class="pull-right listing-sort-label">
	<!-- <a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
	<a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a> -->
	<form class="form-inline listing-order-label" method="get">
		<div class="form-group">
			<label for="exampleInputName2">Order price: </label>
			<?php if ($this->input->get('term')): ?>
					<input name='term' value='<?php echo $this->input->get("term"); ?>' type='hidden' />
				<?php endif; ?>

				<?php if ($this->input->get('sort')): ?>
					<input name='sort' value='<?php echo $this->input->get("sort"); ?>' type='hidden' />
				<?php endif; ?>
				<?php if ($this->input->get('price_range')): ?>
					<input name='price_range' value='<?php echo $this->input->get("price_range"); ?>' type='hidden' />
				<?php endif; ?>
				<?php if ($this->input->get('ad_age')): ?>
					<input name='ad_age' value='<?php echo $this->input->get("ad_age"); ?>' type='hidden' />
				<?php endif; ?>
			<select name="order" class="form-control input-sm">
				<option <?php echo ($this->input->get('order') == 'desc' ? 'selected':'' ); ?> value="desc">Highest to lowest</option>	
				<option <?php echo ($this->input->get('order') == 'asc' ? 'selected':'' ); ?> value="asc">Lowest to highest</option>	
			</select>
		</div>
	</form>

</small>