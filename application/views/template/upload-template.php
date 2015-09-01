<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Upload Images</h4>
</div>
<div class="modal-body">
	<form id="upload-form" action="<?php echo base_url('item/upload');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div class="progress hide">
			<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
				<span class="sr-only">0% Complete</span>
			</div>
		</div>

		<?php if($images): ?>
			<?php foreach($images as $image): ?>
				<?php if(isset($image['id'])): ?>
					<div class="fileinput fileinput-new input-group">
						<div class="form-control">
							<i class=""></i> 
							<span class="fileinput-filename"><?php echo $image['image']; ?></span>
						</div>
						<span class="input-group-addon btn btn-default btn-file">
							<span class="fileinput-new"></span>
							<span class="fileinput-exists">Change</span>
							<input type="hidden" name="itemid" class="itemid" value="<?php echo $item_id; ?>">
							<input accept="image/x-png, image/gif, image/jpeg" data-imageid="<?php echo $image['id']; ?>" value="" class="userfile" type="file" name="userfile[]">
						</span>
						<a href="#" data-itemid="<?php echo $item_id; ?>" data-imageid="<?php echo $image['id']; ?>" data-url="item/delete_image" class="input-group-addon btn btn-default remove-file">Remove</a>
					</div>
				<?php endif;?>
			<?php endforeach;?>
		<?php endif;?>

		<div class="fileinput fileinput-new input-group">
			<div class="form-control">
				<i class=""></i> 
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new"></span>
				<span class="fileinput-exists">Change</span>
				<input type="hidden" name="itemid" class="itemid" value="<?php echo $item_id; ?>">
				<input accept="image/x-png, image/gif, image/jpeg" data-imageid="null" class="userfile" type="file" name="userfile[]">
			</span>
			<a href="#" data-url="item/delete_image" class="input-group-addon btn btn-default remove-file">Remove</a>
		</div>
	</form>
</div>
<div class="modal-footer">
	<!-- <button class="btn btn-primary process-upload">Upload</button> -->
</div>