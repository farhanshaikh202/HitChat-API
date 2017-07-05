<?php

if(isset($_REQUEST["list"])){
    $contact=$_REQUEST["list"];
    
include 'dbconnect.php';

    $contact=substr($contact, -10);
    if($r=mysql_query("SELECT id FROM users WHERE number LIKE '%{$contact}%'"))
    {
                
    if(mysql_num_rows($r)>0)
        {
        $a=array("success"=>"yes");
        echo json_encode($a);
        }
    else{
        $a=array("success"=>"no");
        echo json_encode($a);
    }
     
    }
    else{
        $a=array("success"=>"no");
        echo json_encode($a);
    }
}
