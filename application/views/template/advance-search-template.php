<!-- <div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title">Refine your search</h3>
	</div>

</div>

-->
<div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h4 class="panel-title">Price Range</h4>
	</div>
	<div class="panel-body">
		<form action="<?php echo base_url('home') ;?>" method="GET">
			<div class="col-md-12">

				<?php if ($this->input->get('term')): ?>
					<input name='term' value='<?php echo $this->input->get("term"); ?>' type='hidden' />
				<?php endif; ?>

				<?php if ($this->input->get('sort')): ?>
					<input name='sort' value='<?php echo $this->input->get("sort"); ?>' type='hidden' />
				<?php endif; ?>

				<?php if ($this->input->get('order')): ?>
					<input name='order' value='<?php echo $this->input->get("order"); ?>' type='hidden' />
				<?php endif; ?>

				<input class="slider" name="price_range"
				data-slider-id='ex1Slider' type="hidden"
				data-slider-ticks="[0, 100000]"
				data-slider-ticks-labels='["0", "100000"]'
				data-slider-min="0"
				data-slider-max="100"
				data-slider-step="1"
				data-slider-value="<?php echo $this->input->get('price_range') ? $this->input->get('price_range') : 0; ?>" />

				<?php if ($this->input->get('ad_age')): ?>
					<input name='ad_age' value='<?php echo $this->input->get("ad_age"); ?>' type='hidden' />
				<?php endif; ?>

				<?php if ($this->input->get('category')): ?>
					<input name='category' value='<?php echo $this->input->get("category"); ?>' type='hidden' />
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
		<h4 class="panel-title">Categories</h4>
	</div>
	<div class="panel-body">
		<ul class="list-group list-category">
			<?php $urls = $this->input->get(); ?>
			<?php foreach($_categories as $key => $val): ?>

				<a href="<?php linkify_to_category($val['link'], $urls); ?>" class="list-group-item <?php echo (isset($urls['category']) && $urls['category'] == $val['link']) ? 'active' : '' ?>">
					   <span class="label label-success pull-right" style="background-color: <?php echo $val['color']?>"><?php echo $val['count']; ?></span>
					<small>
						<?php echo $key; ?>
					</small>
				</a>

			<?php endforeach; ?>

		</ul>
	</div>

</div>

<div class="search-panel panel panel-default">

	<div class="panel-heading">
		<h4 class="panel-title">Ad Age</h4>
	</div>
	<div class="panel-body">

		<form action="<?php echo base_url('home') ;?>" method="GET">
			<div class="col-md-12">

				<?php if ($this->input->get('term')): ?>
					<input name='term' value='<?php echo $this->input->get("term"); ?>' type='hidden' />
				<?php endif; ?>

				<?php if ($this->input->get('sort')): ?>
					<input name='sort' value='<?php echo $this->input->get("sort"); ?>' type='hidden' />
				<?php endif; ?>

				<?php if ($this->input->get('order')): ?>
					<input name='order' value='<?php echo $this->input->get("order"); ?>' type='hidden' />
				<?php endif; ?>

				<?php if ($this->input->get('price_range')): ?>
					<input name='price_range' value='<?php echo $this->input->get("price_range"); ?>' type='hidden' />
				<?php endif; ?>
				<input class="slider" name="ad_age"
				data-slider-id='ex1Slider' type="hidden"
				data-slider-ticks="[1, 90]"
				data-slider-ticks-labels='["1 Day", "90+ Days"]'
				data-slider-min="0"
				data-slider-max="20"
				data-slider-step="1"
				data-slider-value="<?php echo $this->input->get('ad_age') ? $this->input->get('ad_age') : 0; ?>" />

				<?php if ($this->input->get('category')): ?>
					<input name='category' value='<?php echo $this->input->get("category"); ?>' type='hidden' />
				<?php endif; ?>
			</div>

			<div class="col-md-12" style="margin-top: 5px;">
				<input class="pull-right btn-block btn btn-xs btn-success" value="update" type="submit" />
			</div>
		</form>
	</div>

</div>
