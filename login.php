<?php
 include_once ("Connection/check_logged_user.php");
 if($user_ok == true) {
	header ("location: users.php?u=".$_SESSION['username']);
	exit(); 
 
 }
?>
<?php

class loc{
	
function geoCheckIP($ip){
	
		       $response = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			   
			   $country = $response->country;
			   $city = $response->city;
			   $detail = $city."(".$country.")";
			   //return $city;
			  // $sql = "UPDATE useroptions SET lastlog='$detail' WHERE username='$u' LIMIT 1";
	          //  $query = mysqli_query($con,$sql);
				return $detail;		          
		}
		
	
}

?>

<?php 
if (isset($_POST['e'])) {
	include_once ("Connection/connect.php");
	//include_once ("Parser/loc_parser.php");
	$e = mysqli_real_escape_string($con,$_POST['e']);
	$p_t = $_POST['p'];
	$p = md5($p_t);
	$ip_client = "".$_POST['ip'];
	$ip = preg_replace('#[^0-9.]#','',getenv('REMOTE_ADDR'));
    $count = $_POST['count'];
	$_SESSION['count'] = $count;
	if($e == "" || $p == "") {
		echo "fill up all the fields";
		exit();
	}
	else {
	   $sql = "SELECT id,username,password FROM users where	email='$e' AND activated='1' LIMIT 1";
       $query = mysqli_query($con,$sql);
	   $no_result = mysqli_num_rows($query);
	   if ($no_result == 0){
		  
		   
		  echo "login_failed";	
	      exit();
		   
	   }
	   else {
		   
	   $row = mysqli_fetch_row($query);
	   $db_id = $row[0];
	   $db_username = $row[1];
	   $db_password = $row[2];
	   if($db_password != $p) {
		   
		   if($_SESSION['count'] >= 2){
			  // header ("location: users.php?u=".$_SESSION['username']);
			   //exit();
			   $ip2 = trim($ip_client);
			   $get = new loc();
			  $details = $get->geoCheckIP($ip2);
			   $code = rand(1000,9999);
			   $sql = "UPDATE useroptions SET code_access='$code' WHERE username='$db_username' LIMIT 1";
			   $query = mysqli_query($con,$sql);

			   			   $to = $e;
		$from = 'lalit.slg007@gmail.com';
		$subject = 'ensemble account unauthorized access';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>ensemble Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://localhost/Views/activation.php"><img src="http://www.yoursitename.com/images/logo.png" width="36" height="30" alt="yoursitename" style="border:none; float:left;"></a>ensemble Account Unauthorized Access</div><div style="padding:24px; font-size:17px;">Hello '.$db_username.',<br /><br />It seems that you have entered your password wrong for successive three times.<br /><br /> Here is your 4 digit code to get access to your account:'.$code.'<br /><br /><a href="localhost/View/verify_pass.php?u='.$db_username.'">Click here to get access to login to your account now</a><br />Information of your login attempts:<br />location:<b>'.$details.'</b><br /><br /><br />Login attempts to the account:<br />* E-mail Address: <b>'.$e.'</b><br /><br />ip-address:<b>'.$ip_client.'</b><br />
		</div></body></html>';

	    $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
	
		mail($to, $subject, $message, $headers);
		//echo "signup_success";
		 
		
	}
		   
	   echo "login_failed|".$_SESSION['count']."^".$ip_client;
	   
		   //echo "login_failed|".$count;
  
		exit();  
	   }
	   else {
		$_SESSION['userid'] = $db_id;
		$_SESSION['username'] = $db_username;
		$_SESSION['password'] = $db_password;
		setcookie("userid",$db_id,strtotime( '+30days' ),"/","","",TRUE);   
		setcookie("username",$db_username,strtotime( '+30days' ),"/","","",TRUE);   
		setcookie("password",$db_password,strtotime( '+30days' ),"/","","",TRUE); 
		$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1"; 
		$query = mysqli_query($con,$sql);
		
		echo  $db_username;
		exit(); 
	   }
	   }
	   
	}
	exit();
	
}
?>
<?php 
if (isset($_POST['emailcheck'])) {
	include_once ("Connection/connect.php"); 
	$email = ($_POST['emailcheck']);
	$sql = "SELECT id FROM users WHERE email='$email' AND activated='1' LIMIT 1";
	$query = mysqli_query ($con,$sql);
	$e_check = mysqli_num_rows($query); 
	if ($email == "") {
		echo "email cannot be blank";
		exit();
	}
	if($e_check == 0) {
		$sql = "SELECT id,activated FROM users WHERE email='$email' LIMIT 1";
		   $query = mysqli_query($con,$sql);
		   $no_email = mysqli_num_rows($query);
		   $row = mysqli_fetch_row($query);
		   $db_id = $row[0];
		   $db_activated = $row[1];
		   if($no_email == 1 && $db_activated == '0' ) {
			  echo "This email is registered but not yet activated.Verification mail has been send to your inbox"; 
		   exit();
		   }
		   else if($no_email == 0) {
			   echo "This email does not belong to any account.SignUp to get registered";
			   exit();
		   }
	}
	else {
	echo "go ahead";	
	exit();
	}
}
?>

