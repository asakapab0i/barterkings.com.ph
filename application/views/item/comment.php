<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Comment</h4>
</div>
<form id="add_comment_form" action="<?php echo base_url(); ?>item/comment" method="POST" accept-charset="utf-8">
	<div class="modal-body">

		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" required class="form-control" name="title" id="title" value="">	
		</div>
		<div class="form-group">
			<label for="comment">Comment</label>
			<textarea class="form-control" required id="comment" name="comment"></textarea>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" name="item_id" value="<?php echo $itemid; ?>">
		<input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
		<button type="submit" class="add-comment-btn btn btn-default">Submit</button>
	</div>
</form>