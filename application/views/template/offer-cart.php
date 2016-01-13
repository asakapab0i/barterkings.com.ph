
<?php if(isset($offer_success)): ?>

	<div class="alert alert-success alert-dismissible fade in" role="alert"> 
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
		<strong>Congratulations</strong> <p>Your offer is successfully added.</p>
	</div>

<?php else:?>

	<?php if(isset($item_offer_id)): ?>
		<div class="list-group">
			<a href="#" id="submit-offer" data-url="item/offerlist" data-accountid="<?php echo $item_offer_id[0]['account_id']; ?>" data-itemid="<?php echo $item_offer_id[0]['itemid']; ?>" class="pop-modal list-group-item"><?php echo $item_offer_id[0]['name']; ?><span class="badge">₱<?php echo $item_offer_id[0]['value']; ?></span></a>
			<a href="#" id="confirm-offer" data-offer-item-id="<?php echo $item_offer_id[0]['itemid']; ?>" data-item-id="<?php echo $item_id; ?>" class="btn btn-success btn-block">Confirm Offer</a>
		</div>
	<?php else: ?>
		<a href="#" id="submit-offer" data-url="item/offerlist" data-accountid="<?php echo $account_id; ?>" data-itemid="<?php echo $data[0]['itemid']; ?>" class="pop-modal btn btn-success btn-block">Offer my item</a>
	<?php endif; ?>	
	
<?php endif;?>



