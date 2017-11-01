<?php
include_once ("../Connection/check_logged_user.php");
include_once ("../Test/test_file.php");

if($user_ok != true || $log_username == ""){
   exit();	
}
?><?php
$dp = "";
if(isset($_POST))
{
	//check if this is an ajax request
	/*if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}*/
	
	// check $_FILES['ImageFile'] not empty
			if(isset($_FILES["profile"]["name"]) && $_FILES["profile"]["tmp_name"] != ""){
   $fileName = $_FILES["profile"]["name"];
   $fileTempLoc = $_FILES["profile"]["tmp_name"];
   $fileType = $_FILES["profile"]["type"];
   $fileSize = $_FILES["profile"]["size"];
   $fileErrorMsg = $_FILES["profile"]["error"];
   $extension = explode(".",$fileName);
   $fileExt = end($extension);
   list($width, $height) = getimagesize($fileTempLoc);
   if($width < 10 || $height < 10){
	  header("location: ../message.php?msg=ERROR: That image has no dimensions");
        exit();	 
   }
   $db_file_name = get_rand_id(16).".".$fileExt;
   /*if($fileSize > 4048576){
	  header("location: ../message.php?msg=ERROR: Your image file was larger than 1mb");
		exit();   
   }*/
   if(!preg_match("/\.(gif|jpg|png)$/i", $fileName)){
	   header("location: ../message.php?msg=ERROR: Your image file was not jpg, gif or png type");
		exit();
	} else if ($fileErrorMsg == 1) {
		header("location: ../message.php?msg=ERROR: An unknown error occurred");
		exit();
	}
	$sql = "SELECT cplink FROM users WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$num_rows = mysqli_num_rows($query);
    $row = mysqli_fetch_row($query);
	$profile_pic = $row[0];
	if($profile_pic != "" || $profile_pic != NULL){
	   $pic_url = "../Users/$log_username/$profile_pic";
	   if(file_exists($pic_url)){
		   unlink($pic_url);
	   }
	}
	  $moveResult = move_uploaded_file($fileTempLoc,          "../Users/".$log_username."/".$db_file_name);
	  	if ($moveResult != true) {
		
		header("location: ../message.php?msg=ERROR: File upload failed");
		exit();
	}
	 copy("../Users/".$log_username."/".$db_file_name,"../Users/".$log_username."/album/cover/".$db_file_name);
	  
	   $src = "Users/".$log_username."/".$db_file_name;
	   $src_insrt = "Users/".$log_username."/album/cover/".$db_file_name;
	include_once ("../Connection/image_resize.php");
	$target_file = "../Users/$log_username/$db_file_name";
	$resized_file = "../Users/$log_username/$db_file_name";
	$wmax = 1000;
	$hmax = 400;
	img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
	$sql = "UPDATE users SET cplink='$db_file_name' WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	
	//echo "he".$src;
	//echo '<img src="blue.jpg">';
	$dp = '<img src="'.$src.'" id="preview_cp" style="width:900;height:300px;">';
	$insrt_post = '<img src="'.$src_insrt.'" id="preview_cp" style="width:500px;height:300px;" onclick="showPhoto()">';
	
	$sql = "INSERT INTO status(account_name, author, type, data, note, postdate) VALUES ('$log_username','$log_username','a','$insrt_post','changed cover photo',now())";
	$query = mysqli_query($con, $sql);
	$id = mysqli_insert_id($con);
	
	$sql = "UPDATE status SET osid='$id' WHERE id='$id' LIMIT 1";
	$query = mysqli_query($con, $sql);
	mysqli_close($con);
	echo $dp;
	
	//header("location: ../users.php?u=$log_username");
	exit();
}
}
	

	?>