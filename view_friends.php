<?php
include_once ("Connection/check_logged_user.php");
if($log_username == "" || $user_ok != true){
	exit();
}
?><?php
$sql = "SELECT user1 FROM friends WHERE user2='$log_username' AND accepted='1'";
$query = mysqli_query($con,$sql);
$friends = array();
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	array_push($friends, $row["user1"]);
}
$sql = "SELECT user2 FROM friends WHERE user1='$log_username' AND accepted='1'";
$query = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	array_push($friends, $row["user2"]);
}
$or = "";
for($friends as $key => $user){
$or .= "$username='$user' OR ";
	
}
?>