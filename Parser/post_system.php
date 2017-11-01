<?php
include_once("../Connection/check_logged_user.php");
if($user_ok != true || $log_username == ""){
	exit();
}
?><?php
if(isset($_POST['action']) && $_POST['action'] == "status_post"){
	if(strlen($_POST['data']) < 1){
		mysqli_close($con);
		echo "data_empty";
		exit();
	}
	$type = preg_replace('#[^a-z]#','',$_POST['type']);
	/*if($type != "a" || $type != "c"){
		mysqli_close($con);
		echo "type_unknown".$type;
		exit();
	}*/
	//$type = preg_replace('#[^a-z]#', '', $_POST['type']);
	$account_name = preg_replace('#[^a-z 0-9]#i', '', $_POST['user']);
	$data = htmlentities($_POST['data']);
	$data = mysqli_escape_string($con, $data);
	$sql = "SELECT COUNT(id) FROM users WHERE username='$account_name' AND activated='1' LIMIT 1";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_row($query);
	if($row[0] < 1){
	   mysqli_close($con);
	   echo "account_no_exists";
	   exit();	
	}
	$sql = "INSERT INTO status(account_name, author, type, data, postdate) VALUES ('$account_name','$log_username','$type','$data',now())";
	$query = mysqli_query($con, $sql);
	$id = mysqli_insert_id($con);
	$sql = "UPDATE status SET osid='$id' WHERE id='$id' LIMIT 1";
	$query = mysqli_query($con, $sql);
	 
	$friends = array();
	$sql = "SELECT user1 FROM friends WHERE user2='$log_username' AND accepted='1'";
	$query = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		array_push($friends, $row["user1"]);
	}
	$sql = "SELECT user2 FROM friends WHERE user1='$log_username' AND accepted='1'";
	$query = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		array_push($friends, $row["user2"]);
	}
	for($i=0; $i < count($friends); $i++){
		$friend = $friends[$i];
		$app = "Status";
		$note = ' posted on: <br /><a href="users.php?u='.$account_name.'#status_'.$id.'">'.$account_name.'&#39;s Profile</a>';
        $sql = "INSERT INTO notifications(username, initiator, app, note, date_time) VALUES('$friend','$log_username','$app','$note',now())";	
		$query = mysqli_query($con, $sql);
	}
	mysqli_close($con);
	echo "post_ok|".$id;
	exit();
}

?><?php
if(isset($_POST['action']) && $_POST['action'] == "status_reply"){
	if(strlen($_POST['data']) < 1){
		mysqli_close($con);
		echo "data_empty";
		exit();
	}
		$osid = preg_replace('#[^0-9]#', '', $_POST['sid']);
	$account_name = preg_replace('#[^a-z 0-9]#i', '', $_POST['user']);
	$data = htmlentities($_POST['data']);
	$data = mysqli_escape_string($con, $data);
	$sql = "SELECT COUNT(id) FROM users WHERE username='$account_name' AND activated='1' LIMIT 1";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_row($query);
	if($row[0] < 1){
	   mysqli_close($con);
	   echo "$account_no_exists";
	   exit();	
	}
	$sql = "INSERT INTO status(osid, account_name, author, type, data, postdate) VALUES ('$osid', '$account_name','$log_username','b','$data',now())";
	$query = mysqli_query($con, $sql);
	$id = mysqli_insert_id($con);
	$sql = "SELECT author FROM status WHERE osid='$osid' AND author <> '$log_username' GROUP BY author";
	$query = mysqli_query($con,$sql);
	$row_num = mysqli_num_rows($query);
	$result = mysqli_fetch_row($query);
	$r = $result[0];
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$participant = $row['author'];
		$app = "Status_reply";
		$note = ' commented here:<br /><a href="users.php?u='.$account_name.'#status_'.$osid.'">Click here to view the conversation</a>';
		$sql = "INSERT INTO notifications(username, initiator, app, note, date_time) 
		             VALUES('$participant','$log_username','$app','$note',now())";
		$query =  mysqli_query($con, $sql);
		
	}
	mysqli_close($con);
	echo "reply_ok|".$id;
	exit();
}

?><?php
if(isset($_POST['action']) && $_POST['action'] == "delete_status") {
	if(!isset($_POST['statusid']) || $_POST['statusid'] == ""){
       mysqli_close($con);
	   echo "status id id missing";
	   exit();		
	}
	$statusid = preg_replace('#[^0-9]#','',$_POST['statusid']);
	$sql = "SELECT account_name,author FROM status WHERE id='$statusid' LIMIT 1";
	$query = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$account_name = $row["account_name"];
		$author = $row["author"];
	}
	if($account_name == $log_username || $author == $log_username){
		$sql = "DELETE FROM status WHERE osid='$statusid'";
		$query = mysqli_query($con,$sql);
		mysqli_close($con);
		echo "delete_ok";
		exit();
	}
}
?><?php
if(isset($_POST['action']) && $_POST['action'] == "delete_reply"){
	if(!isset($_POST['replyid']) || $_POST['replyid'] == ""){
       mysqli_close($con);
	   echo "reply id missing";
	   exit();		
	}
	$replyid = preg_replace('#[^0-9]#','',$_POST['replyid']);
	$sql = "SELECT osid,account_name,author FROM status WHERE id='$replyid'";
	$query = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$osid = $row["osid"];
		$account_name = $row["account_name"];
		$author = $row["author"];
	}
	if($account_name == $log_username || $author == $log_username){
		$sql = "DELETE FROM status WHERE id='$replyid'";
		$query = mysqli_query($con, $sql);
		mysqli_close($con);
		echo "delete_ok";
		exit();
	}
	
}

?>