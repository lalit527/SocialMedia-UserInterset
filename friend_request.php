<?php
include_once ("Connection/check_logged_user.php");
if($user_ok != true || $log_username == ""){
    header("location: index.php");
	exit();	
}
$notification_list = "";
$sql = "SELECT * FROM notifications  WHERE username LIKE BINARY '$log_username' ORDER BY date_time DESC";
$query = mysqli_query($con,$sql);
$no_rows = mysqli_num_rows($query);
if($no_rows < 1){
   $notification_list = "You do not have any notification";	
}
else {
   	while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
          $noteid = $row['id'];
		  $initiator = $row['initiator'];
		  $app = $row['app'];
		  $note = $row['note'];
		  $date_time = $row['date_time'];
		  $date_time = strftime("%b %d %Y", strtotime($date_time));
		  $notification_list .= '<p><a href="users.php?u='.$initiator.'">'.$initiator.'</a> | '.$app.'<br />'.$note.'</p>';
		  		
	}
	
}
$sql = "UPDATE users SET notescheck=now() WHERE username='$log_username' LIMIT 1";
$query = mysqli_query($con,$sql);
?>
<?php
include_once ("Connection/check_logged_user.php");
include_once ("TimeStamp/time_ago.php");
$timeAgoObject = new convertToAgo;
$friend_requests = "";
$sql = "SELECT * FROM friends WHERE user2='$log_username' AND accepted='0' ORDER BY datemade DESC";
$query = mysqli_query($con,$sql);
$num_request = mysqli_num_rows($query);
if($num_request < 1){
	$friend_requests = "You do not have any friend requests";

	
}
else{
while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$id = $row['id'];
	$sender = $row['user1'];
	$user = $row['user2'];
	$datemade = $row['datemade'];
	//$datemade = strftime("%B %d %c",strtotime($datemade));
	
	$sql_dp = "SELECT dplink FROM users WHERE username='$sender'";
	$dp_query = mysqli_query($con,$sql_dp);
	$num_dp = mysqli_num_rows($dp_query);
	$row_dp = mysqli_fetch_row($dp_query);
	$user1_dp = $row_dp[0];
	$sender_pic = '<img src="Users/'.$sender.'/'.$user1_dp.'" alt="'.$user1_dp.'" class="user_pic">';
	/*if($user1_dp_pic == ""){
		$sender_pic = '<img src="Images/header.png"  class="user_pic">';
		
	}*/
	$convertedTime = ($timeAgoObject -> convert_dateTime($datemade));
	$when = ($timeAgoObject -> makeAgo($convertedTime));
	$friend_requests .= '<div id="friendreq_'.$id.'" class="friendrequests">';
		$friend_requests .= '<a href="users.php?u='.$sender.'">'.$sender_pic.'</a>';
		$friend_requests .= '<div class="user_info" id="user_info_'.$id.'">'.$when.' <a href="users.php?u='.$sender.'">'.$sender.'</a> requests friendship<br /><br />';
		$friend_requests .= '<button onclick="friendReqHandler(\'accept\',\''.$id.'\',\''.$sender.'\',\'user_info_'.$id.'\')">accept</button> or ';
		$friend_requests .= '<button onclick="friendReqHandler(\'reject\',\''.$id.'\',\''.$sender.'\',\'user_info_'.$id.'\')">reject</button>';
		$friend_requests .= '</div>';
		$friend_requests .= '</div>';
	}
}

?>
<!Doctype Html>
<html>
<head>
<title>Notifications and Friends Requests</title>
<style>
div#notesBox{
	float:left; 
	width:430px; 
	border:#F0F 1px dashed; 
	margin-right:60px; 
	padding:10px;
	}
div#friendReqBox{
	float:left;
    width:430px; 
	border:#F0F 1px dashed; 
	padding:10px;
	}
div.friendrequests{
	height:74px; 
	border-bottom:#CCC 1px solid; 
	margin-bottom:8px;
	}
img.user_pic{
	float:left; 
	width:68px; 
	height:68px; 
	margin-right:8px;
	}
div.user_info{
	float:left; 
	font-size:14px;
	}
</style>
<script src="JavaScript/script.js"></script>
<script src="JavaScript/ajax.js"></script>
<script type="text/javascript">
function friendReqHandler(action,reqid,user1,elem){
	var conf = confirm("Press OK to '"+action+"' this friend request.");
	if(conf != true){
		return false;
	}
	_(elem).innerHTML = "processing ...";
	var ajax = ajaxObj("POST", "Parser/friend_system.php");
	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			alert(""+ajax.responseText);
			if(ajax.responseText == "accept_ok"){
				_(elem).innerHTML = "<b>Request Accepted!</b><br />Your are now friends";
			} else if(ajax.responseText == "reject_ok"){
				_(elem).innerHTML = "<b>Request Rejected</b><br />You chose to reject friendship with this user";
			} else {
				_(elem).innerHTML = ajax.responseText;
			}
		}
	}
	ajax.send("action="+action+"&reqid="+reqid+"&user1="+user1);
}
</script>

</head>
<body>
<body>

<div id="pageMiddle">
  <!-- START Page Content -->
  <div id="friendReqBox"><h2>Friend Requests</h2><?php echo $friend_requests; ?></div>
  
  <!-- END Page Content -->
</div>

</body>

</html>