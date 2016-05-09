<?php if($images !== FALSE): ?>
	<?php foreach($images as $image): ?>
		<?php $name = $image['image_thumb'];  $large = $image['image']?>
		<?php $is_default = ($name == 'default_thumb.png' ? '' : 'data-gallery'); ?>
		<div class="col-md-3">
			<?php if($is_default != ''): ?>
			<a href="<?php echo base_url("asset/img/items/$large"); ?>" title="<?php echo url_title($name); ?>" <?php echo $is_default; ?>>
				<img src="<?php echo base_url("asset/img/items_thumbs/$name"); ?>" alt="<?php echo url_title($name); ?>" class="img-product thumbnail img-responsive img-thumbnail">
			</a>
			<?php else:?>
				<img src="<?php echo base_url("asset/img/items_thumbs/$name"); ?>" alt="<?php echo url_title($name); ?>" class="img-product thumbnail img-responsive img-thumbnail">
			<?php endif;?>
		</div>
	<?php endforeach;?>
<?php else: ?>
	<div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.png"); ?>" alt="No Product Image" class="img-thumbnail">
	</div>
	<div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.png"); ?>" alt="No Product Image" class="img-thumbnail">
	</div>
	<div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.png"); ?>" alt="No Product Image" class="img-thumbnail">
	</div>
	<div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.png"); ?>" alt="No Product Image" class="img-thumbnail">
	</div>
<?php endif;?>
