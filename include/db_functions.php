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
      $user_id=$GLOBALS['r']->hget('email:user',$email);
    //return $check_email;
    if($user_id===false)
        return 'false';
        else
            return $user_id;
    
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
    
    
    $check=$GLOBALS['r']->hMset('user', array('name:'.$user_id =>$name, 'mobile:'.$user_id =>$mobile,'email:'.$user_id=>$email,'password_hash:'.$user_id=>$hashed_password,'timestamp:'.$user_id=>$current_time,'list_of_projects:'.$user_id=>'null','list_of_groups:'.$user_id=>'null','list_of_tasks_self:'.$user_id=>'null','list_of_tasks_project:'.$user_id=>'null','list_of_notifications:'.$user_id=>'null')); 
    
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
        $q=json_encode($j);
        
         $GLOBALS['r']->hset("user",'list_of_notifications:'.$user_id,$q);
    }


}

///////////////////////////////////////////////////////////////////////////////
function user_get_notifications_db($user_id)
{
    
//$GLOBALS['r']->zadd("notifications:".$user_id,$current_time,$value);
    $list_noti=$GLOBALS['r']->hget("user",'list_of_notifications:'.$user_id);
    if($list_noti=='null')
    {
        return false;
    }
    else
    {
        $notifications_array=json_decode($list_noti,true);
        //$p=array($value,$current_time);
         //array_push($j,$p);
        
        return $notifications_array;     
    }


}



//////////////////////////////////////////////////////////////////////////////


function create_task_db($name,$assinged_for,$created_on,$association,$initiator,$priority,$closed_on)
{
    $GLOBALS['r']->hsetnx('parent','task_id','1');
    $project_id=$GLOBALS['r']->hget('parent','task_id');
$GLOBALS['r']->hMset('task',array('name:'.$task_id=>$name,'assinged_for:'.$task_id=>$assinged_for,'created_on:'.$task_id=>$created_on,'association:'.$task_id=>'null','initiator:'.$task_id=>$initiator,'priority:'.$task_id=>$priority,'closed_on:'.$task_id=>$closed_on)); 
    
    
     $GLOBALS['r']->hincrby('parent','task_id',1);

    return $project_id;
    
    
}



///////////////////////////////////////////////////////////////////////////////////////////

function add_task_to_self_db($task_id,$user_id)
{
    $current_time=time();
$check=$GLOBALS['r']->hget('task','association:'.$task_id);
    if($check=='null')
    {
       $GLOBALS['r']->hset('task','association:'.$task_id,'self');
       //$task_name=$GLOBALS['r']->hget('task','name:'.$task_id);
       
        $task_name=$GLOBALS['r']->hget('task','name:'.$task_id);
        user_set_notifications_db($user_id,$current_time,'you have task name:'.$task_name.' to self at '.$current_time);

        add_task_to_user_list_of_tasks_self_db($user_id,$task_id);

    }
    else
    {
      echo 'task is already added';  
    }
    

}
//////////////////////////////////////////////////////////////////////////////////////

function add_task_to_user_list_of_tasks_self_db($user_id,$task_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_tasks_self:'.$user_id);
    if($list!='null')
    {
      
        
        $list_jsondeocde=json_decode($list,true);
        
        
        //$list=array();
        array_push($list_jsondeocde,$task_id);
        
          
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_tasks_self:'.$user_id,$list_jsonencode);
        
        
    }
    else
    {
           //$d=array();
        $p=array($task_id);
        //array_push($d,$p);
        $j=json_encode($p);
        
        
    $GLOBALS['r']->hset('user','list_of_tasks_self:'.$user_id,$j);
        
    }
    
    
}
//////////////////////////////////////////////////////////////////////////////////////


function add_task_to_project_db($task_id,$user_id,$project_id)
{
    $current_time=time();
$check=$GLOBALS['r']->hget('task','association:'.$task_id);
    if($check=='null')
    {
       $GLOBALS['r']->hset('task','association:'.$task_id,'project:'.$project_id);
        
        $task_name=$GLOBALS['r']->hget('task','name:'.$task_id);
        $project_name=$GLOBALS['r']->hget('project','name:'.$project_id);
        user_set_notifications_db($user_id,$current_time,'you have task name:'.$task_name.' to project name '.$project_name.' at '.$current_time);

        add_task_to_user_list_of_tasks_projects_db($user_id,$task_id);
        add_task_to_project_list_of_tasks_db($project_id,$task_id);

        
    }
    else
    {
      echo 'task is already added';  
    }
    

}

