<?php
if (isset($_GET['id']) && isset($_GET['u']) && isset($_GET['e']) && isset($_GET['p'])) {
   include_once ("Connection/connect.php");
   $id = preg_replace('#[^0-9]#i','',$_GET['id']);	
   $u = preg_replace('#[^a-b0-9]#i','',$_GET['u']);
   $e = mysqli_real_escape_string($_GET['e']);
   $p = mysqli_real_escape_string($_GET['p']);
   if($id == "" || strlen($u) < 3 || strlen($u) > 16 || $p == "") {
	
	header("location: message.php?msg=activation_string_length_issues");
    	exit();    
   }
   $sql = "SELECT * FROM users WHERE id='$id' and username='$u' and email='$e' and password='$p' LIMIT 1";
   $query = mysqli_query($con,$sql);
   $result = mysqli_num_rows($query);
   if ($result == 0) {
	   header("location: message.php?msg=Your credential doesn't meet to that of our system");
	   
   }
   else {
	$sql = "UPDATE users SET activated='1' WHERE id='$id' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$sql = "SELECT * FROM users WHERE id='$id' and activated='1' LIMIT 1";
	$query = mysqli_query($con,$query);
	$user_no = mysqli_num_rows($query);
	if ($user_no == 0) {
       	header("location: message.php?msg=activation_failure");
		exit();	
	}
	else if ($user_no == 1) {
	     header("location: message.php?msg=activation_success");
		 echo '<p><a href="users.php?u="'.$u.'>Explore Now</a></p>';
		 exit();	
	}
   }
   
}
 else {
	header("location: message.php?msg=missing_variables");
	exit();   
   }


?>
