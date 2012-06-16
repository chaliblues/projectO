<font color="red">
<?php echo validation_errors(); ?>
</font>
<form class="wellform" method="POST" action="<?php echo site_url();?>/users/editProfileSubmit">
  <label>Names</label>
  <input type="text" class="span4" placeholder="<?php echo $this->session->userdata('userNames');?>"
  value="<?php echo $this->session->userdata('userNames');?>">

  <label>Username</label>
  <input type="text" class="span4" placeholder="<?php echo $this->session->userdata('userName');?>"
  value="<?php echo $this->session->userdata('userName');?>">

  <label>Email</label>
  <input type="text" class="span4" placeholder="<?php echo $this->session->userdata('email');?>"
  value="<?php echo $this->session->userdata('email');?>">

  <label>Mobile Number</label>
  <input type="text" class="span4" placeholder="<?php echo $this->session->userdata('mobileNo');?>"
  value="<?php echo $this->session->userdata('mobileNo');?>">
  <br/>
  <button type="submit" class="btn btn-success">Submit</button>
</form>