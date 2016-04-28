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
            <input type="submit" class="btn btn-success btn-block" value="Login">
            <a href="<?php echo base_url('account/register'); ?>" class="btn btn-primary btn-block">Register</a>
        </form>
    </div>
</div>
