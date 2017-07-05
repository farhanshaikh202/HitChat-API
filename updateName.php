<?php

if(isset($_REQUEST["contact"]))
{
include 'dbconnect.php';
    $number=$_REQUEST["contact"];
    $status=$_REQUEST["name"];
    
 if(!mysql_query("UPDATE users SET name='$status' WHERE number=$number;"))
    {
        $a=array("success"=>"no");
        echo json_encode($a);
    }else {
        
        $a=array("success"=>"yes");
        echo json_encode($a);
    }
    
}
else{
    echo "Don't try to hack..!!";
}