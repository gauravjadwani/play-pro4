<?php


include '../include/db_functions.php';


//$check_sign_up=user_signup($email,$name,$mobile,$hashed_password,$current_time);

function user_login($user_id,$user_password)
{
$check_login=user_login_db($user_id,$user_password);
return $check_login;
}

function user_sign_up($email,$name,$mobile,$password,$current_time)
{
$check=user_sign_up_db($email,$name,$mobile,$password,$current_time);
return $check;
}


function check_existence_of_user_email($email)
{
    $user_id=check_existence_of_user_email_db($email);
        return $user_id;
        return $user_id;
        
}

function check_existence_of_user_mobile($mobile)
{
    $check=check_existence_of_user_mobile_db($mobile);
        return $check;
        
}

function state_user($user_id)
{
    
        $check=check_state_user_db($user_id);
        return $check;
        
}


function create_project($name,$created_on,$desc,$deadline,$associated_group,$list_of_tasks,$closed_on)
{
    $project_id=create_project_db($name,$created_on,$desc,$deadline,$associated_group,$list_of_tasks,$closed_on);
    return $project_id;
}

function  add_project_to_user_list_of_projects($user_id,$project_id)
{
    add_project_to_user_list_of_projects_db($user_id,$project_id);
    
}

function get_project_details($project_id)
{
    
    $project_details=get_project_detais_db($project_id);
    return $project_details;
}

function create_group($name,$created_on,$closed_on)
{
    
$check=create_group_db($name,$created_on,$closed_on);
    return $check;

}

function add_group_to_user_list_of_groups($user_id,$group_id)
{
    
    
    add_group_to_user_list_of_groups_db($user_id,$group_id);
}



function set_permissions_for_group($group_id,$list_of_email,$token)
{
    $check=set_permissions_for_group_db($group_id,$list_of_email,$token);
    return $check;
}


function user_get_notifications($user_id)
{
    
    $values=user_get_notifications_db($user_id);
    
    return $values;
    
}
function user_set_notifications($user_id,$current_time,$value)
{
    
    user_set_notifications_db($user_id,$current_time,$value);
    
}

?>