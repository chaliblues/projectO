<?php
echo $this->session->flashdata('signUpStatus');
?>
<font color="red">
<?php //echo validation_errors(); ?>
</font>
<form class="wellform" method="POST" action="<?php echo site_url();?>/users/signUpSubmit">
  <label>Names <font color="red"><?php echo form_error('userNames_s'); ?></font></label>
  <input type="text" class="span4" name="userNames_s" placeholder="<?php echo $this->session->userdata('userNames_s');?>"
  value="<?php echo $this->session->userdata('userNames_s');?>">

  <label>Username <font color="red"><?php echo form_error('userName_s'); ?></font></label>
  <input type="text" class="span4" name="userName_s" placeholder="<?php echo $this->session->userdata('userName_s');?>"
  value="<?php echo $this->session->userdata('userName_s');?>">

  <label>Email <font color="red"><?php echo form_error('email_s'); ?></font></label>
  <input type="text" class="span4" name="email_s" placeholder="<?php echo $this->session->userdata('email_s');?>"
  value="<?php echo $this->session->userdata('email');?>">

  <label>Password <font color="red"><?php echo form_error('password_s'); ?></font></label>
  <input type="password" class="span4" name="password_s"><br/>
  <button type="submit" class="btn btn-success">Submit</button>
  
  <!--
  <label>Mobile Number</label>
  <input type="text" class="span4" name="mobileNo" placeholder="<?php echo $this->session->userdata('mobileNo');?>"
  value="<?php echo $this->session->userdata('mobileNo');?>">

  <label>Date of Birth</label>
  <input type="text" class="span4" name="dateOfBirth" placeholder="<?php echo $this->session->userdata('dateOfBirth');?>"
  value="<?php echo $this->session->userdata('dateOfBirth');?>">

  <label>Gender</label>
  <select id="gender" name="gender">
    <option value="">Select Gender</option>
    <option value="M">Male</option>
    <option value="F">Female</option>
  </select>
  
  <label>Your Profile Pic</label>
  <input type="file" class="span4" name="profilePic">
  
  <label>Password</label>
  <input type="password" class="span4" name="password">

  <label>Confirm Password</label>
  <input type="password" class="span4" name="passwordconf">
  <br/>
  -->
  
</form>