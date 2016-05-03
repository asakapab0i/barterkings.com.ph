<div class="panel panel-default">
  <div class="panel-heading"><h4>Change Password</h4></div>
  <div class="panel-body">

    <form id="loginForm" method="POST" action="<?php echo base_url('account/change_password'); ?>">
      <div class="form-group">
        <label for="email" class="control-label">New Password</label>
        <input required type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter password" placeholder="">
        <span class="help-block"></span>
      </div>

      <div class="form-group">
        <label for="email" class="control-label">Confirm Password</label>
        <input required type="password" class="form-control" id="confirm_password" name="confirm_password" value="" required="" title="Confirm password" placeholder="">
        <span class="help-block"></span>
      </div>

      <?php if(isset($user)): ?>
        <input type="hidden" name="hash" value="<?php echo $user[0]['forgot_password_hash']; ?>">
        <input type="hidden" name="email" value="<?php echo $user[0]['email']; ?>">
      <?php endif;?>

      <div class="btn-group btn-block">
        <input type="submit" class="btn btn-success col-md-12" value="Change Password">
      </div>
    </form>

  </div>
</div>
