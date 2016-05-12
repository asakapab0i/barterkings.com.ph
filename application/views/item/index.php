<div class="row">
	<div class="col-md-8">

		<div class="panel panel-default">
			<div class="panel-body">
				<div class="">
					<?php if($user[0]['privileges_id'] == 3): ?>
						<!-- Single button -->
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="fa fa-cog fa-fw"></span>
							</button>
							<ul class="dropdown-menu" style="min-width: 100px">
								<li><a href="<?php linkify_to_remove($data[0]['itemid']); ?>" class="">Remove</a></li>
								<li><a href="<?php linkify_to_edit($data[0]['itemid']); ?>">Edit</a></li>
								<li><a href="<?php linkify_to_deactivate($data[0]['itemid']); ?>">Deactivate</a></li>
							</ul>
						</div>
					<?php endif; ?>
					<h4><?php echo $data[0]['name']; ?>
						<?php if ($editable === TRUE):?>
						<?php endif;?>
					</h4>
					<h5>
						<?php echo $data[0]['location'] ?>
					</h5>
				</div>
				<hr>
				<div class="item-images">
					<h4><small class="pull-right"><span data-itemid="<?php echo $data[0]['itemid']; ?>" class="reload-images-count"><?php echo $images_count; ?></span> images</small> Images
						<?php if ($editable === TRUE):?>
							<a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="item/upload/" data-method="upload" class="pop-modal btn btn-success btn-xs">Upload</a>
						<?php endif;?>
					</h4>
					<div data-itemid="<?php echo $data[0]['itemid']; ?>" class="reload-images">
						<?php $this->load->view('template/images-template'); ?>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="col-md-4">

		<div class="panel panel-default" data-spy="affix" data-offset-top="60" data-offset-bottom="200">
			<div class="panel-body offer-area">
				<h4>Current Price</h4>
				<h5>
					<span class="label price-value label-danger">₱ <?php echo $data[0]['value'] ?></span>
					<small class="pull-right ">
						<span data-itemid="<?php echo $data[0]['itemid']; ?>" class="reload-offers-count"><?php echo $offers_count; ?></span> offer(s)
					</small>
				</h5>
				<hr>
				<div data-itemid="<?php echo $data[0]['itemid']; ?>" class="offers-cart reload-offer-cart">
					<?php $this->load->view('template/offer-cart');?>
				</div>

			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-8">

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title"><h4>Description</h4></div>
			</div>
			<div class="panel-body">
				<?php $this->load->view('template/item-template');?>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-body">
				<h4>The Seller</h4><hr>
				<?php $this->load->view('template/profile-template'); ?>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-body">
				<h4><small class="pull-right"><span data-itemid="<?php echo $data[0]['itemid']; ?>" class="reload-comments-count-<?php echo $data[0]['itemid']; ?>"><?php echo $comments_count; ?></span> comments</small> Comments
					<a href="#" data-itemid = "<?php echo $data[0]['itemid']; ?>" data-url="item/comment" data-method="upload" class="pop-modal btn btn-xs btn-success">Make comments</a>
				</h4><hr>
				<div class="reload-comments-<?php echo $data[0]['itemid']; ?> comments-list reload-comments">
					<?php $this->load->view('template/comments-template');?>
				</div>
			</div>
		</div>

	</div>
</div>
