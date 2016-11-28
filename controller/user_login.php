<?php
include_once '../model/user.php';

$user_id=$_REQUEST['id'];
$user_password=$_REQUEST['passwd'];
$result=user_login($user_id,$user_password)
if($result===true)
    header("Location: ../views/dashboard.php");
elseif($result==-1)
    echo 'user not exist';
elseif($result==-2)
    echo 'password incorrect';




?>