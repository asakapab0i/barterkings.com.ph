<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Offered Item - <?php echo $offer[0]['offer_name'] ?></h4>
</div>
<form id="add_offer_form" action="<?php echo base_url(); ?>offer/add" method="POST" accept-charset="utf-8">
	<div class="modal-body">
		<div class="text-center">
			<h5><?php echo nl2br($offer[0]['offer_description']); ?></h5>
			<hr>
		</div>
		<table>
			<tbody>
				<tr>
					<td class="item-head"><strong>Item Name</strong></td>
					<td class="h5">
						<a href="<?php echo base_url('item').'/'.$offer[0]['offer_item_id']; ?>" title="<?php echo $offer[0]['name']; ?>">
							<?php echo character_limiter($offer[0]['name'], 40) ?>
						</a>
					</td>
				</tr>
				<tr>
					<td class="item-head"><strong>Item Owner</strong></td>
					<td class="h5"><?php echo $offer[0]['account_id']; ?></td>
				</tr>
				<tr>
					<td class="item-head"><strong>Item Value</strong></td>
					<td class="h5"><?php echo $offer[0]['value']; ?></td>
				</tr>
				<tr>
					<td class="item-head"><strong>Item Location</strong></td>
					<td class="h5"><?php echo $offer[0]['location']; ?></td>
				</tr>
				<tr>
					<td class="item-head"><strong>Item Description</strong></td>
					<td class="h5">
					<div class="content hideContent">
							<?php echo nl2br($offer[0]['description']); ?>
						</div>
						<div class="show-more">
							<a href="#">Show more</a>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<?php if($offer_owner !== false): ?>
			<div class="pull-left">
			<a href="<?php echo base_url("message/new/") .'/'. $offer[0]['account_id']; ?>" data-offerid="<?php echo $offer[0]['offer_id']; ?>" class="contact-owner-btn btn btn-primary" title="">Contact Owner</a>
			</div>

			<a href="#" data-offerid="<?php echo $offer[0]['offer_id']; ?>" class="approve-offer-btn btn btn-success" title="">Approve</a>
			<a href="#" data-offerid="<?php echo $offer[0]['offer_id']; ?>" class="decline-offer-btn btn btn-danger" title="">Decline</a>
		<?php else: ?>
			<!-- <div class="pull-left">
			<a href="<?php echo base_url("message/new/") .'/'. $offer[0]['account_id']; ?>" data-offerid="<?php echo $offer[0]['offer_id']; ?>" class="contact-owner-btn btn btn-primary" title="">Contact Owner</a>
			</div> -->
		<?php endif;?>
	</div>
</form>