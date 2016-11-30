<?php

include_once '../model/user.php';
include_once '../config/session.php';

$group_name=$_POST['name_of_group'];
$group_list_members_readonly=$_POST['list_members_readonly'];
$group_list_members_modify=$_POST['list_members_modify'];

$created_on=time();
$closed_on='live';

$group_id=create_group($group_name,$created_on,$closed_on);


set_permissions_for_group($group_id,$email,0);
set_permissions_for_group($group_id,$group_list_members_readonly,2);

set_permissions_for_group($group_id,$group_list_members_modify,3);








?>