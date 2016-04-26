<?php foreach ($data as $value): ?>
	<div class="page-details">
		<?php echo nl2br($value['description']) ?>
	</div>
	<div class="page-category" style="border-top: 1px solid #e7e7e7; padding-top: 10px;">
		<a class="label label-primary" style="background-color: <?php echo_if_not_empty($value['category_color']); ?>" href="<?php linkify_to_category($value['category_class']); ?>"> <?php echo_if_not_empty($value['category_name']); ?></a>
	</div>
	<div class="page-tags" style="padding-top: 5px;">
		<?php if($tags !== false): ?>
			<?php foreach($tags as $tkey => $tvalue): ?>
				<a href="<?php linkify_to_tags($tvalue['tag_term'], $tkey, $this->input->get()); ?>" class="label label-primary"> <?php echo $tvalue['tag_term']; ?></a>
			<?php endforeach;?>
		<?php endif?>

	</div>
<?php endforeach;?>
