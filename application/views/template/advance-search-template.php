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