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
								<?php if($search !== false): ?>
									<button data-url="/item/save_searches" data-term="<?php echo $search; ?>" class="pop-modal btn btn-xs btn-success">Save this search</button>
								<?php else: ?>
									<button class="btn disabled btn-xs btn-success">Save this search</button>
								<?php endif;?>
								<!-- <label class="btn btn-xs btn-success"> -->
									<!-- <input type="checkbox" autocomplete="off"> Save this search  -->
									<!-- <button class="btn disabled btn-xs btn-success">Save this search</button> -->
								<!-- </label> -->
								<!-- <label class="btn btn-xs btn-success">
									<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
								</label> -->
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
