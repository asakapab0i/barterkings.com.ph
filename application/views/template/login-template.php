<!-- <div class="col-md-4 col-md-offset-2">

</div> -->

<div class="panel panel-default">
  <div class="panel-heading"><h4>Login</h4></div>
  <div class="panel-body">

    <?php echo validation_errors(); ?>

    <form id="loginForm" method="POST" action="<?php echo base_url('account/login'); ?>">
      <div class="form-group">
        <label for="email" class="control-label">Email</label>
        <input required type="text" class="form-control" id="username" name="email" value="" required="" title="Please enter you username" placeholder="">
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="password" class="control-label">Password</label>
        <input required type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
        <span class="help-block"></span>
      </div>

      <!-- <div id="loginErrorMsg" class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">×</button>
      Wrong Username or Password.
    </div> -->

    <!-- <div class="checkbox">
    <label>
    <input type="checkbox" name="remember" id="remember"> Remember login
  </label>
  <p class="help-block">(if this is a private computer)</p>
</div> -->

<div class="btn-group btn-block">
  <input type="submit" class="btn btn-success col-md-6" value="Login">
  <button type="button" name="button" class="social-facebook btn btn-primary col-md-3"><i class="fa fa-facebook-square"></i>  Facebook</button>
  <button type="button" name="button" class="social-twitter btn btn-info col-md-3"><i class="fa fa-twitter-square"></i>  Twitter</button>
  <a href="<?php echo base_url('account/register'); ?>" class="btn btn-primary col-md-12" style="margin-top: 10px;">Register</a>
</div>


<div class="btn-group btn-block">
</div>

<!--
<div class="container">
<div class="col-xs-6">
<p><i class="pull-right fa fa-facebook-square" style="font-size: 50px"></i></p>
</div>
<div class="col-xs-6">
<p><i class="fa fa-twitter-square" style="font-size: 50px;"></i></p>
</div>
</div> -->
</form>
</div>
</div>
