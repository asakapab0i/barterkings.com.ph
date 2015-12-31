<?php 
if (isset($items)) {
	$data = $items;
}
?>
<?php if($data !== FALSE): ?>

	<?php foreach ($data as $value): 
	if ($value->image_thumb === NULL):
		$value->image_thumb = 'default_thumb.JPG';
	endif;
	?>
	<div class="item-card-parent col-sm-12 col-xs-12 col-md-3 col-lg-3">
		<div class="thumbnail bootsnipp-thumb">
			<div class="image-card">
				<div class="user-info-card">
					by <a href="<?php echo base_url('profile/' . $value->username); ?>"><?php echo $value->username; ?></a>
					<span class="pull-right label label-default">
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 212
					</span>

					<!-- <span class="pull-right glyphicon glyphicon-eye-open" aria-hidden="true"><i class="item-card-views">21K</i></span> -->
				</div>
				<a href="<?php echo base_url('item')?>/<?php echo $value->item_id; ?>">
					<img width="200" height="200" src="<?php echo base_url('asset/img/items_thumbs'); ?>/<?php echo $value->image_thumb; ?>" alt="test">
				</a>
				<p class="snipp-title">
					<a title="<?php echo $value->name; ?>" href="<?php echo base_url('item')?>/<?php echo $value->item_id; ?>/<?php echo url_title($value->name); ?>"><?php echo character_limiter(word_wrap($value->name), 40); ?></a>
				</p>
				<span class="item-card-location label label-success"><?php echo $value->location != '' ? $value->location : 'none'; ?></span>
			</div>

			<div class="row">
				<div class="col-md-12">
				<div class="btn-group btn-block">
					<a href="<?php echo base_url('item')?>/<?php echo $value->item_id; ?>/<?php echo url_title($value->name); ?>" class="btn col-md-6 btn-sm btn-primary">PHP <?php echo $value->value; ?></a>
					<button data-toggle="tooltip" data-placement="top" title="Favorite" type="button" class="col-md-3 btn-sm btn btn-warning"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
					<button data-toggle="tooltip" data-placement="top" title="Love" type="button" class="col-md-3 btn btn-sm btn-danger"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
				</div>
			</div>
			</div>
			<!-- <div class="caption text-center">
				
				<div class="row">
					<div class="btn-group" role="group">
						<a href="<?php echo base_url('item')?>/<?php echo $value->item_id; ?>/<?php echo url_title($value->name); ?>" class="btn btn-primary">PHP <?php echo $value->value; ?></a>
						
					</div>
					<div class="btn-group extra-cart-links" role="group" aria-label="#">
						
					</div>
				</div>
			</div> -->
		</div>
	</div>	
<?php endforeach;?>
<?php else:?>
	<!-- If no items found -->
<?php endif;?>




