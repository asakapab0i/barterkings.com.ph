<?php if($offers !== FALSE): ?>
	<?php foreach($offers as $offer): ?>
		<div class="media">
			<p class="pull-right"><small><?php echo timespan(strtotime($offer['offer_date_inserted'])); ?> ago</small></p>
			<a class="media-left" href="#">
				<!--  <img src="http://lorempixel.com/40/40/people/4/"> -->
			</a>
			<div class="media-body">
				<a href="#" title=""><?php echo $offer['name'] . ' - ' . $offer['value']; ?></a>
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
				<a href="#" title="">No offers yet.</a>
			</div>
		</div>
<?php endif;?>