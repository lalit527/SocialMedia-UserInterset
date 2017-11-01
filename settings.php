<?php
 if(isset($_POST["usernamecheck"])) {
	include_once ("Connection/connect.php"); 
	$username = preg_replace('#[^a-z0-9]#i','',$_POST['usernamecheck']);
	$sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
	$query = mysqli_query ($con,$sql);
	$username_check = mysqli_num_rows($query);
	if(strlen($username)<3 || strlen($username)>16) {
	     echo '<strong style="color:#f00;"> Username should be 3-16 character                                     </strong>';	
		 exit();
	}
	if(is_numeric($username[0])) {
	     echo '<strong style="color:#f00;">Username must begin with letter</strong>';
		 exit();
	}
	if($username_check < 1) {
		echo '<strong style="color:#0f3;">' . $username . ' is OK </strong>';
		exit();
	}
	else {
	    echo '<strong style="color:#f00;">' .$username. ' is taken </strong>';
		exit();	
	}
 }
?>

<?php
include_once('Connection/connect.php');
include_once('Connection/check_logged_user.php');
if($user_ok != true){
	header("location: login.php");
	exit();
}
$fname = "";
$lname = "";
$username = "";
$password = "";
$email = "";

$sql = "SELECT firstname,lastname,email,password,username FROM users WHERE username='$log_username' LIMIT 1";
$query = mysqli_query($con,$sql);
$num_rows = mysqli_num_rows($query);
if($num_rows < 1){
	
}else {
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$fname = $row['firstname'];
		$lname = $row['lastname'];
		$email = $row['email'];
		$password = $row['password'];
		$username = $row['username'];
	}
}
  
?>
<?php
  if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['pass'])){
	  $fname = preg_replace("#[^a-z]#i","",$_POST['fname']);
	  $lname = preg_replace("#[^a-z]#i","",$_POST['lname']);
	  $pass = $_POST['pass'];
	  if($fname == "" && $lname == "" && $pass == ""){
		  echo 'Missing Values';
		  exit();
	  }
	  else if ((is_numeric($fname)) || (is_numeric($lname))) {
	echo "Name must only contain letters";
	exit();	
	}
	
	  $sql = "SELECT password FROM users WHERE username='$log_username' LIMIT 1";
	  $query = mysqli_query($con,$sql);
	  while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		  $db_pass = $row['password'];  
	  }
	  $pass_hash = md5($pass);
	  if($pass_hash != $db_pass){
		  echo 'Wrong Password';
		  exit();
	  }
	  $sql = "UPDATE users SET firstname='$fname',lastname='$lname' WHERE username='$log_username' LIMIT 1";
	  $query = mysqli_query($con,$sql);
	  echo 'success';
	  exit();
  }
?>
<?php
  if(isset($_POST['pold']) && isset($_POST['pnew']) && isset($_POST['pnew1'])){
	 
	  $pold = $_POST['pold'];
	  $pnew = $_POST['pnew'];
	  $pnew1 = $_POST['pnew1'];
	  if($pold == "" && $pnew == "" && $pnew1 == ""){
		  echo 'Missing Values';
		  exit();
	  }
	  else if (($pnew != $pnew1)) {
	echo "New password does not match each other";
	exit();	
	}
	
	  $sql = "SELECT password FROM users WHERE username='$log_username' LIMIT 1";
	  $query = mysqli_query($con,$sql);
	  while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		  $db_pass = $row['password'];  
	  }
	  $pass_hash = md5($pold);
	  if($pass_hash != $db_pass){
		  echo 'Old and new password does not match each other';
		  exit();
	  }
	  $pnew_hash = md5($pnew);
	  $sql = "UPDATE users SET password='$pnew_hash' WHERE username='$log_username' LIMIT 1";
	  $query = mysqli_query($con,$sql);
	  echo 'success';
	  exit();
  }
?>

