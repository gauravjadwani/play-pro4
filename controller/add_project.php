<?php

include_once '../model/user.php';
include_once '../config/session.php';

$project_name=$_POST['name_of_the_project'];
$associated_group=$_POST['associated_group'];
$desc=$_POST['desc'];
$deadline=$name=$_POST['deadline'];
$list_of_tasks='null';
$closed_on='null';

//$group_list_members_readonly=$_POST['list_members_readonly'];
//$group_list_members_modify=$_POST['list_members_modify'];

$created_on=time();
$current_time=time();
$closed_on='live';



$project_id=create_project($project_name,$created_on,$desc,$deadline,$associated_group,$list_of_tasks,$closed_on);
$project_details=get_project_details($project_id);

user_set_notifications($user_id,$current_time,'you created the project '.$project_details[0].' on    '.$created_on);

add_project_to_user_list_of_projects($user_id,$project_id);





?>