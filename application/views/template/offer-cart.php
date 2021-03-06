<?php if($_is_logged_in !== false): ?>

	<?php if(isset($data[0]['account_id']) && $_is_logged_in[0]['id'] == $data[0]['account_id']): ?>
		<a href="<?php linkify_to_edit($data[0]['itemid']); ?>" id="login-to-offer" class="btn btn-success btn-block">Edit this item</a>
		<a href="#" id="view-offered-items" data-url="item/offeredlist" data-accountid="<?php echo $account_id; ?>" data-itemid="<?php echo $data[0]['itemid']; ?>" class="pop-modal btn btn-warning btn-block">View all offers</a>
	<?php else: ?>

		<?php if(isset($offer_success)): ?>

			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				Your offer is successfully added.
			</div>

			<a href="#" id="submit-offer" data-url="item/offerlist" data-accountid="<?php echo $account[0]['id']; ?>" data-itemid="<?php echo $item['item_id']; ?>" class="pop-modal btn btn-success btn-block">Offer my item</a>
			<a href="#" id="view-offered-items" data-url="item/offeredlist" data-accountid="<?php echo $account[0]['id']; ?>" data-itemid="<?php echo $item['item_id']; ?>" class="pop-modal btn btn-warning btn-block">View all offers</a>
			<a href="#" id="view-offered-items-account" data-url="item/offeredlist_by_account" data-accountid="<?php echo $account[0]['id']; ?>" data-itemid="<?php echo $item['item_id']; ?>" class="pop-modal btn btn-info btn-block">View all my offers</a>

		<?php else:?>

			<?php if(isset($item_offer_id)): ?>
				<div class="list-group">
					<a href="#" id="submit-offer" data-url="item/offerlist" data-accountid="<?php echo $item_offer_id[0]['account_id']; ?>" data-itemid="<?php echo $item_offer_id[0]['itemid']; ?>" class="pop-modal active list-group-item"><?php echo $item_offer_id[0]['name']; ?><span class="badge">₱<?php echo $item_offer_id[0]['value']; ?></span></a>
					<a href="#" id="confirm-offer" data-offer-item-id="<?php echo $item_offer_id[0]['itemid']; ?>" data-item-id="<?php echo $item_id; ?>" class="btn btn-success btn-block">Confirm Offer</a>
				</div>
			<?php else: ?>
				<a href="#" id="submit-offer" data-url="item/offerlist" data-accountid="<?php echo $account_id; ?>" data-itemid="<?php echo $data[0]['itemid']; ?>" class="pop-modal btn btn-success btn-block">Offer my item</a>
				<a href="#" id="view-offered-items" data-url="item/offeredlist" data-accountid="<?php echo $account_id; ?>" data-itemid="<?php echo $data[0]['itemid']; ?>" class="pop-modal btn btn-warning btn-block">View all offers</a>
				<a href="#" id="view-offered-items-account" data-url="item/offeredlist_by_account" data-accountid="<?php echo $account_id; ?>" data-itemid="<?php echo $data[0]['itemid']; ?>" class="pop-modal btn btn-info btn-block">View all my offers</a>
			<?php endif; ?>

		<?php endif;?>
	<?php endif;?>

<?php else: ?>

	<a href="#" id="login-to-offer" data-url="account/login_template" class="pop-modal btn btn-success btn-block">Login to offer</a>
	<a href="#" id="register-to-offer" data-url="account/register_template" class="pop-modal btn btn-primary btn-block">Register to offer</a>

<?php endif;?>
