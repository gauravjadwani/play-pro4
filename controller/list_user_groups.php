<?php
include_once '../model/user.php';

$list_groups=get_user_groups(1);

//print_r($list_groups);
//exit();
$list_group_permission=array();

$list_group_details_modifier=array();
$list_group_details_owner=array();
$list_group_details_readonly=array();
//print_r($list_groups);
//exit();
if($list_groups!='empty group')
foreach($list_groups as $key)
{
       
    //print_r($list_groups);    
//exit();

    $permission=check_user_permissions($key,1);
    if($permission=='m'||$permission=='o')
    {
         array_push($list_group_permission,$key);
         if($permission=='m')
         {
         	$details=get_group_details($key);

 				array_push($list_group_details_modifier,$details);
         }
         else
         {
         	$details=get_group_details($key);

 				array_push($list_group_details_owner,$details);
 //array_push($list_group_permission_owner,$key);
         }
    }
    else
    {
    	$details=get_group_details($key);

 				array_push($list_group_details_readonly,$details);
					//array_push($list_group_permission_readonly,$key);
    }
    
}
//print_r($list_group_details_owner);
//print_r($list_group_details_modifier);
//print_r($list_group_details_readonly);
//var_dump($list_group_permission);

//var_dump($list_groups);









?>