<?php
if (isset($items)) {
	$data = $items;
}
?>
<?php if($data !== FALSE): ?>

	<?php foreach ($data as $value):
	if ($value->image_thumb === NULL):
		$value->image_thumb = 'default_thumb.png';
	endif;
	?>
	<div class="item-card-parent col-sm-12 col-xs-12 col-md-3 col-lg-3">
		<div class="thumbnail bootsnipp-thumb">
			<div class="image-card">
				<div class="user-info-card">
					<a href="<?php echo base_url('profile/' . $value->username); ?>"><span class="label label-primary"><?php echo ucfirst($value->username); ?></span></a>
				</div>
				<a href="<?php echo base_url('item')?>/<?php echo $value->item_id; ?>/<?php echo url_title($value->name); ?>">
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
					<a href="<?php echo base_url('item')?>/<?php echo $value->item_id; ?>/<?php echo url_title($value->name); ?>" class="btn col-md-6 btn-sm btn-primary">₱<?php echo $value->value; ?></a>
					<button id="favorite-btn" data-url="item/favorite" data-item-id="<?php echo $value->item_id; ?>" data-toggle="tooltip" data-placement="top" title="Favorite" type="button" class="col-md-3 btn-sm btn btn-warning"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
					<button id="love-btn" data-url="item/love" data-item-id="<?php echo $value->item_id; ?>" data-toggle="tooltip" data-placement="top" title="Love" type="button" class="col-md-3 btn btn-sm btn-danger"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
				</div>
			</div>
			</div>

		</div>
	</div>
<?php endforeach;?>
<?php else:?>
<?php endif;?>
