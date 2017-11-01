<?php
include_once("../Connection/check_logged_user.php"); 
if($user_ok != true || $log_username == ""){
   exit();	
}

if(isset($_POST))
{
	############ Edit settings ##############
	$ThumbSquareSize 		= 100; //Thumbnail will be 200x200
	$BigImageMaxSize 		= 300; //Image Maximum height or width
	$ThumbPrefix			= "thumb_"; //Normal thumb Prefix
	$DestinationDirectory	= '/home/ajax-image-upload/uploads/'; //specify upload directory ends with / (slash)
	$Quality 				= 90; //jpeg quality
	##########################################
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
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
   $db_file_name = rand(100000000000,999999999999).".".$fileExt;
   if($fileSize > 4048576){
	  header("location: ../message.php?msg=ERROR: Your image file was larger than 1mb");
		exit();   
   }
   else if(!preg_match("/\.(gif|jpg|png)$/i", $fileName)){
	   header("location: ../message.php?msg=ERROR: Your image file was not jpg, gif or png type");
		exit();
	} else if ($fileErrorMsg == 1) {
		header("location: ../message.php?msg=ERROR: An unknown error occurred");
		exit();
	}
	$sql = "SELECT dplink FROM users WHERE username='$log_username' LIMIT 1";
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
	include_once ("../Connection/image_resize.php");
	$target_file = "../Users/$log_username/$db_file_name";
	$resized_file = "../Users/$log_username/$db_file_name";
	$wmax = 200;
	$hmax = 300;
	img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
	$sql = "UPDATE users SET dplink='$db_file_name' WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	mysqli_close($con);
	echo '<img src="../Users/'.$log_username.'/'.$db_file_name.'" class="preview">';
	//header("location: ../users.php?u=$log_username");
	exit();
}

	}

	?>