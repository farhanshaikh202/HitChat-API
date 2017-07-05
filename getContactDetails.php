<?php

include 'dbconnect.php';
$contact=$_REQUEST['contact'];
$arr=array();
if($r=mysql_query("SELECT * FROM users WHERE number LIKE '%{$contact}%'"))
    {
    
    if(mysql_num_rows($r)>0)
        {
        while($row =mysql_fetch_assoc($r))
        {
            $arr[0] = $row;
            break;
        }
        
        }
    }

echo json_encode($arr);