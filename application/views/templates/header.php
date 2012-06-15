<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>Opinion Capital | <?php echo $title;?></title>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/menu.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/slideshow.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/cufon-yui.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/Arial.font.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		Cufon.replace('h1,h2,h3,h4,h5,#menu,#copy,.blog-date');
	</script>
	<script type="text/javascript" src="<?php echo base_url();?>public/js/fancyzoom.min.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('div.photo a').fancyZoom({directory: 'images/zoom', scaleImg: true, closeOnClick: true});
		});
	</script>

    <!-- Styles --> 
    <link type="text/css" href="<?php echo base_url();?>public/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url();?>public/css/main.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.css" type="text/css" />
	 
    
	

</head>
<body>
	<div id="bg">
		<!-- Menu -->
			    <?php echo $this->load->view('partials/menu');?>
		<div class="wrap">
			
		    
			<!-- pitch -->
			    <?php echo $this->load->view('partials/pitch');?>
			<!-- /pitch -->