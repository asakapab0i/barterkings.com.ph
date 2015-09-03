<div class="container">
	<div class="col-md-3">
		<form action="<?php echo base_url('home/item'); ?>" class="well well-no-bg">
			<div class="form-group">
				<label for="item">Search Items</label>
				<input name="item" type="text" class="form-control" id="item" placeholder="">
			</div>
			<div class="form-group">
				<label for="category">Location</label>
				<select name="location" class="form-control">
					<option></option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="form-group">
				<label for="category">Category</label>
				<select name="category" class="form-control">
					<option></option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="form-group">
				<label for="size">Size</label>
				<select name="size" class="form-control">
					<option></option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="form-group">
				<label for="value">Price Range</label>
				<select name="value" class="form-control">
					<option></option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-default btn-block btn-primary">Search</button>
			</div>
		</form>
	</div>
	<div class="col-md-9">
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
		<div class="row">
			<div align="center">
				<ul class="pagination">
					<li class="disabled"><a href="#">«</a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">»</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php else:?>
	<p>No items found. Try different keywords.</p>
</div>
</div>
<?php endif;?>




