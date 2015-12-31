<?php if($images !== FALSE): ?>
	<?php foreach($images as $image): ?>
		<?php $name = $image['image_thumb']; ?>
		<div class="">
			<img src="<?php echo base_url("asset/img/items_thumbs/$name"); ?>" alt="teste" class="thumbnail img-thumbnail">
		</div>	
	<?php endforeach;?>
<?php else: ?>
	<!-- <div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.JPG"); ?>" alt="teste" class="img-thumbnail">
	</div>
	<div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.JPG"); ?>" alt="teste" class="img-thumbnail">
	</div>	
	<div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.JPG"); ?>" alt="teste" class="img-thumbnail">
	</div>	
	<div class="col-md-3 col-sm-3">
		<img src="<?php echo base_url("asset/img/items_thumbs/default_thumb.JPG"); ?>" alt="teste" class="img-thumbnail">
	</div>		 -->
<?php endif;?>