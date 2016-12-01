<?php
include_once '../model/user.php';

$list_groups=get_user_groups($user_id);
//print_r($list_groups);
//exit();
$list_group_permission=array();
foreach($list_groups as $key)
{
       
    //print_r($list_groups);    
//exit();

    $permission=check_user_permissions($key,$user_id);
    if($permission=='m'||$permission=='o')
    {
         array_push($list_group_permission,$key);
    }

    
}
//var_dump($list_group_permission);

//var_dump($list_groups);









?>