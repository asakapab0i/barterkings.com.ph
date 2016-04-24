<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">1. What are you trading?</h3>
  </div>
  <div class="panel-body">

    <div id="selling-form-warning-category" style="display:none;" class="alert alert-warning">
      <p>Please pick a category. </p>
    </div>

    <?php foreach($categories as $key => $value): ?>

      <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
        <div style="border: 1px solid <?php echo $value['color']?>; color: <?php echo $value['color']; ?> " data-category-id="<?php echo $value['id']; ?>" data-category-color="<?php echo $value['color']; ?>" class="category-card-parent thumbnail bootsnipp-thumb">

          <p class="category-name text-center"><b><?php echo $key; ?></b></p>
          <div class="category-icon text-center">
            <i class="<?php echo $value['icon']?>"></i>
          </div>

        </div>
      </div>   
    <?php endforeach;?>

  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">2. How do you want to trade your item?</h3>
  </div>
  <div class="panel-body"> 

    <div id="selling-form-warning-sell-type" style="display:none;" class="alert alert-warning">
      <p>Please choose the following options. </p>
    </div>

    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
      <div class="selling-card-parent thumbnail bootsnipp-thumb">
        <div class="selling-form-auction">
          <input class="selling-input" type="radio" name="sell-type" value="item/auction"> <label class="selling-type">Auction - Free</label>
        </div>
        <div class="selling-description">
          <p>An auction will get you the highest price and the most bids. Includes free escrow + 1 free relisting.<br/>Use this if you want more buyers and a quick, successful sale. Learn more.</p> 
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
      <div class="selling-card-parent thumbnail bootsnipp-thumb">
        <div class="selling-form-auction">
          <input class="selling-input" type="radio" name="sell-type" value="item/classified"> <label class="selling-type">Classified Listing - Free</label>
        </div>
        <div class="selling-description">
          <p>An auction will get you the highest price and the most bids. Includes free escrow + 1 free relisting<br/>Use this if you want more buyers and a quick, successful sale. Learn more.</p> 
          <p></p>
        </div>
      </div>
    </div>

    <small>Note: all listings that are successfully sold will are absolutely free of charge!</small>

  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">3. Basic details to get it started</h3>
  </div>
  <div class="panel-body">

  <form class="selling-item-form" id="selling-item-form" method="POST" action="">
      <div class="row">
        <div class="col-md-4">
        <label class="pull-right selling-details-label"><b>Name of your item</b></label>
        </div>
        <div class="col-md-8">
          <input type="text" name="name" class="form-control" placeholder="Nike Jordan Shoes XL">
          <input type="hidden" name="category" value="">
          <div class="pull-right selling-submit-button"><input id="selling-button" type="submit" class="btn btn-success" value="Get Started"></div>
        </div>
      </div>
   </form>
    
  </div>
</div>