<?php

include_once '../model/user.php';

$values=user_get_notifications($user_id);

$len=sizeof($values);

for($i=0;$i<$len;$i++)
{
	
	$data=$values[$i][0];
    $date=$values[$i][1];
    $date1=gmdate("Y-m-d\TH:i:s\Z", $date);
	
    
    echo $data.' date is: '.$date1.'</br>';
    //echo gmdate("Y-m-d\TH:i:s\Z", $date);
    //echo  date('U = Y-m-d H:i:s', $dates);
	
}







?>