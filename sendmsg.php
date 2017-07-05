<?php

if(isset($_REQUEST["mynum"]) && isset($_REQUEST["tonum"]) && isset($_REQUEST["message"]))
{
include 'dbconnect.php';
    $myno=$_REQUEST["mynum"];
    $tono=$_REQUEST["tonum"];
    $msg=$_REQUEST["message"];
 if(!mysql_query("INSERT INTO messages (sender,receiver,message) VALUES('$myno','$tono','$msg');"))
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