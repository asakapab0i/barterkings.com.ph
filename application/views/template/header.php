<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/normalize.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/main.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/style.css">
  <script src="<?php echo base_url('asset/js'); ?>/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
     <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <!-- HEADER -->
            <nav class="navbar navbar-default">
            <div class="container">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('home'); ?>">Barter Kings</a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                   <ul class="nav navbar-nav">
                    <li class="barter-now"><a href="<?php echo base_url('item/add'); ?>"><span class="glyphicon glyphicon-refresh icon-flipped" aria-hidden="true"></span> Barter Now</a></li>
                  </ul>

                  <form method="GET" action="<?php echo base_url()?>/home/item" class="navbar-form navbar-left" role="search">
                    <div class="input-group">
                      <input id="search" type="text" value="<?php echo $this->input->get('item'); ?>" name="item" class="form-control" placeholder="Search items">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
                      </span>
                    </div>
                  </form>

                  <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_is_logged_in) && $_is_logged_in !== FALSE): ?>
                      <li><a href="<?php echo base_url('profile'); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a></li>
                      <li><a href="<?php echo base_url('settings'); ?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a></li>
                      <li><a href="<?php echo base_url('message'); ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Inbox 
                        <?php if(isset($_inbox_count) && $_inbox_count > 0): ?>
                          <span class="label label-success"><?php echo $_inbox_count; ?></span> </a></li>
                        <?php endif;?>
                        <li><a href="<?php echo base_url('account/logout'); ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</a></li>
                      <?php else: ?>
                        <li><a href="<?php echo base_url('account/login'); ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Login</a></li>
                        <li><a href="<?php echo base_url('account/register'); ?>"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Register</a></li>
                      <?php endif; ?>
                    </ul>

                  </div>
                  <hr>
                </div> 
                <div class="container small">
                  <ul class="nav navbar-nav category-list">
                    <li class="">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Computer Electronics</a>
                        <ul class="category-dropdown dropdown-menu clear" aria-labelledby="cat1">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Entertainment & Hobbies</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat2">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Food & Beverages</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat3">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Jobs</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat4">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                     <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Lifestyle</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat5">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Pets</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat6">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                     <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Real Estate</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat7">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Specialty Services</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat8">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat9" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Sporting Goods</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat9">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each dropdown-toggle" type="button" id="cat10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Vehicles, Parts, & Accessories</a>
                        <ul class="category-dropdown dropdown-menu" aria-labelledby="cat10">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                        </ul>
                      </div>

                    </li>
                    <li class="#">
                  
                      <div class="dropdown">
                        <a href="#" class="category-each" id="cat11" >Other</a>
                      </div>

                    </li>

                  </ul>
                </div>
              </div>
            </nav>

            