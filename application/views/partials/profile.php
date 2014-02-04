<div class="alert-message block-message warning">
	<?php
    
    //Get the userName
    if($userID!=0)
    {
      $user=get_user($userID);	

      //Buttons
      
      $userButtons=
      '    <div class="btn-group">
		    <button class="btn">View Opinions</button>
		    <button class="btn">Subscribe to opinions</button>
		    </div>';
      if($user)
      {
      	 $data=
      	 '<div class="alert-message block-message warning">
      	    <table cellspacing="5px">
      	    <tr>
      	    <td> 
      	       <img src="'.base_url().'public/images/profile/'.$user['picName'].'"> <br/>

      	    </td>
      	    <td>
                <strong>Names</strong> : '.$user['userNames'].'<br/>     
	            <strong>Username</strong> : '.$user['userName'].'<br/>
	            <strong>Gender</strong> : '.$user['gender'].'<br/><br/>
                '.$userButtons.'
      	    </td>
      	    </tr>
      	    </table>
      	   
      	    
          </div>';
         echo $data;
      }
    }else{
    	echo '<h2>No user with that ID</h2>';
    }
  	
    
	?>
</div>