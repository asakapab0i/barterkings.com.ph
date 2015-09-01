<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
				<h1>Item Details
					<?php if ($editable === TRUE):?>
						<!-- <a href="#" class="btn btn-primary">Edit</a> -->
					<?php endif;?>
				</h1>
			</div> 

			<?php $this->load->view('template/item-template'); ?>
		</div>

		<div class="col-md-6"> 
			<div class="page-header">
				<h1><small class="pull-right"><span data-itemid="<?php echo $data[0]->id; ?>" class="reload-images-count"><?php echo $images_count; ?></span> images</small> Images
					<?php if ($editable === TRUE):?>
						<a href="#" data-itemid = "<?php echo $data[0]->id; ?>" data-url="item/upload/" data-method="upload" class="pop-modal btn btn-primary">Upload</a>
					<?php endif;?>
				</h1>
			</div>
			<div data-itemid="<?php echo $data[0]->id; ?>" class="reload-images">
				<?php $this->load->view('template/images-template'); ?>	
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
				<h1><small class="pull-right"><span data-itemid="<?php echo $data[0]->id; ?>" class="reload-comments-count"><?php echo $comments_count; ?></span> comments</small> Comments 
					<a href="#" data-itemid = "<?php echo $data[0]->id; ?>" data-url="item/comment" data-method="upload" class="pop-modal btn btn-primary">Make comments</a>
				</h1>
			</div> 
			<div class="comments-list reload-comments">
				<?php $this->load->view('template/comments-template');?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="page-header">
				<h1><small class="pull-right"><span data-itemid="<?php echo $data[0]->id; ?>" class="reload-offers-count"><?php echo $offers_count; ?></span> offers</small> Offers 
					<?php if($item_owner === FALSE): ?>
						<a href="#" data-itemid = "<?php echo $data[0]->id; ?>" data-url="offer/add" data-method="upload" class="pop-modal btn btn-primary">Make an offer</a>
					<?php else:?>
						<a href="#" data-itemid = "<?php echo $data[0]->id; ?>" data-url="offer/view" data-method="upload" class="pop-modal btn btn-primary">View offers</a>
					<?php endif; ?>
				</h1>
			</div> 
			<div data-itemid = "<?php echo $data[0]->id; ?>" class="offers-list reload-offers">
				<?php $this->load->view('template/offers-template');?>
			</div>
			
		</div>
	</div>
</div>
