<?php
echo $this->session->flashdata('editStatus');
?>
<font color="red">
<?php echo validation_errors(); ?>
</font>
<form class="wellform" method="POST" action="<?php echo site_url();?>/users/changePasswordSubmit">
  <label>New Password</label>
  <input type="text" class="span4" name="password">

  <label>Confirm Password</label>
  <input type="text" class="span4" name="passconf">
  <br/>
  <button type="submit" class="btn btn-success">Submit</button>
</form>