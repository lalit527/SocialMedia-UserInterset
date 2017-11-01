<?php
$u = "";
$t = "";
$friendsHTML = "";
$friend_username = "";
$friend_pic = "";
include_once ("../../Connection/check_logged_user.php");
$timeoutseconds = 300;
$timestamp = time();
$timeout = $timestamp - $timeoutseconds;
$ip = preg_replace('#[^0-9.]#','',getenv('REMOTE_ADDR'));
$sql = "INSERT INTO useronline (timestamp,username,ip) VALUES ('$timestamp','$log_username','$ip') ON DUPLICATE KEY UPDATE timestamp='$timestamp'";
$query = mysqli_query($con,$sql);
$sql = "DELETE FROM useronline WHERE timestamp<$timeout";
$query = mysqli_query($con,$sql);
$sql = "SELECT username FROM useronline";
$query = mysqli_query($con,$sql);
$num_row = mysqli_num_rows($query);
$friends = array();
while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$u = $row['username'];
	//array_push($friends,$row['username']);
	$friend_check = "SELECT user1,user2 FROM friends WHERE user1='$log_username' AND user2='$u' AND accepted='1' OR user1='$u' AND user2='$log_username' AND accepted='1' LIMIT 1";
	$query_chk = mysqli_query($con,$friend_check);
	$row = mysqli_num_rows($query_chk);
	while($row_frnd = mysqli_fetch_array($query_chk,MYSQLI_ASSOC)){
		$user1 = $row_frnd['user1'];
		$user2 = $row_frnd['user2'];
		
		array_push($friends,$user1);
		array_push($friends,$user2);
	}
	
}

foreach (array_keys($friends, $log_username) as $key) {
    unset($friends[$key]);
}
if(sizeof($friends) == 0){
		echo '<p><strong style="color:#f00;">Sorry none of your friends are online</strong></p>';
		exit();
	}
else{	
$orLogic = "";
	foreach($friends as $key => $user){
		    $orLogic .= "username='$user' OR ";
	}
	$orLogic = chop($orLogic, "OR ");
		$sql = "SELECT username,dplink FROM users WHERE $orLogic";
	$query = mysqli_query($con,$sql);
	$num = mysqli_num_rows($query);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$friend_username = $row["username"];
		$friend_avatar = $row["dplink"];
		if($friend_avatar != ""){
			$friend_pic = '../../Users/'.$friend_username.'/'.$friend_avatar.'';
		} else {
			$friend_pic = '../../Images/dp_male1.jpg';
		}
		//$friendsHTML .= '<a href="users.php?u='.$friend_username.'"><img class="friendpics" src="'.$friend_pic.'" alt="'.$friend_username.'" title="'.$friend_username.'"></a>';
		$friendsHTML .= '<div id="chat_wrap" onclick="fun(\''.$friend_username.'\',\''.$log_username.'\')"><img class="friendpics" src="'.$friend_pic.'" alt="'.$friend_username.'" title="'.$friend_username.'" style="border:#000 1px solid; width:30px; height:30px; margin:2px;"  ><div id="f_name">'.$friend_username.'</div></div>';
	}

	echo $friendsHTML;
}
	if($num_row < 1){
	echo 'sorry';
	
}
 

?>
