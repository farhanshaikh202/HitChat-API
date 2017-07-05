<?php
 
include 'dbconnect.php';
if(isset($_POST['pic'])){
// Path to move uploaded files
$target_path = "userdp/";
 $root=$target_path;
// array for final json respone
$response = array();
 
// getting server ip address
$server_ip = gethostbyname(gethostname());
 
// final file url that is being uploaded
$file_upload_url = 'http://192.168.43.26:90/chatts/'. $target_path;
 
 
if (isset($_FILES['image']['name'])) {
    
 
    // reading other post parameters
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    

    $fileName="PIC_".$number."_".time()."_".basename($_FILES['image']['name']);
    $target_path=$target_path.$fileName;
    $response['file_name'] = $fileName;
    
 
    try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // make error flag true
            $response['error'] = true;
            $response['message'] = 'Could not move the file!';
        }
 
        if($response['thumb']=$file_upload_url.makeThumbnails($root, $fileName,100,100)){
        // File successfully uploaded
        $response['message'] = 'File uploaded successfully!';
        $response['error'] = false;
        $response['url'] = $file_upload_url . $fileName;
        $url=$response['url'];
        $thumb=$response['thumb'];
        mysql_query("UPDATE users SET imageUrl='$url',image_thumb='$thumb' WHERE number LIKE '%{$number}%';");
        }  else {
            
        $response['error'] = true;
        
        }
    } catch (Exception $e) {
        // Exception occurred. Make error flag true
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }
} else {
    // File parameter is missing
    $response['error'] = true;
    $response['message'] = 'Not received any file!F';
}
 
// Echo final json response to client
echo json_encode($response);

}elseif (isset($_POST['cover'])) {
 // Path to move uploaded files
$target_path = "usercover/";
 $root=$target_path;
// array for final json respone
$response = array();
 
// getting server ip address
$server_ip = gethostbyname(gethostname());
 
// final file url that is being uploaded
$file_upload_url = 'http://192.168.43.26:90/chatts/'. $target_path;
 
 
if (isset($_FILES['image']['name'])) {
    
 
    // reading other post parameters
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    

    $fileName="COVER_".$number."_".time()."_".basename($_FILES['image']['name']);
    $target_path=$target_path.$fileName;
    $response['file_name'] = $fileName;
    
 
    try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // make error flag true
            $response['error'] = true;
            $response['message'] = 'Could not move the file!';
        }
 
        if($response['thumb']=$file_upload_url.makeThumbnails($root, $fileName,300,250)){
        // File successfully uploaded
        $response['message'] = 'File uploaded successfully!';
        $response['error'] = false;
        $response['url'] = $file_upload_url . $fileName;
        $url=$response['url'];
        $thumb=$response['thumb'];
        mysql_query("UPDATE users SET coverUrl='$url',cover_thumb='$thumb' WHERE number LIKE '%{$number}%';");
        }  else {
            
        $response['error'] = true;
        
        }
    } catch (Exception $e) {
        // Exception occurred. Make error flag true
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }
} else {
    // File parameter is missing
    $response['error'] = true;
    $response['message'] = 'Not received any file!F';
}
 
// Echo final json response to client
echo json_encode($response);
}

function makeThumbnails($updir, $filename,$x,$y)
{
    $thumbnail_width = $x;
    $thumbnail_height = $y;
    $thumb_beforeword = "thumb_";
    $arr_image_details = getimagesize("$updir"."$filename"); 
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);
    if ($arr_image_details[2] == 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }
    if ($imgt) {
        $old_image = $imgcreatefrom("$updir"."$filename");
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, "$updir"."$thumb_beforeword"."$filename");
        return "$thumb_beforeword"."$filename";
    }  else {
        return FALSE;
    }
}
?>