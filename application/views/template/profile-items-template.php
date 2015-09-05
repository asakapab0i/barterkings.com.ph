<?php if(isset($items) AND $items !== FALSE): ?>
	<?php foreach ($items as $item): 
	if ($item['image_thumb'] === NULL):
		$item['image_thumb'] = 'default_thumb.JPG';
	endif;
	?>
	<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
		<div class="thumbnail bootsnipp-thumb">
			<div>
				<p class="snipp-title text-center">
					<a title="<?php echo $item['name']; ?>" href="#"><?php echo character_limiter($item['name'], 15); ?></a>
				</p>
			</div>
			<a href="<?php echo base_url('item')?>/<?php echo $item['item_id']; ?>/<?php echo url_title($item['name']); ?>">
				<img width="200" height="200" src="<?php echo base_url('asset/img/items_thumbs'); ?>/<?php echo $item['image_thumb']; ?>" alt="test">
			</a>
			<div class="caption">
				<p><a href="<?php echo base_url('item')?>/<?php echo $item['item_id']; ?>/<?php echo url_title($item['name']); ?>" class="btn btn-primary btn-block">View</a></p>
			</div>
		</div>
	</div>	
<?php endforeach;?>
<?php else: ?>
	<div class="container">
		<div class="text-center">
			No items posted.	
		</div>	
	</div>
<?php endif;?>