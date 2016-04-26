<?php
if (isset($items)) {
	$data = $items;
}
?>


<div class="row">
	<div class="col-md-12">
		<div class="modal-header">
			<?php if(isset($offered_items) && $offered_items != true): ?>
				<h4>Select item to barter</h4>
			<?php else:?>
				<h4>Offered items</h4>
			<?php endif;?>
		</div>
		<?php if($data !== FALSE): ?>

			<?php foreach ($data as $value):
			if ($value->image_thumb === NULL):
				$value->image_thumb = 'default_thumb.JPG';
			endif;
			?>

			<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
				<div class="thumbnail bootsnipp-thumb">
					<div class="image-card">
						<a href="<?php linkify_to_item($value->a_item_id, $value->name); ?>">
							<img width="200" height="200" src="<?php linkify_to_images($value->image_thumb); ?>" alt="<?php echo $value->name; ?>">
						</a>
						<p class="snipp-title">
							<a title="<?php echo $value->name; ?>"  href="<?php linkify_to_item($value->a_item_id, $value->name); ?>"><?php echo character_limiter(word_wrap($value->name), 40); ?></a>
						</p>
						<span class="item-card-location label label-success"><?php echo $value->location != '' ? $value->location : 'none'; ?></span>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="btn-group btn-block">
								<?php if(isset($offered_items) && $offered_items != true): ?>
								  <a href="<?php linkify_to_item($value->a_item_id, $value->name); ?>" class="btn col-md-6 btn-sm btn-primary">₱<?php echo $value->value; ?></a>
									<a href="#" id="selected-offer" data-item-id="<?php echo $item; ?>" data-item-offer-id="<?php echo $value->a_item_id; ?>" class="btn col-md-6 btn-sm btn-warning">Select</a>
								<?php else:?>
									<a href="<?php linkify_to_compare($item, $value->a_item_id)?>" id="compare-offer" data-item-id="<?php echo $item; ?>" data-item-offer-id="<?php echo $value->a_item_id; ?>" class="btn col-md-6 btn-sm btn-warning">Compare</a>

									<?php if (isset($user) && $user !== false ): ?>
										<a href="#" id="remove-offer" data-item-id="<?php echo $item; ?>" data-item-offer-id="<?php echo $value->a_item_id; ?>" class="btn col-md-6 btn-sm btn-danger">Remove</a>
									<?php else: ?>
								  	<a href="<?php linkify_to_item($value->a_item_id, $value->name); ?>" class="btn col-md-6 btn-sm btn-primary">₱<?php echo $value->value; ?></a>
									<?php endif; ?>

								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>

		<?php endforeach;?>
	<?php else:?>
		<div class="col-md-12 text-center">
			<p>No item found or it was already offered. <a class="btn btn-success btn-xs" href="<?php linkify_to_add() ?>">Add item</a> instead.</p>
		</div>
	<?php endif;?>
</div>
</div>
