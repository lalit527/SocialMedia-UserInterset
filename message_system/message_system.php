<?php
// Protect this script from direct url access
include_once("../Connection/check_logged_user.php");
include_once("../Test/encode.php");
$cl = new encode();
if($user_ok != true || $log_username == "") {
	exit();
}
?><?php
// New PM
if (isset($_POST['action']) && $_POST['action'] == "new_message"){
	// Make sure post data is not empty
	$d1 = "";
	if(strlen($_POST['data']) < 1){
		mysqli_close($con);
	    echo "data_empty";
	    exit();
	}
	// Make sure post data is not empty
	
	// Clean all of the $_POST vars that will interact with the database
	$user = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$fuser = preg_replace('#[^a-z0-9]#i', '', $_POST['fuser']);
	
	$data = htmlentities($_POST['data']);
	for($i=0;$i<strlen($data);$i++){
	//echo $d[$i];
	$d1 .= $cl->encodeData($data[$i]);
	
}

	$data = mysqli_real_escape_string($con, $d1);
	
	
	
	// Make sure account name exists (the profile being posted on)
	$sql = "SELECT COUNT(id) FROM users WHERE username='$user' AND activated='1' LIMIT 1";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_row($query);
	if($row[0] < 1){
		mysqli_close($con);
		echo "$account_no_exist";
		exit();
	}
	//No message to yourself
	if ($log_username == $fuser){
		echo "cannot_message_self";
		exit();
	}
	// Insert the status post into the database now
	$defaultP = "x";
	$sql = "INSERT INTO message(receiver, sender, senttime, message, parent,sread) VALUES('$fuser','$user',now(),'$d1','$defaultP','1')";
	$query = mysqli_query($con, $sql);
	mysqli_close($con);
	echo "pm_sent";
	exit();
}
?><?php
// Reply To PM
if (isset($_POST['action']) && $_POST['action'] == "pm_reply"){
	// Make sure data is not empty
	if(strlen($_POST['data']) < 1){
		mysqli_close($db_conx);
	    echo "data_empty";
	    exit();
	}
	// Clean the posted variables
	$osid = preg_replace('#[^0-9]#', '', $_POST['pmid']);
	$account_name = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$osender = preg_replace('#[^a-z0-9]#i', '', $_POST['osender']);
	$data = htmlentities($_POST['data']);
	$data = mysqli_real_escape_string($con, $data);
	// Make sure account name exists (the profile being posted on)
	$sql = "SELECT COUNT(id) FROM users WHERE username='$account_name' AND activated='1' LIMIT 1";
	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_row($query);
	if($row[0] < 1){
		mysqli_close($con);
		echo "account_no_exist";
		exit();
	}
	// Insert the pm reply post into the database now
	$x = "x";
	$sql = "INSERT INTO pvtmsg(receiver, sender, senttime, subject, message, parent)
	        VALUES('$x','$account_name',now(),'$x','$data','$osid')";
	$query = mysqli_query($con, $sql);	
	$id = mysqli_insert_id($con);
	
	if ($log_username != $osender){
		$query2 = mysqli_query($con, "UPDATE pvtmsg SET hasreplies='1', rread='1', sread='0' WHERE id='$osid' LIMIT 1");
	} else {
		$query2 = mysqli_query($con, "UPDATE pvtmsg SET hasreplies='1', rread='0', sread='1' WHERE id='$osid' LIMIT 1");
	}
	mysqli_close($con);
	echo "reply_ok|$id";
	exit();
}
?><?php
// Delete PM
if (isset($_POST['action']) && $_POST['action'] == "delete_pm"){
	if(!isset($_POST['pmid']) || $_POST['pmid'] == ""){
		mysqli_close($con);
		echo "id_missing";
		exit();
	}
	$pmid = preg_replace('#[^0-9]#', '', $_POST['pmid']);
	if(!isset($_POST['originator']) || $_POST['originator'] == ""){
		mysqli_close($con);
		echo "originator_missing";
		exit();
	}
	$originator = preg_replace('#[^a-z0-9]#i', '', $_POST['originator']);
	// see who is deleting
	if ($originator == $log_username) {
		$updatedelete = mysqli_query($db_conx, "UPDATE pvtmsg SET sdelete='1' WHERE id='$pmid' LIMIT 1");
		}
	if ($originator != $log_username) {
		$updatedelete = mysqli_query($db_conx, "UPDATE pvtmsg SET rdelete='1' WHERE id='$pmid' LIMIT 1");
		}
	mysqli_close($db_conx);
	echo "delete_ok";
	exit();
}
?><?php
// Mark As Read
if (isset($_POST['action']) && $_POST['action'] == "mark_as_read"){
	if(!isset($_POST['pmid']) || $_POST['pmid'] == ""){
		mysqli_close($con);
		echo "id_missing";
		exit();
	}
	$pmid = preg_replace('#[^0-9]#', '', $_POST['pmid']);
	if(!isset($_POST['originator']) || $_POST['originator'] == ""){
		mysqli_close($con);
		echo "originator_missing";
		exit();
	}
	$originator = preg_replace('#[^a-z0-9]#i', '', $_POST['originator']);
	// see who is marking as read
	if ($originator == $log_username) {
		$updatedelete = mysqli_query($db_conx, "UPDATE pvtmsg SET sread='1' WHERE id='$pmid' LIMIT 1");
		}
	if ($originator != $log_username) {
		$updatedelete = mysqli_query($db_conx, "UPDATE pvtmsg SET rread='1' WHERE id='$pmid' LIMIT 1");
		}
	mysqli_close($con);
	echo "read_ok";
	exit();
}
?><?php
     if(isset($_POST['action']) && $_POST['action'] == 'get_message'){
		 $u = preg_replace("#[^a-z0-9]#i","",$_POST['user']);
         $f = preg_replace("#[^a-z0-9]#i","",$_POST['fuser']);
		 $result = "";		 
		 
		 $sql = "SELECT id,message,receiver,sender FROM message WHERE (receiver='$f' AND sender='$u') OR (receiver='$u' AND sender='$f')";
		 $query = mysqli_query($con,$sql);
		 $num_rows = mysqli_num_rows($query);
		 if($num_rows > 0){
			 $hasConvertation = true;
			 $sql_frnd = "SELECT dplink FROM users WHERE username='$f'";
			 $query_frnd = mysqli_query($con,$sql_frnd);
			 $result_frnd = mysqli_fetch_row($query_frnd);
	         $result_frnd = $result_frnd[0];
           	 $friend_pic = 'Users/'.$f.'/'.$result_frnd.'';
	         $sql_usr = "SELECT dplink FROM users WHERE username='$u'";
			 $query_usr = mysqli_query($con,$sql_usr);
			 $result_usr = mysqli_fetch_row($query_usr);
	         $result_usr = $result_usr[0];
           	 $usr_pic = 'Users/'.$u.'/'.$result_usr.'';
	  
			 while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
				 $d2 = "";
				 $id = $row['id'];
				 $message = $row['message'];
				 $sender = $row['sender'];
				 $reciver = $row['receiver'];
				 $d = "".$message;
				 for($i=0;$i<strlen($d);$i++){
	//echo $d[$i];
	                 $d2 .= $cl->encodeData($d[$i]);
	
                 }

				 
				 if($sender == $f){
					$result .= '<div id="rsltMain" style="text-align:left;margin-left:10px;"  onmouseover="showDel(\'dlt_'.$id.'\')" onmouseout="hideDel(\'dlt_'.$id.'\')"><p><img src="'.$friend_pic.'" class="friendpics" style="border:#000 1px solid; width:50px; height:50px; margin:2px;">'.$d2.'<a href="#" onclick="return false;" onmousedown="deleteMsg(\''.$id.'\',received)" style="display:none;" id="dlt_'.$id.'">delete</a></p></div>'; 
				 }if($sender == $u){
					$result .= '<div id="rsltMain" style="text-align:right;margin-right:10px;" onmouseover="showDel(\'dlt_'.$id.'\')" onmouseout="hideDel(\'dlt_'.$id.'\')"><p><a id="dlt_'.$id.'" href="#" onclick="return false;" onmousedown="deleteMsg(\''.$id.'\',send)" style="display:none;">delete</a>'.$d2.'<img class="friendpics" src="'.$usr_pic.'" style="border:#000 1px solid; width:50px; height:50px; margin:2px;"></p></div><br />'; 
				 }
				 
			 }
		 }
		 echo $result;
		 exit();
	 }


