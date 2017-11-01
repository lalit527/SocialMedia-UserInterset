<?php
include_once ("../Connection/check_logged_user.php");
if($user_ok != true || $log_username == ""){
	exit();
}
?>
<?php
if(isset($_POST['type']) && isset($_POST['blockee'])){
$blockee = preg_replace('#[^a-z0-9]#i','',$_POST['blockee']);
$sql = "SELECT COUNT(id) FROM users WHERE username='$blockee' AND activated='1' LIMIT 1";
$query = mysqli_query($con,$sql);
$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
		mysqli_close($con);
		echo "does not exist".$blockee;
		exit();		
	}
if($_POST['type'] == "block"){
	$sql = "SELECT id FROM blockedusers WHERE blocker='$log_username' AND blockee='$blockee' LIMIT 1";
$query = mysqli_query($con,$sql);
$blockedBy = mysqli_num_rows($query);
if($blockedBy[0] > 0){
  mysqli_close($con);	
  echo "You have already blocked the member";
  exit();	 
}
else {
 $sql = "SELECT id FROM friends WHERE user1='$log_username' AND user2='$blockee' OR user1='$blockee' AND user2='$log_username' LIMIT 1";
 $query = mysqli_query($con,$sql);
 $numrow = mysqli_num_rows($query);
 if($numrow > 0){
	 $sql = "DELETE FROM friends WHERE user1='$log_username' AND user2='$blockee' OR user1='$blockee' AND user2='$log_username' LIMIT 1";
	 $query = mysqli_query($con,$sql);
 }
 $sql = "INSERT INTO blockedusers (blocker,blockee,blockdate) VALUES ('$log_username','$blockee',now())";
 $query = mysqli_query($con,$sql);
 mysqli_close($con);
 echo "blocked_ok";	
 exit();
}
}
else if($_POST['type'] == "unblock"){
	$sql = "SELECT id FROM blockedusers WHERE blocker='$log_username' AND blockee='$blockee' LIMIT 1";
$query = mysqli_query($con,$sql);
$blockedBy = mysqli_fetch_row($query);
	if($blockedBy == ""){
		echo "You have not blocked the user";
		exit();
		
	}
	else {
	   $sql = "DELETE FROM blockedusers WHERE blocker='$log_username' AND blockee='$blockee' LIMIT 1";
	   $query = mysqli_query($con,$sql);
	   mysqli_close($con);
	   echo "unblock_ok";
	   exit();	
	}
	
}

}
?>