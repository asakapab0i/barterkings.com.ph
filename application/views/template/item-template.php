<?php foreach ($data as $value): ?>
	<div class="page-details">
		<?php echo nl2br($value['description']) ?>
	</div>
	<div class="page-tags" style="border-top: 1px solid #e7e7e7; padding-top: 10px;">
		Tags: 
		<?php if($tags !== false): ?>	
			<?php foreach($tags as $tkey => $tvalue): ?>
				<a href="<?php linkify_to_tags($tvalue['tag_term'], $tkey, $this->input->get()); ?>" class="label label-success"><?php echo $tvalue['tag_term']; ?></a>
			<?php endforeach;?>
		<?php endif?>
	</div>
<?php endforeach;?>
