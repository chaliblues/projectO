<?php

//Check if the user is logged in or not
if($this->session->userdata('logged_in')==TRUE)
{
	echo '<div class="btn-group">
          <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>
          '.$this->session->userdata('userName').'</a>
          <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="'.site_url().'/users/editProfile"><i class="icon-pencil"></i> Edit Profile</a></li>
            <li><a href="'.site_url().'/users/changePassword"><i class="icon-lock"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="'.site_url().'/users/logout"><i class="icon-ban-circle"></i> Logout</a></li>
          </ul>
        </div>
	      ';
}else{
?>
<font color="red">
<?php echo $this->session->flashdata('authStatus');?>
<?php //echo validation_errors(); ?>
</font>
<?php echo form_open('users/loginSubmit');?>
<?php echo form_error('email'); ?>
<input type="text" class="input" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>"><br>
<?php echo form_error('password'); ?>
<input type="password" class="input" name="password" placeholder="Password"><br>
<a href="<?php echo site_url();?>/users/forgotPassword">Forgot Your Password ?</a>&nbsp;&nbsp;
<button type="submit" class="btn btn-info">Sign In&nbsp;&nbsp;>></button>
<br/><br/>
<a class="btn btn-warning" href="<?php echo site_url();?>/users/signUp"><i class="icon-user icon-white"></i>
No Account? Click Here
</a>
</form>
<?php }?>
<br>
