			<!-- main -->
			<div id="main">
			<h2 class="inner">Sign Up. Its Free!</h2>
			<div id="page">
				
			<!-- Edit Profile-->
			<?php echo $this->load->view('forms/signUp');?>	
				
			</div>			
			</div>
			<!-- /main -->
			
			<!-- side -->
			<div id="side">
				   
			    <!-- login form -->
			    <?php echo $this->load->view('forms/login');?>

				<!-- Popular opinions -->
			    <?php echo $this->load->view('partials/popularOpinionsSide');?>

			</div>
			<!-- /side -->
		</div>