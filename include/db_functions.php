<?php
include_once '../config/config.php';

function check_existence_of_user_id($user_id)
{
    
 $check=$GLOBALS['r']->hexists('user','name:'.$user_id);
    return $check;
}






////////////////////////////////////////////////////////////////////
function check_existence_of_user_password($user_id,$user_password)
{
 
     $check_password=$GLOBALS['r']->hget('user','password_hash:'.$user_id);
    if(password_verify($user_password,$check_password)) 
    {
        return true;
    }
    return false;
}



////////////////////////////////////////////////////////////////////////////////

function check_existence_of_user_email_db($email)
{
      $check_email=$GLOBALS['r']->hexists('email:user',$email);
    return $check_email;
    
}
/////////////////////////////////////////////////////////////////////
function check_existence_of_user_mobile_db($mobile)
{
     $check=$GLOBALS['r']->hexists('contact:user',$mobile);
    return $check;
    
    
}
////////////////////////////////////////////////////////////////////////

function check_state_user_db($user_id)
{
$result=$GLOBALS['r']->zscore('state:user',$user_id);
//echo $user_id.'user_id';
    //echo "from db_func==".$result;
    return $result;
    
    
}
////////////////////////////////////////////////////////////////////////////
function change_state_user_db($user_id,$token)
{
$result=$GLOBALS['r']->zadd('state:user',$token,$user);
//echo $user_id.'user_id';
    //echo "from db_func==".$result;
    return $result;
    
    
}
//////////////////////////////////////////////////////////////////////



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
    
    
    $check=$GLOBALS['r']->hMset('user', array('name:'.$user_id =>$name, 'mobile:'.$user_id =>$mobile,'email:'.$user_id=>$email,'password_hash:'.$user_id=>$hashed_password,'timestamp:'.$user_id=>$current_time,'list_of_projects:'.$user_id=>'null','list_of_groups:'.$user_id=>'null','list_of_tasks:'.$user_id=>'null','list_of_notifications:'.$user_id=>'null')); 
    
    $GLOBALS['r']->zadd("state:user",1,$user_id);
    
    $GLOBALS['r']->hincrby('parent','user_id',1);
    
     user_set_notifications_db($user_id,$current_time,'hello '.$name.'!'.' welcome to todo list!');
    
    
    return $user_id;
    
    
}
///////////////////////////////////////////////////////////////////////////////////////

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
/////////////////////////////////////////////////////////////////////////


function user_set_notifications_db($user_id,$current_time,$value)
{
    
//$GLOBALS['r']->zadd("notifications:".$user_id,$current_time,$value);
    $check_noti= $GLOBALS['r']->hget("user",'list_of_notifications:'.$user_id);
    if($check_noti=='null')
    {
        $d=array();
        $p=array($value,$current_time);
        array_push($d,$p);
        $j=json_encode($d);
        
        $GLOBALS['r']->hset("user",'list_of_notifications:'.$user_id,$j);
        
    }
    else
    {
        $j=json_decode($check_noti,true);
        $p=array($value,$current_time);
         array_push($j,$p);
        
         $GLOBALS['r']->hset("user",'list_of_notifications:'.$user_id,$j);
    }


}

///////////////////////////////////////////////////////////////
function user_get_notifications_db($user_id)
{
    
//$GLOBALS['r']->zadd("notifications:".$user_id,$current_time,$value);
    $list_noti= $GLOBALS['r']->hget("user",'list_of_notifications:'.$user_id);
    if($list_noti=='null')
    {
        return false;
    }
    else
    {
        $j=json_decode($list_noti,true);
        //$p=array($value,$current_time);
         //array_push($j,$p);
        
        return $j;     
    }


}



///////////////////////////////////////////////////////////
function create_project_db()
{
    
}
//////////////////////////////////////////////////////////////

function create_group_db($name,$created_on,$closed_on)
    {
        $date=time();
            $GLOBALS['r']->hsetnx('parent','group_id','1');
             $group_id= $GLOBALS['r']->hget('parent','group_id');
    $GLOBALS['r']->hMset('group',array('name:'.$group_id => $name_group,'created_on:'.$group_id=>$date,'closed_on:'.$group_id=>'live'));
    $GLOBALS['r']->hincrby('parent','group_id',1);
       return $group_id;
        }
/////////////////////////////////////////////////////////////////////////////

function add_group_to_list_of_groups_db($user_id,$group_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_groups:'.$user_id);
    if($list!='null')
    {
        $list_jsondeocde=json_decode($list,true);
            array_push($list_jsondeocde,$group_id);
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_groups:'.$user_id,$list_jsonencode);
        
        
    }
    else
    {
        $list=array($group_id);
        $list_jsonencode=json_encode($list);
    $GLOBALS['r']->hset('user','list_of_groups:'.$user_id,$list_jsonencode);
        
    }
    }
///////////////////////////////////////////////////////////////////////////


function add_project_to_list_of_projects_db($user_id,$project_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_projects:'.$user_id);
    if($list!='null')
    {
        $list_jsondeocde=json_decode($list,true);
            array_push($list_jsondeocde,$project_id);
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_projects:'.$user_id,$list_jsonencode);
        
        
    }
    else
    {
        $list=array($project_id);
        $list_jsonencode=json_encode($list);
    $GLOBALS['r']->hset('user','list_of_projects:'.$user_id,$list_jsonencode);
        
    }
    }
/////////////////////////////////////////////////////////////////////

function add_task_to_list_of_tasks_db($user_id,$task_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_tasks:'.$user_id);
    if($list!='null')
    {
        $list_jsondeocde=json_decode($list,true);
            array_push($list_jsondeocde,$task_id);
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_tasks:'.$user_id,$list_jsonencode);
        
        
    }
    else
    {
        $list=array($task_id);
        $list_jsonencode=json_encode($list);
    $GLOBALS['r']->hset('user','list_of_tasks:'.$user_id,$list_jsonencode);
        
    }
    
    
    
    
}
///////////////////////////////////////////////////////////////


//2 is for modifier,3 is for read-only,0 is for the owner
function set_permissions_for_group_db($group_id,$list_of_email,$token)
{
    $group_name=$GLOBALS['r']->hget('group:'.$group_id,'name');
    $split_email= split(",",$list_of_email);
    
    for($i=0;$i<sizeof($split_email);$i++)
{
    
    $GLOBALS['r']->zadd("group_permissions:".$group_id,$token,split_email[$i]);
   
        $user_id=$GLOBALS['r']->hget('email:user',split_email($i));
        $current_time=time();
    if($token==0)
    {
    $value='you created the group '.$group_name.' on '.$current_time;
        }
    elseif($token==2)
    {
       $value='you were added in the group '.$group_name.' on '.$current_time.' as modifier';
     
    }
    elseif($token==3)
    {
     $value='you were added in the group '.$group_name.' on '.$current_time.' as modifier';
    }
        
    user_notifications_db($user_id,$current_time,$value);
}
        
}
///////////////////////////////////////////////////////////////

?>