<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This function gets and sub-category ID and returns the name
 * */
function get_subCategoryName($id) {
    //use as  
    $CI = & get_instance(); //first get instance
    $CI->load->model('opinionsubcategories_model');  //then load model through instance.   
    //and calling a model function 
    $subCategory = $CI->opinionsubcategories_model->get_subCategory($id);

    return $subCategory['subCategoryName'];
}

/**
 * This function gets opinion type name
 * */
function get_opinionTypeName($id) {
    //use as  
    $CI = & get_instance(); //first get instance
    $CI->load->model('opinions_model');  //then load model through instance.   
    //and calling a model function 
    $opinionType = $CI->opinions_model->get_opinionType($id);

    if ($opinionType['opinionTypeID'] == 1) {
        //Complaint
        return '<i class="icon-thumbs-down "></i>' . $opinionType['opinionTypeName'];
    } elseif ($opinionType['opinionTypeID'] == 2) {
        //Complement
        return '<i class="icon-thumbs-up "></i>' . $opinionType['opinionTypeName'];
    } elseif ($opinionType['opinionTypeID'] == 3) {
        //Observation
        return '<i class="icon-eye-open "></i>' . $opinionType['opinionTypeName'];
    }
}

?>