<?php
include_once('../Connection/check_logged_user.php');
  if(isset($_POST['action']) && $_POST['action'] == 'like'){
	   $like = preg_replace("#[^a-z]#","",$_POST['action']);
	   $id = preg_replace("#[^a-z0-9]#i","",$_POST['id']);
	   $creator = preg_replace("#[^a-z0-9]#i","",$_POST['creator']);
	   $adm  = 0;
	   if($log_username == $creator){
		   $adm = 1;
	   }
	   $sql = "INSERT INTO likesmembers (name_id,username,admin,joined) VALUES ('$id','$log_username','$adm',now())";
	   $query = mysqli_query($con,$sql);
	   echo 'liked';
   }


?><?php
//include_once('../Connection/check_logged_user.php');
  if(isset($_POST['action']) && $_POST['action'] == 'unlike'){
	   $like = preg_replace("#[^a-z]#","",$_POST['action']);
	   $id = preg_replace("#[^a-z0-9]#i","",$_POST['id']);
	   $creator = preg_replace("#[^a-z0-9]#i","",$_POST['creator']);
	   $adm  = 0;
	   if($log_username == $creator){
		   $adm = 1;
	   }
	   $sql = "DELETE FROM likesmembers WHERE name_id='$id' AND username='$log_username'";
	   $query = mysqli_query($con,$sql);
	   
	   echo 'unliked';
   }


?>