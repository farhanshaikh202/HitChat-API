<?php
/**
$arr=array();
$i=0;
for($i=0;$i<5;$i++){
    $nested=  array();
    for($j=0;$j<5;$j++){
        $nested["hello"]=$j;
    }
        $arr[$i]=$nested;
        
    
}
// Echo final json response to client
echo json_encode($arr);
*/

    $list=  explode(",", "7600473542,9824450124");
    
include 'dbconnect.php';
$arr=array();
$i=0;
foreach ($list as $contact){
    $temp=$contact;
    //$contact=substr($contact, -10);
    
    
    if($r=mysql_query("SELECT * FROM users WHERE number LIKE '%{$contact}%'"))
    {
    if(mysql_num_rows($r)>0)
        {
        while($row =mysql_fetch_assoc($r))
        {
            $arr[$i] = $row;
            $i++;
        }
        }
    }
}
// Echo final json response to client
echo json_encode($arr);