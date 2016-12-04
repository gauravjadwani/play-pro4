<?php

include_once '../model/user.php';
include_once '../config/session.php';

$group_id=$_POST['group'];
$group_list_members_readonly=$_POST['list_members_readonly'];
$group_list_members_modify=$_POST['list_members_modify'];

$created_on=time();
$closed_on='live';

//$group_id=create_group($group_name,$created_on,$closed_on,$user_id);


if(isset($group_list_members_modify)&&$group_list_members_modify!='')
{  
set_permissions_for_group($group_id,$group_list_members_modify,2);
//add_group_to_user_list_of_groups($user_id,$group_id);
}
if(isset($group_list_members_readonly)&&$group_list_members_readonly!='')
{
set_permissions_for_group($group_id,$group_list_members_readonly,3);
}


header('Location: ../view/add_group.php');




?>