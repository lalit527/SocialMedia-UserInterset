<?php
include_once ("check_logged_user.php");
if($user_ok != true || $log_username == ""){
	exit();
}
?>
<?php
if(isset($_POST['lat']) && isset($_POST['lng']) && !isset($_POST['address'])){
	$lat = preg_replace('#[^0-9.]#','',$_POST['lat']);
	$lng = preg_replace('#[^0-9.]#','',$_POST['lng']);
	$lat_arr = explode('.',$lat);
	$lat_frst = $lat_arr[0];
	$lat_scnd = $lat_arr[1];
	$lat_scnd_sub = substr($lat_scnd,0,3);
	$arr_lat = array($lat_frst,$lat_scnd_sub);
	$lat_insrt = implode('.',$arr_lat);
	$lat_insrt_trm = rtrim($lat_insrt," ");
	
	$lng_arr = explode('.',$lng);
	$lng_frst = $lng_arr[0];
	$lng_scnd = $lng_arr[1];
	$lng_scnd_sub = substr($lng_scnd,0,3);
	$arr_lng = array($lng_frst,$lng_scnd_sub);
	$lng_insrt = implode('.',$arr_lng);
	$lng_insrt_trm = rtrim($lng_insrt," ");
	
	$sql = "SELECT address FROM geoloc WHERE latitude='$lat_insrt' AND longitude='$lng_insrt' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$num_rows = mysqli_fetch_row($query);
	if($num_rows < 1){
		echo 'not_found';
		exit();
	}
	$num_row = $num_rows[0];
	$sql = "UPDATE users SET lastloginfrom='$num_row' WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$sql = "UPDATE users SET lastlogin=now() WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	
	mysqli_close($con);
	echo 'found|'.$num_row;
	exit();
	
}

?><?php
if(isset($_POST['lat']) && isset($_POST['lng']) && isset($_POST['address'])){
	$lat = preg_replace('#[^0-9.]#','',$_POST['lat']);
	$lng = preg_replace('#[^0-9.]#','',$_POST['lng']);
	$address = preg_replace('#[^a-z0-9,.]#i','',$_POST['address']);
	$lat_arr = explode('.',$lat);
	$lat_frst = $lat_arr[0];
	$lat_scnd = $lat_arr[1];
	$lat_scnd_sub = substr($lat_scnd,0,3);
	$arr_lat = array($lat_frst,$lat_scnd_sub);
	$lat_insrt = implode('.',$arr_lat);
	$lat_insrt_trm = rtrim($lat_insrt," ");
	
	$lng_arr = explode('.',$lng);
	$lng_frst = $lng_arr[0];
	$lng_scnd = $lng_arr[1];
	$lng_scnd_sub = substr($lng_scnd,0,3);
	$arr_lng = array($lng_frst,$lng_scnd_sub);
	$lng_insrt = implode('.',$arr_lng);
	$lng_insrt_trm = rtrim($lng_insrt," ");
	$sql = "INSERT INTO geoloc (latitude,longitude,address,date_added) VALUES ('$lat_insrt_trm','$lng_insrt_trm','$address',now())";
	$query = mysqli_query($con,$sql);
	$sql = "UPDATE users SET lastloginfrom='$address' WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$sql = "UPDATE users SET lastlogin=now() WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	
	mysqli_close($con);
	echo 'insert_ok';
	
}

?>