<?php
echo $this->session->flashdata('editStatus');
?>
<font color="red">
<?php echo validation_errors(); ?>
</font>
<form class="wellform" method="POST" action="<?php echo site_url();?>/users/editProfileSubmit">
  <label>Names</label>
  <input type="text" class="span4" name="userNames" placeholder="<?php echo $this->session->userdata('userNames');?>"
  value="<?php echo $this->session->userdata('userNames');?>">

  <label>Username</label>
  <input type="text" class="span4" name="userName" placeholder="<?php echo $this->session->userdata('userName');?>"
  value="<?php echo $this->session->userdata('userName');?>">

  <label>Email</label>
  <input type="text" class="span4" name="email" placeholder="<?php echo $this->session->userdata('email');?>"
  value="<?php echo $this->session->userdata('email');?>">

  <label>Mobile Number</label>
  <input type="text" class="span4" name="mobileNo" placeholder="<?php echo $this->session->userdata('mobileNo');?>"
  value="<?php echo $this->session->userdata('mobileNo');?>">
  <br/>
  <label>Date of Birth</label>
  <input type="text" class="span4" name="dateOfBirth" placeholder="<?php echo $this->session->userdata('dateOfBirth');?>"
  value="<?php echo $this->session->userdata('dateOfBirth');?>">

  <label>Gender</label>
  <select id="gender" name="gender">
    <option value="">Select Gender</option>
    <option value="M" <?php if($this->session->userdata('gender')=='M'){echo 'selected="selected"';}?> >Male</option>
    <option value="F" <?php if($this->session->userdata('gender')=='F'){echo 'selected="selected"';}?> >Female</option>
  </select>
  <br>
  <button type="submit" class="btn btn-success">Submit</button>
</form>