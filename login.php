<?php

if(isset($_REQUEST["no"]) && isset($_REQUEST["pwd"]))
{
    $no=$_REQUEST["no"];
    $pass=$_REQUEST["pwd"];
    
    include 'dbconnect.php';
    $result=mysql_query("SELECT number FROM users WHERE number='$no' AND password='$pass';");
    $row=mysql_fetch_array($result);
    
    if(count($row)==2){
         $a=array("success"=>"yes");
        echo json_encode($a);
    }else if(count($row)==1){
        $a=array("success"=>"no");
        echo json_encode($a);
    }else{
        $a=array("success"=>"no");
        echo json_encode($a);
    }
}
else{
    echo "Don't try to hack..!!";
}