<?php
  if(isset($_POST['username']) && isset($_POST['pass'])){
	  //echo 'fuck';
	  $un = preg_replace("#[^a-z0-9]#i","",$_POST['username']);
	  $p = $_POST['pass'];
	  if($un == "" || $p == ""){
		  echo 'Form submission has missing values';
		  exit();
	  }
	  $sql = "SELECT id FROM users WHERE username='$un' LIMIT 1";
      $query = mysqli_query($con,$sql);
      $u_check = mysqli_num_rows($query);
	  if ($u_check > 0) {
	      echo "The user name is alredy taken";
	      exit();
	  }
	  else if (strlen($un) < 3 || strlen($un) > 16) {
	echo "Username must be between 3 to 16 characters.";
	exit();
	}
	else if (is_numeric($un[0])) {
	echo "Username must begin with letter";
	exit();
	}
	$pass_hash = md5($p);
	$sql = "SELECT password FROM users WHERE username='$log_username' LIMIT 1";
	  $query = mysqli_query($con,$sql);
	  while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		  $db_pass = $row['password'];  
	  }
	  if($pass_hash != $db_pass){
		  echo 'Wrong Password';
		  exit();
	  }
	  $sql = "UPDATE users SET username='$un' WHERE username='$log_username' LIMIT 1";
	  $query = mysqli_query($con,$sql);
	  echo 'success';
	  exit();
  }
   
  

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="Test/annesha/style.css">
<style>
#inclue_head{
	
}
#main {
	width:800px;
	height:650px;
	
	
}
#main_right12{
	width:600px;
	height:650px;
	border:thin solid #999;
	border-radius:5px;
    position:absolute;
	left:300px;
	padding:10px;
	border-top:hidden;
	
}
#main_left12{
	width:250px;
	height:650px;
	border:thin solid #999;
	border-radius:5px;
	padding:10px;
	border-top:hidden;
	border-left:hidden;
	position:absolute;
	left:0px;
	top:0;
	}
#name_second{
	
}
#btn_save :hover{
	color:blue;
	}
	a:active {
    color: gray;
	
}
a {text-decoration: none}
a:visited {
    color:black;
	
}
ul
{
list-style-type:none;
margin-left:100px;
padding:4px;
}
#block{
	margin-top:150px;
	alignment-adjust:central;
	}
	#blockd_persons{
		border:thin solid #999;
	border-radius:5px;
		height:100px;
		width:500px;
		}
		#security{
	margin-top:150px;
	alignment-adjust:central;
	}
	#security_email{
		margin-top:150px;
		}
#main_all {
	border:thin solid #000;
	position:absolute;
	
}
</style>
<script src="JavaScript/script.js"></script>
<script src="JavaScript/ajax.js"></script>
<script src="JavaScript/dialog.js"></script>

<script>
function show() {
 document.getElementById('name_first').style.display = 'none';
 
  document.getElementById('name_second').style.display = 'block';
  document.getElementById('pass_first').style.display = 'block';
  document.getElementById('pass_second').style.display = 'none';
   document.getElementById('uname_second').style.display = 'none';
    document.getElementById('email_second').style.display = 'none';
	 document.getElementById('email_first').style.display = 'block';
 document.getElementById('uname_first').style.display = 'block';
	 document.getElementById('pass_second').style.display = 'none';
  
 	
}
function changeNamediv(){
  document.getElementById('name_second').style.display = 'none';
  document.getElementById('name_first').style.display = 'block';	
  
}
function show1() {
 document.getElementById('uname_first').style.display = 'none';
 document.getElementById('name_first').style.display ='block';
  document.getElementById('name_second').style.display = 'none';
  document.getElementById('uname_second').style.display = 'block';
  document.getElementById('pass_first').style.display = 'block';
  document.getElementById('pass_second').style.display = 'none';
   document.getElementById('email_second').style.display = 'none';
    document.getElementById('email_first').style.display = 'block';
  
 
  	
}
function changeUNamediv(){
  document.getElementById('uname_second').style.display = 'none';
  document.getElementById('uname_first').style.display = 'block';	
  
}
function show2() {
 document.getElementById('email_first').style.display = 'none';
  document.getElementById('email_second').style.display = 'block';
  document.getElementById('name_first').style.display ='block';
  document.getElementById('name_second').style.display = 'none';
  document.getElementById('uname_second').style.display ='none';
   document.getElementById('uname_first').style.display = 'block';
   document.getElementById('pass_first').style.display = 'block';
  document.getElementById('pass_second').style.display = 'none';
  
  
	
}
function changeEmaildiv(){
  document.getElementById('email_second').style.display = 'none';
  document.getElementById('email_first').style.display = 'block';	
}
function show3() {
 document.getElementById('pass_first').style.display = 'none';
  document.getElementById('pass_second').style.display = 'block';
  document.getElementById('name_first').style.display ='block';
  document.getElementById('name_second').style.display = 'none';
  document.getElementById('uname_second').style.display ='none';
   document.getElementById('uname_first').style.display = 'block';
   document.getElementById('email_first').style.display = 'block';
   document.getElementById('email_second').style.display = 'none';	
}
function changePassdiv(){
  document.getElementById('pass_second').style.display = 'none';
  document.getElementById('pass_first').style.display = 'block';	
}
function block_show() {
	alert("");
 document.getElementById('general').style.display = 'none';
  document.getElementById('security').style.display = 'none';
  document.getElementById('block').style.display = 'block';	
}
function general_show() {
 document.getElementById('block').style.display = 'none';
 document.getElementById('security').style.display = 'none';
  document.getElementById('general').style.display = 'block';	
}
function security_show() {
 document.getElementById('block').style.display = 'none';
  document.getElementById('general').style.display = 'none';
   document.getElementById('security').style.display = 'block';		
}
function changeSecuritydiv(){
  document.getElementById('security_email').style.display = 'none';
  document.getElementById('security').style.display = 'block';	
  
}

