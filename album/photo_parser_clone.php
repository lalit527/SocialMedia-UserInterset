<?php
include_once('../Connection/check_logged_user.php');
include_once ("../Test/test_file.php");

if(isset($_FILES['file'])){
	echo 'hello';
    $name_array = $_FILES['file']['name'];
    $tmp_name_array = $_FILES['file']['tmp_name'];
    $type_array = $_FILES['file']['type'];
    $size_array = $_FILES['file']['size'];
    $error_array = $_FILES['file']['error'];
     $extension = explode(".",$name_array);
   $fileExt = end($extension);
   
   
   if(!preg_match("/\.(mp4|avi|ogg|mkv)$/i", $name_array)){
	   header("location: ../message.php?msg=ERROR: not a video");
		exit();
	}else if ($error_array == 1) {
		header("location: ../message.php?msg=ERROR: An unknown error occurred");
		exit();
	} 
	    $dir = "../Users/".$log_username."/video";
	    $db_file_name = get_rand_id(11).".mkv";
   $folder = get_rand_id(11);
  if(!file_exists("$dir/$folder")){
			mkdir("$dir/$folder", 0755, TRUE);
			}
			     $src = 'Users/'.$log_username.'/video/'.$folder.'/'.$db_file_name;
        if(move_uploaded_file($tmp_name_array, "../Users/".$log_username."/video/".$folder."/".$db_file_name)){
			$sql = "INSERT INTO status (account_name,author,type,data,note,result,postdate) VALUES ('$log_username','$log_username','e','$folder','','$folder',now())";
			$query = mysqli_query($con,$sql);
			$id = mysqli_insert_id($con);
			$sql = "UPDATE status SET osid='$id' WHERE id='$id' LIMIT 1";
	$query = mysqli_query($con, $sql);
	
			$sql = "INSERT INTO media (username,file,src,type,posted) VALUES ('$log_username','$folder','$src','a',now())";
			$query = mysqli_query($con,$sql);
			
            echo " upload is complete<br>";
			//echo jason_encode($tmp_name_array);
        } else {
            echo "move_uploaded_file function failed for <br>";
        }
    
}else {
	echo 'fuck';
}
?>
