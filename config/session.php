<?php
include '../config/config.php';
session_start();
    
    $name=$_SESSION["name"];
    $user_id=$_SESSION["user_id"];
   $_SESSION["email"]=$GLOBALS['r']->hget('user','email:'.$user_id);
    $email=$_SESSION["email"];
?>