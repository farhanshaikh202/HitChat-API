<?php

if(isset($_REQUEST["mynum"]))
{
include 'dbconnect.php';
    $myno=$_REQUEST["mynum"];
    //TIME(time) AS time,DATE(time) AS date
 if($result=mysql_query("SELECT * FROM messages  WHERE id>(SELECT `lastmsgId` FROM `misc` WHERE `number`='$myno') AND receiver='$myno'"))
    {
        $emparray[] = array();
        $i=0;
        while($row =mysql_fetch_assoc($result))
        {
            
            $emparray[$i] = $row;
            
            $i++;
        }
        if($emparray[0]!=NULL){
        //print_r($emparray);
        
        echo json_encode($emparray);
        mysql_query("UPDATE messages SET isreceived=1 WHERE id>(SELECT `lastmsgId` FROM `misc` WHERE `number`='$myno') AND receiver='$myno'");
        mysql_query("UPDATE misc SET lastmsgId=(SELECT id FROM messages WHERE receiver='$myno' ORDER BY id DESC LIMIT 1) WHERE number='$myno';");
        }else{
            echo 'nullnullnull';
        }
    }else {
         $a=array("success"=>"no");
        echo json_encode($a);
    }
    
}
else{
    echo "Don't try to hack..!!";
}