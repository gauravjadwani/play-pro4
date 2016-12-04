<?php
include_once '../model/user.php';

$list_projects=get_user_projects($user_id);
//print_r($list_groups);
//exit();
$list_user_projects=array();
//print_r($list_groups);
//exit();
if($list_projects!='empty projects')
	//print_r($list_projects);
//exit();

foreach($list_projects as $key)
{
       
    //print_r($list_groups);    
//exit();
	$project_details=get_project_details($key);

    $permission=check_user_permissions($project_details[4],$user_id);
    if($permission=='m'||$permission=='o')
    {
         array_push($list_user_projects,$key);
    }

    
}
//var_dump($list_group_permission);

//var_dump($list_groups);









?>