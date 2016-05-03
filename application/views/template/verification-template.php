<div class="panel panel-default">
  <div class="panel-heading"><h4>Verification</h4></div>
  <div class="panel-body">

    <form id="loginForm" method="GET" action="<?php echo base_url('account/verification'); ?>">
      <div class="form-group">
        <label for="email" class="control-label">Email</label>
        <input required type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter your email address" placeholder="">
        <span class="help-block"></span>
      </div>

      <div class="form-group">
        <label for="email" class="control-label">Hash</label>
        <input required type="text" class="form-control" id="hash" name="hash" value="" required="" title="Verification Code" placeholder="">
        <span class="help-block"></span>
      </div>

      <div class="btn-group btn-block">
        <input type="submit" class="btn btn-success col-md-12" value="Verify">
      </div>
    </form>

  </div>
</div>
