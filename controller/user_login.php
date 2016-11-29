<?php
include_once '../model/user.php';

$user_id=$_REQUEST['id'];
$user_password=$_REQUEST['passwd'];

$result=state_user($user_id);


if($result==0)
{
	echo "user is does not exist==".$result; 
    //var_dump($result);
    exit();
}
elseif($result===false)
{
	echo "user is barred by admin==".$result; 
    exit();
}

$result=user_login($user_id,$user_password);
if($result===true)
{
    
                session_start();
            //$_SESSION["email"]=$email;
            $name=$GLOBALS['r']->hget('user','name:'.$user_id);
    
            echo $name;
            $_SESSION["name"]=$name;
           
            $_SESSION["user_id"]=$user_id;
                    
    
    header("Location: ../view/dashboard.php");
exit();

    }
    elseif($result==-1)
    echo 'user not exist';
elseif($result==-2)
    echo 'password incorrect';




?>