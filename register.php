<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_REQUEST["no"]) && isset($_REQUEST["name"]) && isset($_REQUEST["pwd"]))
{
    $no=$_REQUEST["no"];
    $name=$_REQUEST["name"];
    $pass=$_REQUEST["pwd"];
    
    include 'dbconnect.php';
    
    if(!mysql_query("INSERT INTO users (number,name,password,coverUrl,cover_thumb,imageUrl,image_thumb,status) VALUES('$no','$name','$pass','http://192.168.43.26:90/chatts/usercover/COVER_7600473542_1461703811_crop_cache_file.jpg','http://192.168.43.26:90/chatts/usercover/thumb_COVER_7600473542_1461703811_crop_cache_file.jpg','http://192.168.43.26:90/chatts/userdp/PIC__1461693818_crop_cache_file.jpg','http://192.168.43.26:90/chatts/userdp/thumb_PIC__1461693818_crop_cache_file.jpg','Hey, there i am using HitChat');"))
    {
        $a=array("success"=>"no");
        echo json_encode($a);
    }else {
        mysql_query("INSERT INTO misc (number) VALUES('$no');");
        $a=array("success"=>"yes");
        echo json_encode($a);
    }
}
else{
    echo "Don't try to hack..!!";
}