<?php if($data !== FALSE): ?>
	<?php if(isset($search) && $search !== FALSE): ?>
		<div class="container">
			<div class="pull-left">
				<p>Search for: <b><?php echo $search['item']; ?></b></p>
			</div>
		</div>
	<?php endif;?>

	<?php foreach ($data as $value): 
	if ($value->image_thumb === NULL):
		$value->image_thumb = 'default_thumb.JPG';
	endif;
	?>
	<div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
		<div class="thumbnail bootsnipp-thumb">
			<div>
				<p class="snipp-title text-center">
					<a title="<?php echo $value->name; ?>" href="<?php echo base_url('item')?>/<?php echo $value->itemid; ?>/<?php echo url_title($value->name); ?>"><?php echo character_limiter($value->name, 15); ?></a>
				</p>
			</div>
			<a href="<?php echo base_url('item')?>/<?php echo $value->itemid; ?>">
				<img width="200" height="200" src="<?php echo base_url('asset/img/items_thumbs'); ?>/<?php echo $value->image_thumb; ?>" alt="test">
			</a>
			<div class="caption">
				<p><a href="<?php echo base_url('item')?>/<?php echo $value->itemid; ?>/<?php echo url_title($value->name); ?>" class="btn btn-primary btn-block">View</a></p>
			</div>
		</div>
	</div>	
<?php endforeach;?>
<div class="col-md-12">
	<button class="btn btn-primary btn-block">More</button>	
</div>
</div>
<?php else:?>
	<p>No items found. Try different keywords.</p>
<?php endif;?>




