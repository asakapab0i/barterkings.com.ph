<h3>Login</h3>
        <hr>
            <form id="loginForm" method="POST" action="<?php echo base_url('account/login'); ?>">
                <div class="form-group">
                    <label for="username" class="control-label">Username / Email</label>
                    <input required type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input required type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                    <span class="help-block"></span>
                </div>
              
                <div id="loginErrorMsg" class="alert alert-danger alert-dismissable <?php echo $show_or_hide; ?>">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Wrong Username or Password.
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" id="remember"> Remember login
                    </label>
                    <p class="help-block">(if this is a private computer)</p>
                </div>
                <hr>
                <input type="submit" class="btn btn-primary btn-block" value="Login">
                <a href="<?php echo base_url('account/register'); ?>" class="btn btn-info btn-block">Register</a>
                <a href="<?php echo base_url('account/login'); ?>" class="btn btn-default btn-block">Help to Login</a>
            </form>
