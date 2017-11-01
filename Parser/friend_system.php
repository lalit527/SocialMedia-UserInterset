<?php
include_once ("../Connection/check_logged_user.php");
if($user_ok != true || $log_username == ""){
	exit();
}
?>
<?php

if(isset($_POST['type']) && isset($_POST['user'])){
	
	$user = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$sql = "SELECT COUNT(id) FROM users WHERE username='$user' AND activated='1' LIMIT 1";
    $query = mysqli_query($con,$sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
		mysqli_close($con);
		echo "$user does not exist";
		exit();		
	}
	if($_POST['type'] == "friend"){
		$sql = "SELECT COUNT(id) FROM friends WHERE user1='$user' AND accepted='1' OR user2='$user' AND accepted='1'";
		$query = mysqli_query($con,$sql);
		$friend_count = mysqli_fetch_row($query);
		$sql = "SELECT COUNT(id) FROM blockedusers WHERE blocker='$user' AND blockee='$log_username' LIMIT 1";
		$query = mysqli_query($con,$sql);
		$blockCount1 = mysqli_fetch_row($query);
		$sql = "SELECT COUNT(id) FROM blockedusers WHERE blocker='$log_username' AND blockee='$user' LIMIT 1";
		$query = mysqli_query($con,$sql);
		$blockCount2 = mysqli_fetch_row($query);
		$sql = "SELECT COUNT(id) FROM friends WHERE user1='$log_username' AND user2='$user' AND accepted='1' LIMIT 1";
		$query = mysqli_query($con,$sql);
		$row_count1 = mysqli_fetch_row($query);
		$sql = "SELECT COUNT(id) FROM friends WHERE user1='$user' AND user2='$log_username' AND accepted='1' LIMIT 1";
		$query = mysqli_query($con,$sql);
		$row_count2 = mysqli_fetch_row($query);
		$sql = "SELECT COUNT(id) FROM friends WHERE user1='$log_username' AND user2='$user' AND accepted='0' LIMIT 1";
		$query = mysqli_query($con,$sql);
		$row_count3 = mysqli_fetch_row($query);
		$sql = "SELECT COUNT(id) FROM friends WHERE user1='$user' AND user2='$log_username' AND accepted='0' LIMIT 1";
		$query = mysqli_query($con,$sql);
		$row_count4 = mysqli_fetch_row($query);
		if($friend_count[0] > 4999){
           mysqli_close($con);
		   echo "$user currently has the maximum number of friends";
		   exit();			
		}
		else if($blockCount1[0] > 0){
		   mysqli_close($con);
		   echo "$user has blocked you";
		   exit();		
		}
		else if($blockCount2[0] > 0){
		   mysqli_close($con);
		   echo "You must first unblock $user to send the request";
		   exit();		
		}
		else if($row_count1[0] > 0 || $row_count2[0] > 0){
           mysqli_close($con);
		   echo "You are already friend with $user";
		   exit();			
		}
		else if($row_count3[0] > 0){
			mysqli_close($con);
		   echo "You have a pending friend request to $user";
		   exit();		
		}
		else if($row_count4[0] > 0){
			mysqli_close($con);
		   echo "$user already has send you friend request";
		   exit();		
		}
		else {
			$sql = "INSERT INTO friends(user1,user2,datemade) VALUES ('$log_username','$user',now())";
			$query = mysqli_query($con,$sql);
			mysqli_close($con);
			echo "friend_request_sent";
			exit();
		}
		
	}
	    else if($_POST['type'] == "unfriend"){
			$sql = "SELECT COUNT(id) FROM friends WHERE user1='$log_username' AND user2='$user' AND accepted='1' LIMIT 1";
			$query = mysqli_query($con,$sql);
			$row_count1 = mysqli_fetch_row($query);
			$sql = "SELECT COUNT(id) FROM friends WHERE user1='$user' AND user2='$log_username' AND accepted='1' LIMIT 1";
			$query = mysqli_query($con,$sql);
			$row_count2 = mysqli_fetch_row($query);
			if($row_count1[0] > 0){
				$sql = "DELETE FROM friends WHERE user1='$log_username' AND user2='$user' AND accepted='1' LIMIT 1";
				$query = mysqli_query($con,$sql);
				mysqli_close($con);
				echo "unfriend_ok";
				exit();
			}
			else if($row_count2[0] > 0){
				$sql = "DELETE FROM friends WHERE user1='$user' AND user2='$log_username' AND accepted='1' LIMIT 1";
				$query = mysqli_query($con,$sql);
				mysqli_close($con);
				echo "unfriend_ok";
				exit();
			}
			else{
			   mysqli_close($con);
			   echo "No friendship could be found between your account and $user account,therefore we cannot unfriend you.";
			   exit();	
			}
		}
}

?>
<?php
if (isset($_POST['action']) && isset($_POST['reqid']) && isset($_POST['user1'])) {
	$reqid = preg_replace('#[^0-9]#','',$_POST['reqid']);
	$user = preg_replace('#[^a-z0-9]#i','',$_POST['user1']);
	$sql = "SELECT COUNT(id) FROM users WHERE username='$user' AND activated='1' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$exist_count = mysqli_fetch_row($query);
	if($exist_count[0] < 1){
             mysqli_close($con);
			 echo "$user does not exist";
			 exit();		
	}
	if($_POST['action'] == "accept"){
       $sql = "SELECT COUNT(id) FROM friends WHERE user1='$log_username' AND user2='$user' AND accepted='1' LIMIT 1";
	   $query = mysqli_query($con,$sql);
	   $row_count1 = mysqli_fetch_row($query);
	   $sql = "SELECT COUNT(id) FROM friends WHERE user1='$user' AND user2='$log_username' AND accepted='1' LIMIT 1";		
	   $query = mysqli_query($con,$sql);
	   $row_count2 = mysqli_fetch_row($query);
	   if($row_count1[0] > 0 || $row_count2[0] > 0){
		  mysqli_close($con);
		  echo "You are already friend with $user";
		  exit(); 
	   }
	   else {
		$sql = "UPDATE friends SET accepted='1' WHERE id='$reqid' AND user1='$user' AND user2='$log_username' LIMIT 1";
		$query = mysqli_query($con,$sql);
		mysqli_close($con);
		echo "accept_success";
		exit();   
	   }
	}
	else if($_POST['type'] == "reject"){
      $sql = "DELETE FROM friends WHERE id='$reqid' AND user1='$user' AND user2='$log_username' LIMIT 1";
	  $query = mysqli_query($con,$sql);
	  mysqli_close($con);
	  echo "reject_done";
	  exit();		
	}
}
?>
 