function show_secur(){
  document.getElementById('security_email').style.display = 'block';
  document.getElementById('security').style.display = 'block';	
  
}
function changeName(){
   var fname = _('fname').value;
   var lname = _('lname').value;
   var pass = _('pass').value;	
   if(pass == ""){
	   _('name_span').innerHTML = 'Please enter your password';
	   exit();
   }
   if(fname == "" && lname == ""){
	   _('name_span').innerHTML = 'Name cannot be empty';
	   exit();
   }
   var ajax = ajaxObj("POST","settings.php");
   ajax.onreadystatechange = function() {
	      if(ajaxReturn(ajax) == true){
			  var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			  
			  if(response == "success"){
				  _('name_second').style.display = 'none';
				  _('name_first').style.display = 'block';
				  _('name1').innerHTML = fname+" "+lname;
				  
			  }
			 else {
				 _('name_span').innerHTML = response;
			 }
		  }
   }
   ajax.send("fname="+fname+"&lname="+lname+"&pass="+pass);
}
function changePass(){
	
	var op = _('oldpass').value;
   var np = _('newpass').value;
   var np1= _('newpass1').value;
  // alert('xxxxx'+op+np+np1);	
   if(op == ""){
	   _('pass_span1').innerHTML = 'Please enter your password';
	   //alert("empty");
	   exit();
	   
   }
   if(np != np1){
	   _('pass_span1').innerHTML = 'Password does not match';
	   //alert("n no match");
	   exit();
   }
   var ajax = ajaxObj("POST","settings.php");
   //alert('yyyyyyyyy');
   ajax.onreadystatechange = function() {
	      if(ajaxReturn(ajax) == true){
			  var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			  
			  if(response == "success"){
				  //alert(response);
				  _('pass_second').style.display = 'none';
				  _('pass_first').style.display = 'block';
				  _('pass_span1').innerHTML = 'changed';
				  
			  }
			 else {
				 //alert(response);
				 _('pass_span1').innerHTML = response;
				 
			 }
		  }
   }
   ajax.send("pold="+op+"&pnew="+np+"&pnew1="+np1);

	
}
function checkusername() {
	var u = _("usrnm").value;
	if(u ==""){
		_("usrnm_span").innerHTML = 'field cannot be empty';
		exit();
	}
		_("usrnm_span").innerHTML = 'validating..';
		var ajax= ajaxObj("POST","settings.php");
		ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
		_("usrnm_span").innerHTML = ajax.responseText;	
		}
		}
		ajax.send("usernamecheck="+u);
	}
	
function changeusername(){
	var u = _('usrnm').value;
   var pass = _('pasusr').value;	
   if(pass == ""){
	   _('username_span').innerHTML = 'Please enter your password';
	   exit();
   }
   if(u == ""){
	   _('username_span').innerHTML = 'Name cannot be empty';
	   exit();
   }
   var ajax = ajaxObj("POST","settings.php");
   ajax.onreadystatechange = function() {
	      if(ajaxReturn(ajax) == true){
			  var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
	          if(response == 'success'){
				  _('uname_second').style.display = 'none';
				  _('uname_first').style.display = 'block';
				  _('uname1').innerHTML = u;
			  }else{
			   _('username_span').innerHTML = response;		  
			  }
		  }
   }
   ajax.send("username="+u+"&pass="+pass);
	
}
function changeTheme(){
	
}
</script>
</head>
<body>

<?php //include 'Test/annesha/header.php';?>
<div id="main">

<div id="main_right12">
<div id="general">
<h2>General settings</h2>
<hr noshade/><br>
<div id="name_first"> 
<span style="float:left;margin-right:250px;"> Name</span>  <span id="name1" style="font:1.5em"><?php echo $fname . ' ' . $lname ?></span> <span style="float:right;margin-right:30px;"><a href="#" onmousedown="show()" 
	onclick="return false">Edit</a></span></div>
    <div id="name_second" style="display:none;"><center><form ><p>First Name:<input type="text" id="fname" value="<?php echo $fname?>"></p><p>Last Name:<input type="text" id="lname" value="<?php echo $lname?>"></p><hr width="40%"/><p><b>To make changes enter your password</b></p><p>Password:<input type="password" id="pass"></p><p><input type="button" id="btn_save" value="save changes" onclick="changeName()"><input type="button" value="cancel" onclick="changeNamediv()"></p></form></center>
