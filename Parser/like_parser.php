<?php
include_once('../Connection/check_logged_user.php');
include_once('../Test/test_file.php');
if(isset($_POST['name']) && isset($_POST['action']) && isset($_POST['category'])){
    $name = preg_replace("#[^a-z0-9]#i","",$_POST['name']);
	$action = preg_replace("#[^a-z0-9]#i","",$_POST['action']);
	$category = preg_replace("#[^a-z0-9]#i","",$_POST['category']);
	$id = get_rand_id(16);
	$upload_dir = "../likes/";
	if(!file_exists("$upload_dir/$id")){
			mkdir("$upload_dir/$id", 0755, TRUE);
			}
			$sql = "INSERT INTO likes (name,type,category,name_id,creator,created) VALUES ('$name','$action','$category','$id','$log_username',now())";
	$query = mysqli_query($con,$sql);
	echo 'insert_ok|'.$id;
	exit();
}
?>