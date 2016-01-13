<?php if(isset($offered_item)): ?>
	<div class="list-group">
		<a href="#" id="submit-offer" data-url="item/offerlist" data-accountid="<?php echo $offered_item[0]['account_id']; ?>" data-itemid="<?php echo $offered_item[0]['itemid']; ?>" class="pop-modal list-group-item"><?php echo $offered_item[0]['name']; ?><span class="badge">₱<?php echo $offered_item[0]['value']; ?></span></a>
		<a href="#" class="btn btn-success btn-block">Confirm Offer</a>
	</div>
<?php else: ?>
	<a href="#" id="submit-offer" data-url="item/offerlist" data-accountid="<?php echo $account_id; ?>" data-itemid="<?php echo $data[0]['itemid']; ?>" class="pop-modal btn btn-success btn-block">Offer my item</a>
<?php endif; ?>