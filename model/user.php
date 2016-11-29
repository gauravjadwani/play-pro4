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
    $check=check_existence_of_user_email_db($email);
        return $check;
        
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


function create_group($name,$created_on,$closed_on)
{
    
$check=create_group_db($name,$created_on,$closed_on);
    return $check;

}
function set_permissions_for_group($group_id,$list_of_email,$token)
{
    $check=set_permissions_for_group_db($group_id,$list_of_email,$token);
    return $check;
}


function get_notifications($user_id)
{
    
    $values=user_get_notifications_db($user_id);
    
    return $values;
    
}

?>