/////////////////////////////////////////////////////////////////////////////
function add_task_to_user_list_of_tasks_projects_db($user_id,$task_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_tasks_projects:'.$user_id);
    if($list!='null')
    {
      
        
        $list_jsondeocde=json_decode($list,true);
        
        
        //$list=array();
        array_push($list_jsondeocde,$task_id);
        
          
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_tasks_projects:'.$user_id,$list_jsonencode);
        
        
    }
    else
    {
           //$d=array();
        $p=array($task_id);
        //array_push($d,$p);
        $j=json_encode($p);
        
        
    $GLOBALS['r']->hset('user','list_of_tasks:'.$user_id,$j);
        
    }
    
    
}
///////////////////////////////////////////////////////////////////////////////////
function add_task_to_project_list_of_tasks_db($project_id,$task_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_tasks:'.$project_id);
    if($list!='null')
    {
      
        
        $list_jsondeocde=json_decode($list,true);
        
        
        //$list=array();
        array_push($list_jsondeocde,$task_id);
        
          
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_tasks:'.$project_id,$list_jsonencode);
        
        
    }
    else
    {
           //$d=array();
        $p=array($task_id);
        //array_push($d,$p);
        $j=json_encode($p);
        
        
    $GLOBALS['r']->hset('user','list_of_tasks:'.$project_id,$j);
        
    }
    
    
}
///////////////////////////////////////////////////////////////////////////////////
function create_project_db($name,$created_on,$desc,$deadline,$associated_group,$list_of_tasks,$closed_on,$created_by)
{
    $current_time=time();

    $GLOBALS['r']->hsetnx('parent','project_id','1');
    $project_id=$GLOBALS['r']->hget('parent','project_id');
$GLOBALS['r']->hMset('project',array('name:'.$project_id=>$name,'created_on:'.$project_id=>$created_on,'desc:'.$project_id=>$desc,'deadline:'.$project_id=>$deadline,'associated_group:'.$project_id=>$associated_group,'list_of_tasks:'.$project_id=>$list_of_tasks,'closed_on:'.$project_id=>$closed_on,'created_by:'.$project_id=>$created_by)); 
    
    user_set_notifications_db($created_by,$current_time,'you created the project '.$name.' on  '.$created_on);
    
    user_set_notifications_db($created_by,$current_time,'you added the group id:'.$associated_group.' on  '.$created_on.' in the project '.$name);
     $GLOBALS['r']->hincrby('parent','project_id',1);
    return $project_id;

}
///////////////////////////////////////////////////////////////////////////////////////



function add_project_to_user_list_of_projects_db($user_id,$project_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_projects:'.$user_id);
    if($list!='null')
    {
      
        
        $list_jsondeocde=json_decode($list,true);
        
        
        //$list=array();
        array_push($list_jsondeocde,$project_id);
        
          
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_projects:'.$user_id,$list_jsonencode);
        
        
    }
    else
    {
           //$d=array();
        $p=array($project_id);
        //array_push($d,$p);
        $j=json_encode($p);
        
        
    $GLOBALS['r']->hset('user','list_of_projects:'.$user_id,$j);
        
    }
    
    
}

//////////////////////////////////////////////////////////////////////////////



function get_project_detais_db($project_id)
{
    $project_details=array();
   
    $project_name=$GLOBALS['r']->hget('project','name:'.$project_id);
     array_push($project_details,$project_name);
    $created_on=$GLOBALS['r']->hget('project','created_on:'.$project_id);
     array_push($project_details,$created_on);
    $desc=$GLOBALS['r']->hget('project','desc:'.$project_id);
     array_push($project_details,$desc);
    $deadline=$GLOBALS['r']->hget('project','deadline:'.$project_id);
     array_push($project_details,$deadline);
    $associated_group=$GLOBALS['r']->hget('project','associated_group:'.$project_id);
     array_push($project_details,$associated_group);
    $list_of_tasks=$GLOBALS['r']->hget('project','list_of_tasks:'.$project_id);
     array_push($project_details,$list_of_tasks);
     $closed_on=$GLOBALS['r']->hget('project','closed_on:'.$project_id);
     array_push($project_details,$closed_on);
    
    return $project_details;
    
    
}

///////////////////////////////////////////////////////////////////////////////////////
function add_project_toallmembers_group($group_id,$project_id)
{

  $list_members_id=get_members_group($group_id);
  foreach () {
    # code...
  }
add_project_to_user_list_of_projects_db($user_id,$project_id);

}

////////////////////////////////////////////////////////////////////////////////////////

 function  get_user_projects_db($user_id)
 {

$list_projects=$GLOBALS['r']->hget('user','list_of_projects:'.$user_id);
     if($list_projects!='null')
     {
     $list_projects_json=json_decode($list_projects,true);
     return $list_projects_json;
     }
     else
         return 'empty projects';


 }
////////////////////////////////////////////////////////////////////////////////////////

function create_group_db($name,$created_on,$closed_on,$created_by,$list_of_)
    {
        
            $GLOBALS['r']->hsetnx('parent','group_id','1');
             $group_id=$GLOBALS['r']->hget('parent','group_id');
    $GLOBALS['r']->hMset('group',array('name:'.$group_id=>$name,'created_on:'.$group_id=>$created_on,'closed_on:'.$group_id=>$closed_on,'created_by:'.$group_id=>$created_by,'list_of_projects:'.$group_id=>$list_of_projects)); 
    $GLOBALS['r']->hincrby('parent','group_id',1);
        $email_user_id=$GLOBALS['r']->hget('user','email:'.$created_by);
        
        
       return $group_id;
        }
