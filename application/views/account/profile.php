<div class="container">
    <div class="col-md-6">
        <div class="reload-profile well well-no-bg">
            <?php $this->load->view('template/profile-template'); ?> 
        </div>
    </div>
    <div class="col-md-6">
         <div class="profile-offers-list well well-no-bg">
            <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $offers_count; ?></span> offers</small> Offers 
            </h1>
            <hr>
            <div class=" reload-offers">
                <?php $this->load->view('template/profile-offers-template');?>
            </div>
        </div>
    </div> 
        <!-- <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $items_count; ?></span> items</small> Items</h1><hr> -->
        <?php $this->load->view('template/items-template'); ?>
</div>
