<?php

//Check if the user is logged in or not
if($this->session->userdata('logged_in')==TRUE)
{
	echo '<div class="btn-group">
          <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i>
          '.$this->session->userdata('userName').'</a>
          <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><i class="icon-pencil"></i> Edit Profile</a></li>
            <li class="divider"></li>
            <li><a href="'.site_url().'/users/logout"><i class="icon-ban-circle"></i> Logout</a></li>
          </ul>
        </div>
	      ';
}else{
?>
<font color="red">
<?php echo $this->session->flashdata('authStatus');?>
<?php echo validation_errors(); ?>
</font>
<?php echo form_open('users/loginSubmit');?>
<input type="text" class="input" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>"><br>
<input type="password" class="input" name="password" placeholder="Password"><br>
<a href="#">Forgot Your Password ?</a>&nbsp;&nbsp;
<button type="submit" class="btn btn-info">Sign In&nbsp;&nbsp;>></button>
</form>
<?php }?>
<br><br>
