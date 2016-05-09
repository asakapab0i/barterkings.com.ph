<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title><?php echo (isset($title)) ? $title : ''; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url(); ?>" rel="canonical" />

  <!-- Favicons-->
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('asset/img/favicons'); ?>/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('asset/img/favicons'); ?>/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('asset/img/favicons'); ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('asset/img/favicons'); ?>/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('asset/img/favicons'); ?>/favicon-16x16.png">
  <link rel="manifest" href="<?php echo base_url('asset/img/favicons'); ?>/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <?php if(isset($social_meta) && $social_meta != false): ?>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo $social_meta['name']?>">
    <meta itemprop="description" content="<?php echo character_limiter(str_replace("Seller's Comments and Description:",'',$social_meta['description']), 120)?>" />
    <meta itemprop="image" content="<?php linkify_to_images($social_meta['image_thumb']); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@barterkings.co">
    <meta name="twitter:title" content="<?php echo $social_meta['name']; ?>">
    <meta name="twitter:description" content="<?php echo character_limiter(str_replace("Seller's Comments and Description:",'',$social_meta['description']), 120)?>" />
    <meta name="twitter:creator" content="@BarterKingsPH">
    <meta name="twitter:image" content="<?php linkify_to_images($social_meta['image_thumb']); ?>">
    <meta name="twitter:data1" content="PHP <?php echo $social_meta['value']?>">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo $social_meta['name']?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php linkify_to_item($social_meta['itemid'], $social_meta['name']); ?>" />
    <meta property="og:image" content="<?php linkify_to_images($social_meta['image_thumb']); ?>" />
    <meta property="og:description" content="<?php echo character_limiter(str_replace("Seller's Comments and Description:",'',$social_meta['description']), 120)?>" />
    <meta property="og:type" content="<?php echo $social_meta['username']; ?>" />
    <meta property="product:price:amount" content="<?php echo $social_meta['value']; ?>" />
    <meta property="product:price:currency" content="PHP" />

  <?php else: ?>
    <meta name="description" content="Relevant advertisement aggregator in the philippines. Search and deal on your favorite item in your favorite website!">
  <?php endif; ?>

  <?php if(ENVIRONMENT == 'production'): ?>
  	<link async rel="stylesheet" href="<?php echo base_url('asset/dist/css/production.css'); ?>"/>
  <?php endif;?>
</head>
<body>
     <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <!-- HEADER -->
            <nav class="navbar navbar-default navbar-fixed-top">
              <div class=""> <!-- container -->
                <div class="container-fluid"> <!-- container-fluid -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand navbar-logo" href="<?php echo base_url('home'); ?>">
                      <img class="" src="<?php echo base_url('asset/img/logo-main.png'); ?>">
                    </a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                   <ul class="nav navbar-nav">
                    <li class="barter-now">
                      <button data-placement="bottom" data-toggle="tooltip" title="Barter Now" title="Barter Now" href="<?php echo base_url('item/add'); ?>" class="btn btn-success btn-sm">
                        <!-- <span class="nav-icon glyphicon glyphicon-refresh icon-flipped" aria-hidden="true"></span> -->
                        <span class="nav-icon fa fa-refresh fa-spin" aria-hidden="true"></span>
                        &nbsp; Start Trading
                      </button>
                    </li>
                  </ul>

                  <form method="GET" action="<?php echo base_url('home')?>" class="navbar-form navbar-left" role="search">
                    <div class="input-group">
                      <input style="float:none;" id="nav-search" type="text" value="<?php echo $this->input->get('term'); ?>" name="term" class="form-control typehead" placeholder="Looking for something?">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                      </span>
                    </div>
                  </form>

                  <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_is_logged_in) && $_is_logged_in !== FALSE): ?>
                      <!--
                      <li>
                        <a data-placement="bottom" data-toggle="tooltip" title="Profile" href="<?php echo base_url('profile'); ?>">
                          <span class="nav-icon glyphicon glyphicon-user" aria-hidden="true"></span>
                          <span class="visible-xs-inline nav-xs-label">My Profile</span>
                        </a>
                      </li>
                      <li><a data-placement="bottom" data-toggle="tooltip" title="Manage Searches" href="<?php echo base_url('manage_searches'); ?>">
                        <span class="nav-icon glyphicon glyphicon-comment" aria-hidden="true"></span><span class="visible-xs-inline nav-xs-label"> Manage Searches</span> </a>
                      </li>
                      -->
                      <li><a data-placement="bottom" data-toggle="tooltip" title="Messages" href="<?php echo base_url('message'); ?>">
                        <span class="nav-icon glyphicon glyphicon-envelope" aria-hidden="true"></span>
                        <?php if(isset($_inbox_count) && $_inbox_count > 0): ?>
                          <span class="nav-label label label-danger"><?php echo $_inbox_count; ?></span> <span class="visible-xs-inline nav-xs-label"> Conversations</span></a></li>
                        <?php endif;?><span class="visible-xs-inline nav-xs-label"> Conversations</span></a></li>
                        <li class="dropdown nav-profile-image">
                         <div class="pull-right">
                           <span data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="thumbnail">
                          <img src="<?php echo base_url('asset/img/profiles_thumbs/' . $_is_logged_in[0]['profile_img_thumb']);?>">
                          </span>
                         </div>


                         <span class="pull-right text-capitalize nav-username" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <?php echo $_is_logged_in[0]['username'] ?>
                         </span>

                          <ul class="dropdown-menu nav-profile-dropdown">
                            <!--
                            <li><a title="Dashboard" href="<?php echo base_url('dashboard'); ?>"> Dashboard</a></li>
                            <li><a title="Settings" href="<?php echo base_url('settings'); ?>"> Settings</a></li>
                            <li role="separator" class="divider"></li>
                            -->
                            <li><a title="Profile" href="<?php echo base_url('profile'); ?>"> Profile</a></li>
                            <li><a title="Dashboard" href="<?php echo base_url('dashboard'); ?>"> Dashboard</a></li>
                            <li><a title="Activity Logs" href="<?php echo base_url('dashboard/profile_logs'); ?>"> Activity Logs</a></li>
                            <li><a title="Searches" href="#" data-url="item/saved_searches" class="pop-modal"> Searches</a></li>
                            <li><a title="Logout" href="<?php echo base_url('account/logout'); ?>"> Logout</a></li>
                          </ul>

                        </li>
                      <?php else: ?>
                        <li><a data-placement="bottom" data-toggle="tooltip" title="Login" href="<?php echo base_url('account/login'); ?>">Login</a></li>
                        <li><a data-placement="bottom" data-toggle="tooltip" title="Register" href="<?php echo base_url('account/register'); ?>">Register</a></li>
                      <?php endif; ?>
                    </ul>

                  </div>
                  <hr class="nav-hr">
                </div>

                <?php $this->load->view('template/subnav_category'); ?>

              </div>
            </nav>

            <!-- Content Start -->
            <div class="container-fluid">
