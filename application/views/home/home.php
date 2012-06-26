
			<?php
                //Check if the user is logged in or not
				if($this->session->userdata('logged_in')==TRUE)
				{
					redirect('/users/home/', 'refresh');
				}
			?>
			<!-- main -->
			<div id="main">
			<h2 class="inner">Latest Opinions</h2>
			<div id="page">
				
			<!-- opinions list-->
			<?php echo $this->load->view('partials/opinionsList');?>	
				
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