/////////////////////////////////////////////////////////////////////////////

function add_group_to_user_list_of_groups_db($user_id,$group_id)
{
    $list=$GLOBALS['r']->hget('user','list_of_groups:'.$user_id);
    if($list!='null')
    {
      
        
        $list_jsondeocde=json_decode($list,true);
        
         //$d=array();
        //$list=array($group_id);
        //array_merge(array1)($list_jsondeocde,$list);
        
            array_push($list_jsondeocde,$group_id);
        
        $list_jsonencode=json_encode($list_jsondeocde);
        
        $GLOBALS['r']->hset('user','list_of_groups:'.$user_id,$list_jsonencode);
        
        
    }
    else
    {
           //$d=array();
        $p=array($group_id);
        //array_push($d,$p);
        $j=json_encode($p);
        
        
        //$list=array($group_id);
        //$list_jsonencode=json_encode($d);
    $GLOBALS['r']->hset('user','list_of_groups:'.$user_id,$j);
        
    }
    }
///////////////////////////////////////////////////////////////////////////




//2 is for modifier,3 is for read-only,1 is for the owner
function set_permissions_for_group_db($group_id,$list_of_email,$token)
{
    $group_name=$GLOBALS['r']->hget('group','name:'.$group_id);
    $split_email=split(",",$list_of_email);
    
    for($i=0;$i<sizeof($split_email);$i++)
{
    $user_id_email=$GLOBALS['r']->hget('email:user',$split_email[$i]);
    
    $GLOBALS['r']->zadd("group_permissions:".$group_id,$token,$user_id_email);
    
   
        //$user_id=$GLOBALS['r']->hget('email:user',split_email($i));
    $user_id=check_existence_of_user_email_db($split_email[$i]);    
    if($user_id!='false')
    {
    $current_time=time();
    if($token==1)
    {
    $value='you created the group '.$group_name.' ';
        }
    elseif($token==2)
    {
       $value='you were added in the group '.$group_name.' on '.$current_time.' as modifier';
     
    }
    elseif($token==3)
    {
     $value='you were added in the group '.$group_name.' on '.$current_time.' as readonly';
    }
        
           
            user_set_notifications_db($user_id_email,$current_time,$value);
         add_group_to_user_list_of_groups_db($user_id_email,$group_id);
}
    else
    {
        continue;
    }
}
    return 'set_permissions_db_functions';
}
///////////////////////////////////////////////////////////////

function check_user_permission_for_group_db($group_id,$user_id)

{
   $p=$GLOBALS['r']->zscore('group_permissions:'.$group_id,$user_id);
    //print_r($p);
//exit();
    
        if($p==1)
            return 'o';
       elseif($p==2)
            return 'm';
       elseif($p==3)
            return 'r';
        else 
            return 'n';
    
}

/////////////////////////////////////////////////////////////////////////////////////
 function  get_user_groups_db($user_id)
 {
     $list_groups_json=$GLOBALS['r']->hget('user','list_of_groups:'.$user_id);
     if($list_groups_json!='null')
     {
     $list_groups=json_decode($list_groups_json,true);
     return $list_groups;
     }
     else
         return 'empty group';
     
 }
/////////////////////////////////////////////////////////////////////////////////////
 function get_group_details_db($group_id)
{
    $group_details=array();
   array_push($group_details,$group_id);
    $group_name=$GLOBALS['r']->hget('group','name:'.$group_id);
     array_push($group_details,$group_name);
    $created_on=$GLOBALS['r']->hget('group','created_on:'.$group_id);
     array_push($group_details,$created_on);
    $closed_on=$GLOBALS['r']->hget('group','closed_on:'.$group_id);
     array_push($group_details,$closed_on);
    $created_by=$GLOBALS['r']->hget('group','created_by:'.$group_id);
     array_push($group_details,$created_by);
    $list_of_group_projects=get_group_projects_db($group_id);
    array_push($group_details,$list_of_group_projects);

    
    return $group_details;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
    function  get_group_projects_db($group_id)
 {

$list_projects=$GLOBALS['r']->hget('group','list_of_projects:'.$group_id);
     if($list_projects!='null')
     {
     $list_projects_json=json_decode($list_projects,true);
     return $list_projects_json;
     }
     else
         return 'empty projects';


 }
 /////////////////////////////////////////////////////////////////////////////////////////
 function get_members_group($group_id)
 {

$list_members_of_group=$GLOBALS['r']->zrange('group_permissions:'.$group_id,0,-1);
if(!empty($list_members_of_group))
return $list_members_of_group;
else
  return 'no memebers';

 }

?>