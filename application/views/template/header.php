<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title><?php echo (isset($title)) ? $title : ''; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/typehead.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/normalize.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/slider.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-select.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-image-gallery.min.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/bootstrap-image-gallery.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/main.css">
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/style.css">
  <script src="<?php echo base_url('asset/js'); ?>/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
     <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <!-- HEADER -->
            <nav class="navbar navbar-default navbar-fixed-top">
              <div class="container">
                <div class="container-fluid">
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
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
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
                            <li><a title="Dashboard" href="<?php echo base_url('profile'); ?>"> Dashboard</a></li>
                            <li><a title="Activity Logs" href="<?php echo base_url('profile'); ?>"> Activity Logs</a></li>
                            <li><a title="Searches" href="<?php echo base_url('searches'); ?>"> Searches</a></li>
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
