<div class="panel panel-default">
  <div class="panel-heading"><h4>Forgot Password</h4></div>
  <div class="panel-body">

    <?php if($sent): ?>
        <div class="alert alert-success">
            <p>
              Validation is sent to your email.
            </p>
        </div>
    <?php endif;?>

    <form id="loginForm" method="POST" action="<?php echo base_url('account/forgot_password'); ?>">
      <div class="form-group">
        <label for="email" class="control-label">Email</label>
        <input required type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter your email address" placeholder="">
        <span class="help-block"></span>
      </div>

      <div class="btn-group btn-block">
        <input type="submit" class="btn btn-success col-md-12" value="Send Verification">
      </div>
    </form>

  </div>
</div>
