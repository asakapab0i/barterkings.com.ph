<form id="Add item" method="POST" action="http://localhost/barterkings/item/offer">
	<div class="form-group">
		<div class="input-group"> <span class="input-group-addon">PHP</span> <input type="number" id="value" name="value" class="form-control" aria-label="Amount (to the nearest dollar)" title="" data-placement="right" data-toggle="tooltip" data-original-title="<h4>Please enter the approximate price</h4>"> <span class="input-group-addon">.00</span> </div>
	</div>
	<input type="submit" class="btn btn-primary btn-block" value="Place Offer">
</form>

<hr>

<a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="offer/add" data-method="upload" class="btn-block btn btn-success">Watch this item</a>
<a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="offer/add" data-method="upload" class="btn-block btn btn-warning">Add to wishlist</a>


<?php if($item_owner === FALSE): ?>
	<a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="offer/add" data-method="upload" class="pop-modal btn btn-primary">Make an offer</a>
<?php else:?>
	<!-- <a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="offer/view" data-method="upload" class="pop-modal btn btn-primary">View offers</a> -->
<?php endif; ?>