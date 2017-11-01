<?php
include_once("../Connection/connect.php");
if(isset($_POST['oname'])){
	$oname = preg_replace("#[^a-z0-9]#i","",$_POST['oname']);
    $fname = preg_replace("#[^a-z0-9]#i","",$_POST['fname']);	
	$sql = "INSERT INTO chatprsn (oname,fname) VALUES ('$oname','$fname')";
	$query = mysqli_query($con,$sql);
	$sql = "SELECT fname FROM chatprsn WHERE oname='$oname'";
	$query = mysqli_query($con,$sql);
	$num_row = mysqli_num_rows($query);
	$chat_frnd = array();
	if($num_row > 1){
		while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
			$getName = $row['fname'];
			array_push($chat_frnd,$getName);
		}
		
	}
	echo 'insert_ok';
}

?>