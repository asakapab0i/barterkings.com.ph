<div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title">Refine your search</h3>
	</div>

</div>


<div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h4 class="panel-title">Price Range</h4>
	</div>
	<div class="panel-body">
		<form action="<?php echo base_url('home') ;?>" method="GET">
			<div class="col-md-12">

				<?php if ($this->input->get('sort')): ?>
					<input name='sort' value='<?php echo $this->input->get("sort"); ?>' type='hidden' />
				<?php endif; ?>

				<input class="slider" name="price_range" 
				data-slider-id='ex1Slider' type="text" 
				data-slider-ticks="[0, 20000]" 
				data-slider-ticks-labels='["₱ 0", "20000+"]' 
				data-slider-min="0" 
				data-slider-max="20" 
				data-slider-step="1" 
				data-slider-value="<?php echo $this->input->get('price_range') ? $this->input->get('price_range') : 0; ?>" />

				<?php if ($this->input->get('ad_age')): ?>
					<input name='ad_age' value='<?php echo $this->input->get("ad_age"); ?>' type='hidden' />
				<?php endif; ?>
			</div>
			<div class="col-md-12" style="margin-top: 5px;">
				<input class="pull-right btn-block btn btn-xs btn-success" value="update" type="submit" />
			</div>
		</form>
	</div>

</div>

<div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h4 class="panel-title">Popular Searches</h4>
	</div>
	<div class="panel-body">

	</div>

</div>

<div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h4 class="panel-title">Categories</h4>
	</div>
	<div class="panel-body">

	</div>

</div>

<div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h4 class="panel-title">Ad Age</h4>
	</div>
	<div class="panel-body">

	<form action="<?php echo base_url('home') ;?>" method="GET">
			<div class="col-md-12">
			<?php if ($this->input->get('sort')): ?>
					<input name='sort' value='<?php echo $this->input->get("sort"); ?>' type='hidden' />
			<?php endif; ?>
			<?php if ($this->input->get('price_range')): ?>
					<input name='price_range' value='<?php echo $this->input->get("price_range"); ?>' type='hidden' />
			<?php endif; ?>
				<input class="slider" name="ad_age" 
					data-slider-id='ex1Slider' type="text" 
					data-slider-ticks="[1, 90]" 
					data-slider-ticks-labels='["1 Day", "90+ Days"]' 
					data-slider-min="0" 
					data-slider-max="20" 
					data-slider-step="1" 
					data-slider-value="<?php echo $this->input->get('ad_age') ? $this->input->get('ad_age') : 0; ?>" />
			</div>
			<div class="col-md-12" style="margin-top: 5px;">
				<input class="pull-right btn-block btn btn-xs btn-success" value="update" type="submit" />
			</div>
		</form>
	</div>

</div>





