<div class="container">

	<div class="col-md-3">
		<?php $this->load->view('template/advance-search-template'); ?>
	</div>
	<div class="col-md-9">
		<div class="search-panel panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title clearfix"><span class="panel-text"><?php echo $total_results ? $total_results : 0; ?> Ads Found</span>
					<span class="pull-right">
						<div class="btn-group" data-toggle="buttons">
							<?php if($user):  ?>
								<?php if($search !== false): ?>
									<button data-query-url="<?php echo $_SERVER['QUERY_STRING']; ?>" data-url="item/saved_searches" data-term="<?php echo $search; ?>" class="pop-modal auto-save-search btn btn-xs btn-success">Save this search</button>
								<?php else: ?>
									<button data-url="item/saved_searches" class="btn btn-xs btn-success pop-modal">View saved searches</button>
								<?php endif;?>
							<?php endif; ?>
						</div>
					</span>
				</h3>
			</div>

			<div class="panel-divider listing-sort-by">
				<?php $this->load->view('template/items-sort-links'); ?>
			</div>
			<div class="panel-body">
				<?php $this->load->view('template/items-template'); ?>
			</div>
		</div>
	</div>

</div>
