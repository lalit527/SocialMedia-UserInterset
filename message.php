<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i','',$_GET['msg']);
if ($msg == "activation_failed") {
   $message = '<h2> Actvation Faliure </h2> Sorry there seems to have been an issue activating your account at this time. We have already registered this issue and we will contact you via email when the problem is solved.';  	
}
  else if ($msg == "activation_success") {
     $message = '<h2> Activation Success </h2> Your account is now activated.
	 <a href="login.php">Click here to login</a>';	  
  }
  else {
	$message = $msg;  
  }
if($msg == "no"){
	
}
  
?>
<div><?php echo $message; ?></div>
