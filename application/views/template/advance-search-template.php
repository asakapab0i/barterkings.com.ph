<form action="<?php echo base_url('home/item'); ?>" class="well well-no-bg">
	<div class="form-group">
		<label for="item">Search Items</label>
		<input value="<?php if(isset($search['item'])) echo $search['item']; ?>" name="item" type="text" class="form-control" id="item" placeholder="">
	</div>
	<div class="form-group">
		<label for="location">Location</label>
		<input type="text" class="form-control" id="location" name="location">	
	</div>
	<div class="form-group">
		<label for="category">Category</label>
		<select class="form-control" id="category" name="category">
			<option></option>
			<option>Computer Electronics</option>
			<option>Animals And Pet</option>
			<option>Goods And Services</option>
			<option>Food Package</option>
			<option>Coupons</option>
		</select>
	</div>
	<div class="form-group">
		<label for="value">Price Range</label>
		<select class="form-control" id="location" name="location">
			<option></option>
			<option>0 > 500</option>
			<option>500 > 5000</option>
			<option>5000 > 10000</option>
			<option>10000 ></option>
		</select>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-default btn-block btn-primary">Search</button>
	</div>
</form>