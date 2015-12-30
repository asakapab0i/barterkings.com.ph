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
  <link rel="stylesheet" href="<?php echo base_url('asset/css'); ?>/footer.css">
  <script src="<?php echo base_url('asset/js'); ?>/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
     <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <!-- HEADER -->

            <nav class="navbar navbar-default">
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
                  <li><a href="<?php echo base_url('item/add'); ?>">Add items</a></li>
                </ul>
                <form method="GET" action="<?php echo base_url()?>/home/item" class="navbar-form navbar-left" role="search">
                  <div class="form-group">
                    <input type="text" value="<?php echo $this->input->get('item'); ?>" name="item" class="form-control" placeholder="Search items">
                  </div>
                  <button type="submit" class="btn btn-default">Search</button>
                </form>

                <ul class="nav navbar-nav navbar-right">
                  <?php if (isset($_is_logged_in) && $_is_logged_in !== FALSE): ?>
                    <li><a href="<?php echo base_url('profile'); ?>">Profile</a></li>
                    <li><a href="<?php echo base_url('message'); ?>">Inbox 
                      <?php if(isset($_inbox_count) && $_inbox_count > 0): ?>
                        <span class="label label-success"><?php echo $_inbox_count; ?></span> </a></li>
                      <?php endif;?>
                      <li><a href="<?php echo base_url('account/logout'); ?>">Logout</a></li>
                    <?php else: ?>
                      <li><a href="<?php echo base_url('account/login'); ?>">Login</a></li>
                      <li><a href="<?php echo base_url('account/register'); ?>">Register</a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </nav>

            