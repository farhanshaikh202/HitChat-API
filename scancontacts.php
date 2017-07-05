<?php
 
// Path to move uploaded files
$target_path = "contacts/";

// getting server ip address
$server_ip = gethostbyname(gethostname());
 
// final file url that is being uploaded
$file_upload_url = 'http://' . $server_ip  ."/". $target_path;
 
 
if (isset($_FILES['text']['name'])) {
    $target_path = $target_path . basename($_FILES['text']['name']);
 
    try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['text']['tmp_name'], $target_path)) {
            
        }else{
            check($target_path);
        }
 
       
    } catch (Exception $e) {
       
    }
} else {
   //check($target_path."7600473542.txt");
}
 
function check($path){
$filetext = file_get_contents($path, true);
    $list=  explode(",", $filetext);
    
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
}


 
