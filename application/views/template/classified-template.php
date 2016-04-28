<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">List your item for free!</h3>
	</div>
	<div class="panel-body">
		<?php echo validation_errors(); ?>
		<div class="col-md-8">
			
		<?php echo form_open('item/edit/' . $item[0]['itemid']); ?>

			<div class="row item-form-input">
				<div class="col-xs-1">
					<h4 class="item-instruction-number">1.</h4>
				</div>
				<div class="col-xs-11">
					<h4>Your Item For Sale</h4>
					<div class="item-form-input-body">
						<label>Name</label>
						<input class="form-control" type="text" name="name" value="<?php echo $item[0]['name']; ?>">
					</div>
				</div>
			</div>

			<div class="row item-form-input">
				<div class="col-md-1">
					<h4 class="item-instruction-number">2.</h4>
				</div>
				<div class="col-md-11">
					<h4>Name Your Price</h4>
					<label>Buy Now Price</label>
					<div class="item-form-input-body input-group">

						<span class="input-group-btn">
							<button type="submit" class="btn btn-default">₱</button>
						</span>
						<input class="form-control" type="text" name="value" value="<?php echo_if_not_empty($item[0]['value'], 100); ?>">

					</div>
				</div>
			</div>

			<div class="row item-form-input">
				<div class="col-md-1">
					<h4 class="item-instruction-number">3.</h4>
				</div>
				<div class="col-md-11">
					<h4>Item Details</h4>
					<label>Category</label>

					<select name="category" class="form-control">

						<?php foreach($categories as $key => $val): ?>

							<?php if($val['id'] == $item[0]['category']):  ?>
								<option selected value="<?php echo $val['id']; ?>"><?php echo $key; ?></option>
							<?php else: ?>
								<option value="<?php echo $val['id']; ?>"><?php echo $key; ?></option>
							<?php endif; ?>

						<?php endforeach; ?>

					</select>

					<!-- <input class="form-control" type="text" name="name" value=""> -->
				</div>

				<?php if( false ): //$categories_v2[0]['category_id'] = $item[0]['category'] ?>
					<div class="col-md-1">
					<h4 class="item-instruction-number"></h4>
					</div>

					<div class="col-md-11">
						<label>Sub Category</label>
						<select name="sub_category" class="form-control">

							<?php foreach($sub_categories as $key => $val): ?>
								<?php if($val['sub_category_parent'] == $item[0]['category']): ?>
									<option value="<?php echo $val['sub_category_id']; ?>"><?php echo $val['sub_category_name']; ?></option>
								<?php endif;?>
							<?php endforeach; ?>

						</select>
					</div>
				<?php endif;?>

				<div class="col-md-1">
					<h4 class="item-instruction-number"></h4>
			</div>
				<div class="col-md-11">
					<label>Description</label>
					<textarea id="description-editor" style="height: 250px;" class="form-control" name="description"><?php echo_if_not_empty(trim($item[0]['description']))?></textarea>
				</div>
			</div>


			<div class="row item-form-input" style="margin-top: 10px;">
				<div class="col-md-1">
					<h4 class="item-instruction-number">4.</h4>
				</div>
				<div class="col-md-11">

					<h4><small class="pull-right"><span data-itemid="<?php echo $item[0]['itemid']; ?>" class="reload-images-count">0 </span> images</small> Images
						<a href="#" data-itemid = "<?php echo $item[0]['itemid']; ?>" data-url="item/upload/" data-method="upload" class="pop-modal btn btn-primary btn-xs">Upload</a>
					</h4><hr>

					<div data-itemid="<?php echo $item[0]['itemid']; ?>" class="reload-images">
							<?php $this->load->view('template/images-template'); ?>
					</div>
				</div>
			</div>

			<div class="row item-form-input">
				<div class="col-md-1">
					<h4 class="item-instruction-number">5.</h4>
				</div>

				<div class="col-md-11">
					<h4>Add Tags</h4>
					<label>Manage Tags<small> (Press enter or space to add more tags.)</small></label><br/>
					<select multiple name="tags[]" id="tags-input" data-item-id="<?php echo_if_not_empty($item[0]['itemid'], 0); ?>" /></select>
					<!-- <input id="tags-input" class="form-control" type="text" name="tags" value=""> -->
				</div>
			</div>

			<div class="row item-form-input">
				<div class="col-md-1">
					<h4 class="item-instruction-number">6.</h4>
				</div>

				<div class="col-md-11">
					<h4>Add Location</h4>
					<label>Location</label><br/>
					<input class="form-control" name="location" value="<?php echo_if_not_empty($item[0]['location']); ?>" />
					<!-- <input id="tags-input" class="form-control" type="text" name="tags" value=""> -->
				</div>
			</div>

			<div class="row item-form-input" style="margin-top: 10px;">
				<div class="col-md-1">
					<h4 class="item-instruction-number"></h4>
				</div>
				<div class="col-md-11">
					<div class="item-form-input-body input-group">
						<input type="hidden" name="id" value="<?php echo $item[0]['itemid']?>">
						<input type="submit" class="btn btn-success" value="Lauch New Classified Ad">

					</div>
				</div>
			</div>
			<?php echo form_close(); ?>

		</div>

		<div class="col-md-4">


		</div>

	</div>
</div>
