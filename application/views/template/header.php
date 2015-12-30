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
                    <li class="barter-now"><a href="<?php echo base_url('item/add'); ?>"><span class="glyphicon glyphicon-refresh icon-flipped" aria-hidden="true"></span> Barter Now!</a></li>
                  </ul>
                  <form method="GET" action="<?php echo base_url()?>/home/item" class="navbar-form navbar-left" role="search">
                    <div class="input-group">
                    <input id="search" type="text" value="<?php echo $this->input->get('item'); ?>" name="item" class="form-control" placeholder="Search items">
                      <span class="input-group-btn">
                      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
                      </span>
                    </div><!-- /input-group -->
                    
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
                </div>
              </div>
            </nav>

            