?><?php 
   if(isset($_POST['action']) && $_POST['action'] == 'readall'){
	   $friendsHTML = "";
	   $sql = "SELECT sender,receiver FROM message WHERE sender='$log_username' OR receiver='$log_username'";
	   $query = mysqli_query($con,$sql);
	   $num_row = mysqli_num_rows($query);
	   $friends = array();
	   if($num_row > 0){
		   while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
			   $sender = $row['sender'];
			   $receiver = $row['receiver'];
			   array_push($friends,$sender);
		       array_push($friends,$receiver);
		   }
		   
	   }
	   foreach (array_keys($friends, $log_username) as $key) {
    unset($friends[$key]);
        }
		if(sizeof($friends) == 0){
		echo '<p><strong style="color:#f00;">Sorry You have no messages</strong></p>';
		exit();
	}
else{	
$orLogic = "";
	foreach($friends as $key => $user){
		    $orLogic .= "username='$user' OR ";
	}
	$orLogic = chop($orLogic, "OR ");
		$sql = "SELECT firstname,lastname,dplink,username FROM users WHERE $orLogic";
	$query = mysqli_query($con,$sql);
	$num = mysqli_num_rows($query);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$friend_fname = $row["firstname"];
		$friend_username = $row["username"];
		$friend_lname = $row["lastname"];
		$friend_avatar = $row["dplink"];
		if($friend_avatar != ""){
			$friend_pic = 'Users/'.$friend_username.'/'.$friend_avatar.'';
		} else {
			$friend_pic = 'Images/dp_male1.jpg';
		}
		//$friendsHTML .= '<a href="users.php?u='.$friend_username.'"><img class="friendpics" src="'.$friend_pic.'" alt="'.$friend_username.'" title="'.$friend_username.'"></a>';
		$friendsHTML .= '<div id="message_wrap" onclick="getIt(\''.$friend_username.'\',\''.$log_username.'\')"><img class="friendpics" src="'.$friend_pic.'" alt="'.$friend_username.'" title="'.$friend_username.'" style="border:#000 1px solid; width:50px; height:50px; margin:2px;"  >'.$friend_fname.' '.$friend_lname.'  '.'@'.$friend_username.'</div>';
	}

	echo "hello|".$friendsHTML;
	exit();
}
	if($num_row < 1){
	echo 'sorry';
	
   }
   }

?>

