<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Offer Items</h4>
</div>

<form id="add_offer_form" action="<?php echo base_url(); ?>offer/add" method="POST" accept-charset="utf-8">
	<div class="modal-body">

		<div class="form-group">
			<label for="offer_name">Offer name</label>
			<input type="text" required class="form-control" name="offer_name" id="offer_name" value="I have an item the same value as yours! Lets barter!">	
		</div>
		<div class="form-group">
			<label for="offer_description">Offer description</label>
			<textarea class="form-control" required id="offer_description" name="offer_description">Hi! I have something for you that you might like in exchange for this item of yours.
			</textarea>
		</div>
		<div class="form-group">
			<label for="offer_name">Choose what items</label>
			<select required name="offer_item_id" class="form-control">
				<?php if($items !== FALSE): ?>
					<option value=""></option>
					<?php foreach($items as $item): ?>
						<option value="<?php echo $item['item_id']; ?>"><?php echo $item['name'] .' - '. $item['value']; ?></option>
					<?php endforeach;?>
				<?php else:?>
					<option value=""></option>
				<?php endif;?>
			</select>
		</div>
		
	</div>
	<div class="modal-footer">
		<input type="hidden" name="item_id" value="<?php echo $itemid; ?>">
		<button type="submit" class="add-offer-btn btn btn-default">Submit</button>
	</div>
</form>