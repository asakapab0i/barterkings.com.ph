<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="reload-profile">
                <?php $this->load->view('template/profile-template'); ?> 
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">

        <div class="">
            <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $offers_count; ?></span> offers</small> Offers 
            </h1>
            <hr>
        </div> 
        <div class="profile-offers-list reload-offers">
            <?php $this->load->view('template/profile-offers-template');?>
        </div>

    </div>
</div>
<div class="row">
    <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $items_count; ?></span> items</small> Items</h1><hr>
    <?php $this->load->view('template/profile-items-template.php'); ?>
</div>
</div>
