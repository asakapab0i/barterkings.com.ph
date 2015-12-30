<div class="container">
    <div class="col-md-6">
        <div class="reload-profile well well-no-bg">
            <?php $this->load->view('template/profile-template'); ?> 
        </div>
    </div>
    <div class="col-md-6">
     <div class="well well-no-bg">
        <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $offers_count; ?></span> offers</small> Offers 
        </h1>
        <hr>
        <div class="profile-offers-list reload-offers">
            <?php $this->load->view('template/profile-offers-template');?>
        </div>
    </div>
</div> 
</div>
<div class="container">
   <div class="col-md-12">
        <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $items_count; ?></span> items</small> Items</h1><hr>
    <?php $this->load->view('template/items-template', array($data = $items)); ?>
   </div>
</div>
</div>
