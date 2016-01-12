<div class="container">
    <div class="col-md-12">
        
        <div class="panel panel-default">
            <div class="panel-body">
                <?php $this->load->view('template/profile-template'); ?> 
            </div>
        </div>
        
    </div>
    <!--
    <div class="col-md-12">
         <div class="profile-offers-list well well-no-bg">
            <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $offers_count; ?></span> offers</small> Offers 
            </h1>
            <hr>
            <div class=" reload-offers">
                <?php //$this->load->view('template/profile-offers-template');?>
            </div>
        </div>
    </div> 
        -->
        <!-- <h1><small class="pull-right"><span data-itemid="" class="reload-offers-count"><?php echo $items_count; ?></span> items</small> Items</h1><hr> -->
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Options</h4>
                </div>
                <div class="panel-body">
                    dasdas
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Listings</h4>
                </div>
                <div class="panel-body">
                    <?php $this->load->view('template/items-template'); ?>
                </div>
            </div>
        </div>
</div>