<!Doctype Html>
<html>
<head>
<title>Log In</title>
<link href="CSS/login_style.css" rel="stylesheet" type="text/css">
<style>
#pageMiddle_login {
    height:600px;	
}
#login_form {
  position:absolute;
  right:15%;
  top:30%;
  width:70%;	
}
#email_div {
	position:absolute;
  right:30%;
  top:30%;
  
}

#pass_div {
	position:absolute;
  right:30%;
  top:45%;
  
}#buttn_div {
	position:absolute;
  right:61%;
  top:60%;
  
}
#other_div {
	position:absolute;
  right:35%;
  top:75%;
  
}
#status_div {
	position:absolute;
  right:30%;
  top:80%;
  width:250px;
  border:#CCC 1px solid; 
     backgroung: #f5f5f5;
	 padding:12px;
	 visibility:hidden;	
  
}
#write_div {
	position:absolute;
  left:32%;
  top:07%;
  
}
#f1 {
  height:400px;	
}
#mail_span {
	position:absolute;
  right:02%;
  top:27%;
  width:170px;
  
     backgroung: #f5f5f5;
	 padding:12px;
	 
  
}
</style>
<script src="JavaScript/script.js" type="text/javascript"> </script>
<script src="JavaScript/ajax.js" type="text/javascript"> </script>
<script type="text/javascript" src="http://l2.io/ip.js?var=myip"></script>
                                                      
<script>
var count = 0;
function emptyElement(x) {
	_(x).innerHtml = "";
}
function login() {
	alert(""+myip);
   var e = _("mail1").value;
  
   var p = _("pass1").value;
   var ip2 = ""+myip;
    //var count = 0;
   if (e == "" || p == "") {
	  _('status_div').style.visibility = "visible";
	  _('status_div').innerHTML = "Fill up all the form data"; 
   }
   else {
	   _('loginBtn').style.display = "none";
	     _('status_div').style.visibility = "visible";
		 _('status_div').innerHTML = "please wait..";
		 var ajax = ajaxObj("POST","login.php");
		 ajax.onreadystatechange = function() {
		      if(ajaxReturn(ajax) == true){
				  //alert("hello"+ajax.responseText);
				  var response = ajax.responseText;
				  var datArray = response.split("|");
				 if(datArray[0].replace(/^\s+|\s+$/g, "")  == "login_failed"){
					 ++count;
					 var getArray = datArray[1].split("^");
					 if(getArray[0].replace(/^\s+|\s+$/g, "") == 2){
						 window.location = "reset_pass.php";
					 }
					  _('status_div').style.visibility = "visible";
					_('status_div').innerHTML = "Login failed!!wrong email and password combination!!please try again"+getArray[1]; 
					 _('loginBtn').style.display = "block"; 
					 
				  }
				  else {
					  alert(ajax.responseText);
					  var user = ajax.responseText.replace(/^\s+|\s+$/g, "");
					 //alert(ajax.responseText); 
					 window.location = "users.php?u="+user;
				  }
			  }
		 }
	   ajax.send("e="+e+"&p="+p+"&count="+count+"&ip="+myip);
   }
}
function checkMail() {
var x=_("mail1").value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
   _("mail_span").style.visibility = "visible";	
   _("mail_span").innerHTML = '<strong style="color:#f00;">'+x+' is not valid email </strong>';



  return false;
  }
else {
_("mail_span").style.visibility = "visible";	
_("mail_span").innerHTML = 'validating..';
		var ajax= ajaxObj("POST","login.php");
		ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			
		_("mail_span").innerHTML = ajax.responseText;	
		
		}
		}
		ajax.send("emailcheck="+x);
}
}

</script>


</head>
<body>




<div id="pageMiddle_login">


<form id="login_form" onsubmit="return false;">
<fieldset id="f1">
<div id="write_div"><h3>Log in to ensemble</h3></div>
<div id="email_div">
<input type="email" id="mail1" name="mail" placeholder="Enter Your Email" size="46" autofocus required onfocus="emptyElement('status_div')" onblur="checkMail()">

</div>

<div id="pass_div">
 <input type="password" id="pass1" name="pass" placeholder="Enter Your Password" size="46" maxlength="15" autocomplete="off" required onfocus="emptyElement('status_div')"> </div>

<div id="buttn_div">
<button id="loginBtn" type="Submit"  onclick="login()">Login</button></div>

<div id="other_div">
<input type="checkbox" id="chk1" name="remember" value="remember">Remember me &nbsp &nbsp  
<a id="fp" href="forgot_pass.php/" target="_parent">Forgot password?</a> 
</div>

<div id="status_div"></div>
<div id="mail_span">gggggggggggggg</div>
</fieldset>
</form>

</div>
</body>
</html>



