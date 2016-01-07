
<div class="nav-header">
  <button type="button" class="nav-sub-category navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav-category">
    <span class="sr-only">Toggle navigation</span>

    <div id="navbar-open"> 
      <span class="nav-down-icon glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
    </div>

    <div id="navbar-close" class="hidden">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </div>
    <!-- <h1 class="pull-left">Categories</h1> -->
  </button>

  <div class="visible-xs-inline nav-category-label">
    <span class="navbar-brand pull-right" href="#">Categories</span>
  </div>

  

</div>

<div class="collapse navbar-collapse" id="subnav-category">

  <div class="container">

    <ul class="nav navbar-nav category-list">

      <?php foreach($_categories as $cat => $subcat): ?>

       <li class="">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" type="button" id="cat1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo $cat; ?></a>
          <?php if ($subcat['sub_category'] !== NULL): ?>

          <ul class="category-dropdown dropdown-menu clear" aria-labelledby="cat1">
              <?php foreach($subcat['sub_category'] as $subname): ?>
                <li><a href="#"><?php echo $subname; ?></a></li>
              <?php endforeach; ?>
          </ul>
          
          <?php endif; ?>
        </div>

      </li>

    <?php endforeach; ?>

  </ul>
</div>
</div>


<!-- 
   <li class="">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" type="button" id="cat1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Computer Electronics</a>

          <ul class="category-dropdown dropdown-menu clear" aria-labelledby="cat1">

            <li><a href="#">Cellphones & Accessories</a></li>
            <li><a href="#">Computers & Accessories</a></li>
            <li><a href="#">Gadgets & Accessories</a></li>
            <li><a href="#">Household Appliances & Accessories</a></li>
            <li><a href="#">Photography Equipment & Accessories</a></li>
            <li><a href="#">Other Electronic Devices</a></li>
          </ul>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" type="button" id="cat2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Entertainment & Hobbies</a>
          <ul class="category-dropdown dropdown-menu clear" aria-labelledby="cat2">
            <li><a href="#">Books & Magazines</a></li>
            <li><a href="#">Collectibles, Memorabilias & Hobbies</a></li>
            <li><a href="#">Music & Movies</a></li>
          </ul>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" id="cat3">Food & Beverages</a>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" type="button" id="cat4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Jobs</a>
          <ul class="category-dropdown dropdown-menu" aria-labelledby="cat4">
            <li><a href="#">Call Center / BPO</a></li>
            <li><a href="#">Overseas</a></li>
            <li><a href="#">Part-time & Home-based</a></li>
          </ul>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" type="button" id="cat5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Lifestyle</a>
          <ul class="category-dropdown dropdown-menu" aria-labelledby="cat5">
            <li><a href="#">Babies & Kids Stuffs</a></li>
            <li><a href="#">Clothing & Accessories</a></li>
            <li><a href="#">Health & Beauty</a></li>
            <li><a href="#">Shoes, Bags & Accessories</a></li>
          </ul>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" id="cat6">Pets</a>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" id="cat7">Real Estate</a>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" type="button" id="cat8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Specialty Services</a>
          <ul class="category-dropdown dropdown-menu" aria-labelledby="cat8">
            <li><a href="#">Parties & Events Coordination</a></li>
            <li><a href="#">Travel & Hospitality</a></li>
          </ul>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" id="cat9">Sporting Goods</a>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each dropdown-toggle" type="button" id="cat10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Vehicles, Parts, & Accessories</a>
          <ul class="category-dropdown dropdown-menu" aria-labelledby="cat10">
            <li><a href="#">Cars & Van</a></li>
            <li><a href="#">Pickup & SUVs</a></li>
            <li><a href="#">Tracks, Busses, & Service Vehicles</a></li>
            <li><a href="#">Auto Parts, Accessories, & Services</a></li>
            <li><a href="#">Motorcycles</a></li>
            <li><a href="#">Motorcycles Parts, Accesories, & Services</a></li>
            <li><a href="#">Common Grounds - Car Audio Gadgets</a></li>
          </ul>
        </div>

      </li>
      <li class="#">

        <div class="dropdown">
          <a href="#" class="category-each" id="cat11" >Other</a>
        </div>

      </li>
 -->