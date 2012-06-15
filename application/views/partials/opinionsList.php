<?php
  
  //loop through the opinionsList
  $opinions="";
  $data="";
  foreach ($opinionsList as $opinion) {
  	//Get the userName
  	$userName=get_userName($opinion['userID']);
  	//Get the subCategory Name
  	$subCategory=get_subCategoryName($opinion['opinionSubCategoryID']);
  	//Get the opinion Type
  	$opinionType=get_opinionTypeName($opinion['opinionTypeID']);
  	$opinions.=
  	'<div class="blog-post">
					<p class="blog-date"><span>14th</span><br />October<br/>'.$opinionType.'</p><br/>

					<div class="blog-body">
						<h3><a href="#">'.$userName.'</a> posted <a href="#">'.$opinion['opinionTitle'].'</a> under <a href="#">'.$subCategory.'</a></h3>
						<img src="'.base_url().'public/images/starrs.png"/>
						&nbsp;
						<span class="label">
						Current Votes :: 
						'.$opinion['agreeVotes'].' Agree /
						'.$opinion['disagreeVotes'].' Disagree / 
						'.$opinion['helpfulVotes'].' Helpful / 
						'.$opinion['funnyVotes'].' Funny</span>
						&nbsp;
						<button class="btn btn-success"><i class="icon-star icon-white"></i> Review It !!!</button>
						<p>'.$opinion['opinionNarrative'].'</p>
					    Add Your Vote :
					        
							<span class="label label-success"><i class="icon-thumbs-up icon-white"></i> Agree</span>
							<span class="label label-important"><i class="icon-thumbs-down icon-white"></i> Disagree</span>
							<span class="label label-info"><i class="icon-star-empty icon-white"></i> Helpful</span>
							<span class="label label-inverse"><i class="icon-heart icon-white"></i> Funny</span>
							
					</div>
					<div class="clear"></div>
	 </div>';

	
  }

  //display
  echo $opinions;

?>				
				