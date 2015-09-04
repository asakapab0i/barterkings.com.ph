<?php if(isset($data) AND $data !== FALSE): ?>
	<?php foreach ($data as $value): 
	if ($value['image_thumb'] === NULL):
		$value['image_thumb'] = 'default_thumb.JPG';
	endif;
	?>
	<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
		<div class="thumbnail bootsnipp-thumb">
			<div>
				<p class="snipp-title text-center">
					<a title="<?php echo $value['name']; ?>" href="#"><?php echo character_limiter($value['name'], 15); ?></a>
				</p>
			</div>
			<a href="<?php echo base_url('item')?>/<?php echo $value['item_id']; ?>/<?php echo url_title($value['name']); ?>">
				<img width="200" height="200" src="<?php echo base_url('asset/img/items_thumbs'); ?>/<?php echo $value['image_thumb']; ?>" alt="test">
			</a>
			<div class="caption">
				<p><a href="<?php echo base_url('item')?>/<?php echo $value['item_id']; ?>/<?php echo url_title($value['name']); ?>" class="btn btn-primary btn-block">View</a></p>
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