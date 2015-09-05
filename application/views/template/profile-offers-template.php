<?php if(isset($offers) AND $offers !== FALSE): ?>
	<?php foreach($offers as $offer): ?>
		<?php ?>
		<div class="media">
			<p class="pull-right"><small><?php echo timespan(strtotime($offer['offer_date_inserted'])); ?> ago</small></p>
			<a class="media-left" href="#">
				 <img height="40" width="40" src="<?php echo base_url('asset/img/items_thumbs') .'/'. $offer['image_thumb']; ?>">
			</a>
			<div class="media-body">
				<a data-url="offer/view_by_id" class="pop-modal" href="#" data-itemid="<?php echo $offer['offer_id']; ?>" title=""><?php echo character_limiter($offer['name'], 50) . ' - ' . $offer['value']; ?></a>
			</div>
		</div>
	<?php endforeach;?>
<?php else: ?>
	<div class="media">
			<p class="pull-right"><small></small></p>
			<a class="media-left" href="#">
				<!--  <img src="http://lorempixel.com/40/40/people/4/"> -->
			</a>
			<div class="media-body">
				<p>No offers yet.</p>
			</div>
		</div>
<?php endif;?>