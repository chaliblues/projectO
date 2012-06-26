<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* This function gets and ID and returns the userName
**/
function get_userName($userID)
{
	//use as  
    $CI =& get_instance(); //first get instance
    $CI->load->model('users_model');  //then load model through instance.   
    //and calling a model function 
    $user = $CI->users_model->get_user($userID);
    
    return $user['userName'];
}
?>