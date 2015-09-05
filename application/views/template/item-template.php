<?php foreach ($data as $value): ?>
	<div class="page-details">
		<table class="pull-left">
			<tbody>
				<tr>
					<td class="item-head"><strong>Item Name</strong></td>
					<td class="h5"><?php echo $value['name'] ?></td>
				</tr>
				<tr>
					<td class="item-head"><strong>Item Number</strong></td>
					<td class="h5"><?php echo $value['id']; ?></td>
				</tr>
				<tr>
					<td class="item-head"><strong>Item Owner</strong></td>
					<td class="h5">
						<a href="<?php echo base_url('account/profile'); ?>/<?php echo $value['username']; ?>" title=""><?php echo $value['username']; ?></a>
					</td>
				</tr>
				<tr>
					<td class="item-head"><strong>Value</strong></td>
					<td class="h5"><?php echo $value['value']; ?></td>
				</tr>
				<tr>
					<td class="item-head"><strong>Location</strong></td>
					<td class="h5"><?php echo $value['location']; ?></td>
				</tr>
				<tr>
					<td class="item-head"><strong>Description</strong></td>
					<td class="h5">
						<div class="content hideContent">
							<?php echo nl2br($value['description']); ?>
						</div>
						<?php if(strlen($value['description']) > 100): ?>
							<div class="show-more">
								<a href="#">Show more</a>
							</div>
						<?php endif;?>
					</td>
				</tr>
			</tbody>
		</table>

		<!-- <div class="text-right pull-right col-md-3">
			<span class="h3 text-muted"><strong>PHP <?php echo $value['value']; ?></strong></span>
		</div> -->
	</div>
<?php endforeach;?>
