<h3>Register</h3>
        <hr>
            <form id="loginForm" method="POST" action="<?php echo base_url('account/register'); ?>">
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input required type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                    <span class="help-block"></span>
                </div>
                 <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input required type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter you email" placeholder="example@gmail.com">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input required type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="control-label">Confirm Password</label>
                    <input required type="confirm_password" class="form-control" id="confirm_password" name="confirm_password" value="" required="" title="Please enter your confirm password">
                    <span class="help-block"></span>
                </div>

                <hr>
                <input type="submit" class="btn btn-primary btn-block" value="Register">
                <a href="<?php echo base_url('account/login'); ?>" class="btn btn-info btn-block">Login</a>
                <a href="<?php echo base_url('account/register');?>" class="btn btn-default btn-block">Help to Register</a>
            </form>
