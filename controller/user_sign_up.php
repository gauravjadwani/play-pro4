<?php

include_once '../model/user.php';


$name=$_REQUEST['name'];
$password=$_REQUEST['passwd'];
$email=$_REQUEST['email'];
$mobile=$_REQUEST['mobile'];
$current_time=time();


$result=check_existence_of_user_email($email);
if($result===true)
{
    echo "email exits";
//$result=
exit();
}

$result=check_existence_of_user_mobile($mobile);
if($result===true)
{
    echo "contact exits";
//$result=
exit();
}

$result=user_sign_up($email,$name,$mobile,$password,$current_time);
if($result>0)
    header("Location: ../view/login.html");
else
    echo 'else user_sign_up.php==='.$result;





?>