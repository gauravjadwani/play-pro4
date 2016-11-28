<?php
//$GLOBALS['ip'];
$GLOBALS['ip']='127.0.0.1';
$GLOBALS['r']=new Redis;
//$r=new Redis();
$GLOBALS['r']->connect($GLOBALS['ip']);

?>