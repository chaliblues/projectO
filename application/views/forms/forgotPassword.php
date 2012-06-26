<?php
echo $this->session->flashdata('editStatus');
?>
<font color="red">
<?php echo validation_errors(); ?>
</font>
Enter your email below and hit submit :
<form class="wellform" method="POST" action="<?php echo site_url();?>/users/forgotPasswordSubmit">
  <label>Email</label>
  <input type="text" class="span4" name="email" value="<?php echo set_value('email'); ?>">
  <br/>
  <button type="submit" class="btn btn-success">Submit</button>
</form>