<?php
include_once("../Connection/check_logged_user.php");
include_once("../Connection/connect.php");
if(isset($_POST['name'])){
	$name = preg_replace('#[^a-z0-9_]#i','',$_POST['name']);
	$sql = "INSERT INTO photo_album(username,album,photoname,available,date) VALUES ('$log_username','$name','','1',now())";
	
	$query = mysqli_query($con,$sql);
	$album_form = '<div id="albm_photo" style="width:200px;height:200px;background:#006;">';
	$album_form = '<a href="#" onmousedown="showOption(\'profile_form\')" 
	onclick="return false">Add new photos</a>';
	$album_form .= '<form id="profile_form" enctype="multipart/form-data" action="Parser/photo_system.php" method="post" onSubmit="return false">';
	$album_form .= '<h4>Upload your photos</h4>';
	$album_form .= '<input type="file" name="profile" id="profile" required multiple>';  
	$album_form .= '<input type="submit" name="post">';
	$album_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$album_form .= '</form>';	
	$album_form .= '</div>';
	echo 'created_ok|'.$album_form;
}
?>