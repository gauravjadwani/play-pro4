<?php


include_once '../model/user.php';
include_once '../config/session.php';

$assinged_for=$_POST['date'];
$project_id=$_POST['project_id'];
$task_name=$_POST['name'];
$priority=$_POST['priority'];
$created_on=time();
$association='project:'.$project_id;
$initiator=$user_id;
$closed_on='live';




$task_id=create_task($name,$assinged_for,$created_on,$association,$initiator,$priority,$closed_on);

add_task_to_project();









?>