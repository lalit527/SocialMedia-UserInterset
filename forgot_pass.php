<?php
 include_once ("Connection/check_logged_user.php");
 if($user_ok == true){
	 header("location: users.php?u=".$_SESSION['username']);
	 exit();
 }
?>
<?php
 if(isset($_POST['e'])){
	 include_once("Connection/connect.php");
	 $e = mysqli_real_escape_string($con,$_POST['e']);
	 $sql = "SELECT id,username FROM users WHERE email='$e' AND activated='1' LIMIT 1";
	 $query = mysqli_query($con,$sql);
	 $userrow = mysqli_num_rows($query);
	 if($userrow > 0) {
		 while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$id = $row["id"];
			$u = $row["username"]; 
		 }
		 $emailcut = substr($e, 0, 4);
		 $randNum = rand(10000, 99999);
		 $tempPass = "$emailcut$randNum";
		 $hashTempPass = md5($tempPass);
		 $sql = "UPDATE useroptions SET temp_pass='$hashTempPass' WHERE username='$u' LIMIT 1";
		 $query = mysqli_query($con,$sql);
		 
		 
		 $to = $e;
		$from = 'lalit.slg007@gmail.com';
		$subject = 'ensemble Temporary Password';
		$message = '<h2>Hello '.$u.'</h2><p>This is an automated message from ensemble. If you did not recently initiate the Forgot Password process, please disregard this email.</p><p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password to anything you like.</p><p>After you click the link below your password to login will be:<br /><b>'.$tempPass.'</b></p><p><a href="localhost/View/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'">Click here now to apply the temporary password shown below to your account</a></p><p>If you do not click the link in this email, no changes will be made to your account. In order to set your login password to the temporary password you must click the link above.</p>';

	    $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
	
		if (mail($to, $subject, $message, $headers)) {
		echo "success";
		exit();
		}
		else {
		  echo "email_send_failed";	
		  exit();
		}
		
		
		
				
	}
	else {
		 echo "no_exist";	
		}
		exit();

	 }
 
?>
<?php
include_once("Connection/connect.php"); 
if(isset($_GET['u']) && isset($_GET['p'])){
	
	$u = preg_replace('#[^a-z0-9]#i','',$_GET['u']);
	$temppasshash = preg_replace('#[^a-z0-9]#i','',$_GET['p']);
	/*if(strlen($temppasshash < 6)){
		exit();
	}*/
	echo 'hello';
	$sql = "SELECT id FROM useroptions WHERE username='$u' AND temp_pass='$temppasshash' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$numrows = mysqli_num_rows($query);
	if($numrows == 0) {
	header("location: message.php?=There is no match for the username with that temporary password in the sysytem.We cannot proceed.");
    exit();
    }
    else {
		$row = mysqli_fetch_row($query);
		$id = $row[0];
		$sql = "UPDATE users SET password='$temppasshash' WHERE id='$id' AND username='$u' LIMIT 1";
		$query = mysqli_query($con,$sql);
		header("location: login.php");
		exit();
	}

}
?>
<!Doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Forgot Password</title>
<link href="CSS/login_style.css" rel="stylesheet" type="text/css">
</head>
<style>
#pageMiddle_fp {
	height:500px;
}
#forgotpass_form {
   margin-top:30px;
   	
}
#forgotpass_form > div {
	margin-top:20px;
	
		
}
#forgotpass_btn {
   font-size:15px;
   padding:10px;	
}
</style>
<script src="JavaScript/script.js" type="text/javascript"> </script>
<script src="JavaScript/ajax.js" type="text/javascript"> </script>
<script>
function forgotPass() {
	var e = _("mail1").value;
	if(e == "") {
		_("status").innerHTML = "Type in your email address";
	}
	else {
		_("forgotpass_btn").style.display = "none";
		_("status").innerHTML = "please wait..";
		var ajax = ajaxObj("Post","forgot_pass.php");
		ajax.onreadystatechange = function() {
		       if(ajaxReturn(ajax) == true) {
				  var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
				 
				  if(response == "success") {
					_("forgotpass_form").innerHTML = '<h3>Step 2. Check your email inbox in a few minutes</h3>';
				  }
					else if(response == "no_exist") {
					 _("status").innerHTML = "sorry the mail address is not in our system";       	
						
					}
					else if(response == "email_send_failed") {
					 _("status").innerHTML = "Mail function failed to execute";
						
					}
					else {
					    _("status").innerHTML = "An unknown error has occured";	
					}
				  }
			   }
			   
			ajax.send("e="+e);   
		}
	
	
}

</script>
<body>
<?php include_once ("Template/pagetop_login.php"); ?>

<div id="pageMiddle_fp">
<h3>Generate a temporary log in password</h3>
<form id="forgotpass_form" onsubmit="return false;">
<fieldset id="fpf">
<div>Step 1:Enter Your Email Address</div>
<input id="mail1" type="email" onfocus="emptyElement('status');" maxlength="77" required autofocus placeholder="Your Email"/>
<br /><br />



<button id="forgotpass_btn" type="button" onclick="forgotPass()">Generate Temporary Log In Password</button>
<p id="status">pppppppp</p>
</fieldset>
</form>
</div>
<?php include_once ("Template/pagebottom_login.php"); ?>

</body>
</html>