

			<!-- main -->
			<div id="main">
			<h2 class="inner">Welcome!</h2>
			<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
		        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#tabs-1">Personalized Feed</a></li>
		        <li class="ui-state-default ui-corner-top"><a href="#tabs-2">Latest Opinions</a></li>
		        <li class="ui-state-default ui-corner-top"><a href="#tabs-3">Subscribed  Users</a></li>
		    </ul>
		              
		              <div id="tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
		              <div id="tabs-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
		              <div id="tabs-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
		 	</div>

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