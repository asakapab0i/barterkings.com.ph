<div class="container">

	<?php if($this->session->userdata('account') == NULL): ?>
		<div class="col-lg-6">
			<div class="well well-no-bg">
				<h1>Lorem</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="well well-no-bg">
				<?php $this->load->view('template/login-template', array('show_or_hide' => 'hide')); ?>
			</div>
		</div>
	<?php else: ?>
		<div class="col-md-3">
			<?php $this->load->view('template/advance-search-template'); ?>
		</div>
		<div class="col-md-9">
			<div class="search-panel panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title clearfix"><span class="panel-text"><?php echo $total_results ? $total_results : 0; ?> Ads Found</span>
						<span class="pull-right">
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-xs btn-primary">
									<input type="checkbox" autocomplete="off"> Save this search 
								</label>
								<label class="btn btn-xs btn-primary">
									<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
								</label>
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
	<?php endif; ?>
</div>
