<?php
include_once("../Connection/check_logged_user.php");

if(isset($_POST['action']) && $_POST['action'] == 'savework'){
	$w = preg_replace("#[^a-z0-9]#i","",$_POST['work']);
	$c = preg_replace("#[^a-z0-9]#i","",$_POST['clg']);
	$s = preg_replace("#[^a-z0-9]#i","",$_POST['scl']);
	$k = preg_replace("#[^a-z0-9]#i","",$_POST['skl']);
	$sql = "SELECT id FROM work_edu WHERE username='$log_username'";
	$query = mysqli_query($con,$sql);
	$num_row = mysqli_num_rows($query);
	if($num_row > 0){
		$sql = "UPDATE work_edu SET username='$log_username',school='$s',college='$c',work='$w',skills='$k' WHERE username='$log_username'";
	$query = mysqli_query($con,$sql);
		
		
	}else {
	$sql = "INSERT INTO work_edu (username,school,college,work,skills) VALUES ('$log_username','$s','$c','$w','$k')";
	$query = mysqli_query($con,$sql);
	}
	echo 'done';
}

?><?php
if(isset($_POST['action']) && $_POST['action'] == 'home'){
	
	$h = preg_replace("#[^a-z0-9]#i","",$_POST['home']);
	$sql = "SELECT id FROM places WHERE username='$log_username'";
	$query = mysqli_query($con,$sql);
	$num_row = mysqli_num_rows($query);
	if($num_row > 0){
		$sql = "UPDATE places SET home='$h' WHERE username='$log_username'";
	$query = mysqli_query($con,$sql);
		
		
	}else {
	$sql = "INSERT INTO places (username,home) VALUES ('$log_username','$h')";
	$query = mysqli_query($con,$sql);
	}
	echo 'done';
}



?><?php
if(isset($_POST['action']) && $_POST['action'] == 'current'){
	
	$c = preg_replace("#[^a-z0-9]#i","",$_POST['city']);
	$sql = "SELECT id FROM places WHERE username='$log_username'";
	$query = mysqli_query($con,$sql);
	$num_row = mysqli_num_rows($query);
	if($num_row > 0){
		$sql = "UPDATE places SET current='$c' WHERE username='$log_username'";
	$query = mysqli_query($con,$sql);
		
		
	}else {
	$sql = "INSERT INTO places (username,current) VALUES ('$log_username','$c')";
	$query = mysqli_query($con,$sql);
	}
	$sql = "INSERT INTO places_visited (username,places) VALUES ('$log_username','$c')";
	$query = mysqli_query($con,$sql);
	
	echo 'done';
}



?>