<p><span style="margin-left:250px;color:#F00;#" id="name_span"></span> </p>    </div>    
    <hr /><br>
    <div id="uname_first">
   <span style="float:left;margin-right:230px;"> Username</span>  <span id="uname1" style="font:1.5em"><?php echo $username; ?></span> <span style="float:right;margin-right:30px;"><a href="#" onmousedown="show1()" 
	onclick="return false">Edit</a></span></div>
    <div id="uname_second" style="display:none;"><center><form ><p> Your public username is the same as your Timeline address:</p>
    <p style="margin-left:150px;">Username:<input type="text" id="usrnm" onchange="checkusername()" style="" value="<?php echo $username; ?>"><span id="usrnm_span" style="margin-right:20px;"></span></p><p>Note: Your username can only be changed once and should include your real name. </p><hr width="40%"/><p><b>To make changes enter your password</b></p><p>Password:<input type="password" id="pasusr"></p><p><input type="button" id="btn_save" value="save changes" onClick="changeusername()"><input type="button" value="cancel" onclick="changeUNamediv()"></p></form></center><p><span style="margin-left:250px;color:#F00;" id="username_span"></span> </p>
</div>    
        <hr /><br>
    <div id="email_first">
   <span style="float:left;margin-right:230px;">Email </span> <span style="font:1.5em"><?php echo $email  ?></span> <span style="float:right;margin-right:30px;"><a href="#" onmousedown="show2()" 
	onclick="return false">Edit</a></span></div>
    <div id="email_second" style="display:none;"><center><form ><p> Primary email:<?php echo $email  ?></p> <hr width="40%"/>
    <p><a href="#" onmousedown="show2()" 
	onclick="return false">Add another</a></p><hr width="40%"/><p> <input type="checkbox" name="email" >Use your main email:</p><p> Your email is based on your public username.
<br>Emails sent to this address are forwarded to your primary email: <?php echo $email  ?> </p>  <hr width="40%"/> <p><b>To make changes enter your password</b></p><p>Password:<input type="password"></p><p><input type="button" id="btn_save" value="save changes"><input type="button" value="cancel" onclick="changeEmaildiv()"></p></form></center></div>    
    <hr /><br>
    
    <div id="pass_first">
  <span style="float:left;margin-right:230px;">Password</span> <span style="font:1.5em" id="pass_span">Not yet changed</span><span style="float:right;margin-right:30px;"><a href="#" onmousedown="show3()" 
	onclick="return false">Edit</a></span></div> 
    
   <div id="pass_second" style="display:none;"><center><form ><p>Current:&nbsp;&nbsp;&nbsp;<input type="password" value="" id="oldpass"></p><p>New:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" value="" id="newpass"></p> <p>Re-type:&nbsp;&nbsp;&nbsp;<input type="password" value="" id="newpass1"></p><hr width="40%"/> <p><input type="button" id="btn_save" value="save changes" onclick="changePass()"><input type="button" value="cancel" onclick="changePassdiv()"></p></form></center><p><span style="margin-left:250px;color:#F00;" id="pass_span1">ssssss</span> </p>   </div>     <hr />
   
   </div>
   
   
<div id="block" style="display:none;" align="center"> 
<b>Block users &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <p align="justify"> Once you block someone, that person can no longer see things you post on your timeline, tag you, invite you to events or groups, start a conversation with you, or add you as a friend. Note: Does not include apps, games or groups you both participate in.
<p> 

<div id="blockd_persons"> Block Users &nbsp;&nbsp;&nbsp;<input type="text" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" id="btn_block" value="BLOCK"> </div>
</div>
<div id="security" style="display:none;">Login Notifications &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Get notified when it looks like someone else is accessing your account &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onmousedown="show_secur()" 
	onclick="return false">Edit</a> 
    <div id="security_email" style="display:none;"> <p> <input type="checkbox" name="email" >Email</p>
    <hr /> <p><input type="button" id="btn_save" value="save changes"><input type="button" value="cancel" onclick="changeSecuritydiv()"></p>   </div>
    </div>
    
    
</div>
</div>

<div id="main_left12">
<ul id="ul1">
<li><a href="#" onmousedown="general_show()" 
	onclick="return false"><b>General</a></li><br />
<li><a href="#" onmousedown="security_show()" 
	onclick="return false"><b>Security</a></li>
<hr /><br><br />
<li><a href="#" onmousedown="changeTheme()" 
	onclick="return false"><b>Theme</a></li><br /><hr />

<li><a href="#" onmousedown="block_show()" 
	onclick="return false"><b>Blocking</a></li><br />
<li><a href="#"><b>Privacy</a></li>
<hr /><br><br />
  <li><a href="#"><b>Notification</a></li> 
</ul>

</div>
</div>
</body>
</html>

