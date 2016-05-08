<?php if($images !== FALSE): ?>
	<?php foreach($images as $image): ?>
		<?php $name = $image['image_thumb'];  $large = $image['image']?>
		<div class="col-md-3">
			<a href="<?php echo base_url("asset/img/items/$large"); ?>" title="<?php echo url_title($name); ?>" data-gallery>
				<img src="<?php echo base_url("asset/img/items_thumbs/$name"); ?>" alt="<?php echo url_title($name); ?>" class="thumbnail img-responsive img-thumbnail">
			</a>
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
