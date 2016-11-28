<?php
include_once '../config/config.php';
$GLOBALS['r']=new Redis;
//$r=new Redis();
$GLOBALS['r']->connect($GLOBALS['ip']);
function check_existence_of_user_id($user_id)
{
    
 $check=$GLOBALS['r']->exits($user_id);
    return $check;
    }

function check_existence_of_user_password($user_id,$user_password)
{
 
     $check_password=$GLOBALS['r']->hget('user:'.$user_id,'password_hash');
    if (password_verify($user_password,$check_hash)) 
    {
        return true;
    }
    return false;
}

function state_user($user_id)
{

    
    
}

function check_existence_of_user_email_db($email)
{
      $check_email=$GLOBALS['r']->hexists('email:user',$email);
    return $check_email;
    
}

// -1 for contact  exists,-2 for email exits!
function user_sign_up_db($email,$name,$mobile,$password,$current_time)
{
      $GLOBALS['r']->hsetnx('parent','user_id','1');
    $user_id=$GLOBALS['r']->hget('parent','user_id');
    
    $check=$GLOBALS['r']->hsetnx('email:user',$email,$user_id);
    if($check===false)
        return -2;

   $check=$GLOBALS['r']->hsetnx('contact:user',$mobile,$user_id);
    if($check===false)
        return -1;
    
     $hashed_password=password_hash($password,PASSWORD_DEFAULT);
     //$current_time=time();
    
    
    $check=$GLOBALS['r']->hMset('user:'.$user_id, array('name' =>$name, 'mobile' =>$mobile,'email'=>$email,'password_hash'=>$hashed_password,'timestamp'=>$current_time)); 
    
    $GLOBALS['r']->zadd("state:user",1,$user_id);
    
    $GLOBALS['r']->hincrby('parent','user_id',1);
    
    return $user_id;
    
    
}

//-1 for user not exist -2 for password wrong
function user_login_db($user_id,$user_password)
{
    $check_id=check_existence_of_user_id($user_id);
    if($check_id===false)
        return -1;
    $check_password=check_existence_of_user_password($user_id,$user_password);
    if($check_password===false)
        return -2;
    return true;
        
    
}


function user_mobile_db($mobile)
{
    
    
    
}

?>