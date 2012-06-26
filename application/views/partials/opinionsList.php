<p><a href="#" id="modal_add_opinion" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>Add opinion</a>
    <!-- ui-dialog -->


<?php
  
  //loop through the opinionsList
  $opinions="";
  $data="";
  foreach ($opinionsList as $opinion) {

  	//Get the user
  	$user=get_user($opinion['userID']);
  	//Get the subCategory Name
  	$subCategory=get_subCategoryName($opinion['opinionSubCategoryID']);
  	//Get the opinion Type
  	$opinionType=get_opinionTypeName($opinion['opinionTypeID']);
  	$opinions.=
  	'<div class="blog-post">
					<p class="blog-date"><span>14th</span><br />October<br/>'.$opinionType.'</p><br/>

					<div class="blog-body">
						<h3><a href="'.site_url().'/users/profile/'.$user['userID'].'">'.ucfirst($user['userName']).'</a> posted <a href="#">'.$opinion['opinionTitle'].'</a> under <a href="'.site_url().'/opinions/listing/'.$opinion['opinionSubCategoryID'].'">'.$subCategory.'</a></h3>
						<img src="'.base_url().'public/images/starrs.png"/>';
    $opinionID = $opinion['opinionID'];
    $opinionTitle = $opinion['opinionTitle'];
    //Get the userName
    $userName = get_userName($opinion['userID']);
    //Get the subCategory Name
    $subCategory = get_subCategoryName($opinion['opinionSubCategoryID']);
    //Get the opinion Type
    $opinionType = get_opinionTypeName($opinion['opinionTypeID']);
    $opinions.=
            '<div class="blog-post">
					<p class="blog-date"><span>14th</span><br />October<br/>' . $opinionType . '</p><br/>
                                            
					<div class="blog-body">
						<h3><a href="#">' . $userName . '</a> posted <a href="#">' . $opinion['opinionTitle'] . '</a> under <a href="#">' . $subCategory . '</a></h3>
						<img src="' . base_url() . 'public/images/starrs.png"/>
						&nbsp;
						<span class="label">
						Current Votes :: 
						' . $opinion['agreeVotes'] . ' Agree /
						' . $opinion['disagreeVotes'] . ' Disagree / 
						' . $opinion['helpfulVotes'] . ' Helpful / 
						' . $opinion['funnyVotes'] . ' Funny</span>
						&nbsp;
						<button class="btn btn-success button_review" id="buttonreview_'.$opinionTitle."_".$opinionID.'"><i class="icon-star icon-white"></i> Review It !!!</button>
						<p>' . $opinion['opinionNarrative'] . '</p>
					   
<p>
<button class="btn btn-success button_comments" id="buttoncomments_'.$opinionTitle."_".$opinionID.'"><i class="icon-star icon-white"></i> Comments !!!</button>
						</p>
    Add Your Vote :
					        
							<span class="label label-success agree_vote" id="agree_'.$opinionID.'" ><i class="icon-thumbs-up icon-white"></i> Agree</span>
							<span class="label label-important disagree_vote" id="agree_'.$opinionID.'" ><i class="icon-thumbs-down icon-white opinion_vote"></i> Disagree</span>
							<span class="label label-info helpful_vote" id="helpful_'.$opinionID.'"><i class="icon-star-empty icon-white"></i> Helpful</span>
							<span class="label label-inverse funny_vote" id="funny_'.$opinionID.'"><i class="icon-heart icon-white"></i> Funny</span>
							
					</div>
					<div class="clear"></div>
	 </div>';
}

  //display
  echo $opinions;

?>				
				