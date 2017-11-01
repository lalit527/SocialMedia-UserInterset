<?php
  session_start();
  if(isset($_SESSION["username"])) {
	header("location: message.php?msg=no");
	echo '<a href="users.php?u='.$_SESSION["username"].'>log in</a>';
	exit();  
  }
?>
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
		echo '<strong style="color:#f00;">' . $username . ' is OK </strong>';
		exit();
	}
	else {
	    echo '<strong style="color:#f00;">' .$username. ' is taken </strong>';
		exit();	
	}
 }
?>
<?php
 if(isset($_POST["emailcheck"])) {
	include_once ("Connection/connect.php"); 
	$email = ($_POST['emailcheck']);
	$sql = "SELECT id FROM users WHERE email='$email' LIMIT 1";
	$query = mysqli_query ($con,$sql);
	$email_check = mysqli_num_rows($query);
	if($email_check < 1) {
		echo '<strong style="color:#f00;">We will mail you conformation. </strong>';
		exit();
	}
	else {
	    echo '<strong style="color:#f00;">' .$email. ' is already registered </strong>';
		exit();	
	}
 }
?>
<?php 
//-----------REGISTERING THE USER----------------------------
if(isset($_POST["u"])) {
   include_once("Connection/connect.php");
   $fn = preg_replace('#[^a-z]#i','',$_POST['fn']);
  
   $ln = preg_replace('#[^a-z]#i','',$_POST['ln']);
   $ml = mysqli_real_escape_string($con,$_POST['mail']);
   $ps = $_POST['p'];
   $un = preg_replace('#[^a-z0-9]#i','',$_POST['u']);
   $yr = preg_replace('#[^0-9]#','',$_POST['y']);
   $mn = preg_replace('#[^0-9]#','',$_POST['m']);
   $dy = preg_replace('#[^0-9]#','',$_POST['d']);
   $gn = preg_replace('#[^a-z]#','',$_POST['g']);
   $ip = preg_replace('#[^0-9.]#i','',getenv('REMOTE_ADDR'));
   if($gn == "male") {
	 $gndr = 'm';   
   }
   else if($gn == "female") {
	 $gndr = 'f';   
   }
    
//--------------------PARSE TO DATE----------------------------------
  // $date = $yr\$mn\$yr;
   //$dob = date_parse_from_format('d/M/Y', '$dy/$mn/$yr');   
//--------------------DUPLICATE USERNAME CHECK-----------------------
   $sql = "SELECT id FROM users WHERE username='$un' LIMIT 1";
   $query = mysqli_query($con,$sql);
   $u_check = mysqli_num_rows($query);
    
//--------------------DUPLICATE MAIL CHECK---------------------------
   $sql = "SELECT id FROM users WHERE email='$ml' LIMIT 1";
   $query = mysqli_query($con,$sql);
   $m_check = mysqli_num_rows($query);
//--------------------FORM DATA CHECK--------------------------------
    if($fn == "" || $ln == "" || $ml == "" || $ps == "" || $un == "" ||  $gn == ""){
	echo "The form submission has missing values.";	
	exit();
	}
	else if ($u_check > 0) {
	echo "The user name is already taken";
	exit();
	}
	else if ($m_check > 0) {
	echo "The mail address is already registered";
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
	else if ((is_numeric($fn)) || (is_numeric($ln))) {
	echo "Name must only contain letters";
	exit();	
	}
	else {
	$pass_hash = md5($ps);
//------------INSERT DETAILS IN USER TABLE-----------------------	
	 $sql = "INSERT INTO users (firstname, lastname, email, password, username,  gender, ip, signup, lastlogin, notescheck)                                   VALUES('$fn','$ln','$ml','$pass_hash','$un','$gndr','$ip',now(),now(),now())";
	 $query = mysqli_query($con,$sql);
	 $uid = mysqli_insert_id($con);
//------------INSERT IN USEROPTION TABLE-----------------------------	 
	 $sql = "INSERT INTO useroptions (id, username, background) VALUES         ('$uid','$un','original')";
		$query = mysqli_query($con, $sql);
//--------Create directory(folder) to hold each user's `files(pics, MP3s, etc.)------
		if (!file_exists("Users/$un")) {
			mkdir("Users/$un", 0755, TRUE);
			mkdir("Users/$un/video", 0755, TRUE);
			mkdir("Users/$un/audio", 0755, TRUE);
			mkdir("Users/$un/album", 0755, TRUE);
			mkdir("Users/$un/album/profile", 0755, TRUE);
			mkdir("Users/$un/album/cover", 0755, TRUE);
			
		}
//---------SEND MESSAGE FOR ACTIVATION-------------------------		
       
		$to = $ml;
		$from = 'lalit.slg007@gmail.com';
		$subject = 'ensemble site activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>ensemble Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://localhost/Views/activation.php"><img src="http://www.yoursitename.com/images/logo.png" width="36" height="30" alt="yoursitename" style="border:none; float:left;"></a>ensemble Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$fn.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="localhost/View/activation.php?id='.$uid.'&u='.$un.'&e='.$ml.'&p='.$pass_hash.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$ml.'</b></div></body></html>';

	    $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
	
		if (mail($to, $subject, $message, $headers)) {
		echo "signup_success";
		
		}
				exit();
	}
	exit();

	
}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link href="CSS/login_style.css" rel="stylesheet" type="text/css">
<link href="CSS/signup_style.css" rel="stylesheet" type="text/css">
<script src="JavaScript/script.js" type="text/javascript"> </script>
<script src="JavaScript/ajax.js" type="text/javascript"> </script>

</head>

<body>
<?php include ("Template/pagetop_login.php") ?>

<script>
var year,month,day;
function openTerms(){
	_("terms").style.display = "block";
	emptyElement("status");
}
function checkusername() {
	var u = _("usrnm").value;
	if(u!=""){
		_("usrnm_span").style.visibility = "visible";
		_("usrnm_span").innerHTML = 'validating..';
		var ajax= ajaxObj("POST","sign_up.php");
		ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
		_("usrnm_span").innerHTML = ajax.responseText;	
		}
		}
		ajax.send("usernamecheck="+u);
	}
}
function checkname() {
	var f = _("fname1").value;
	var l = _("lname1").value;
	if(f == "" || l == ""){
		_("name_span").style.visibility = "visible";
		_("name_span").innerHTML = '<strong style="color:#f00;">Name cannot be empty  </strong>';
		exit();
	}else {
	_("name_span").style.visibility = "visible";
	_("name_span").innerHTML = '<strong style="color:#f00;">Welcome to our website '  +f+  ' ' +l+ '   </strong>';
	}
}

function emptyElement(status) {
	document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"";
	_("status").innerHTML = "";
	
}
function restrict(user) {
	var x = _(user);
	//alert(x.value);
	var re = new RegExp;
	if(user == "email") {
		re = /[' "]/gi;
	}
	else if(user == "username") {
	     re = /[^a-z0-9]/gi;	
	}
	  x.value = x.value.replace(re,"");
}
function validate() {
	var fn = _("fname1").value;
	var ln = _("lname1").value;
	var m1 = _("mail2").value;
	var m2 = _("mail21").value;
	var p1 = _("pass2").value;
	
	var p2 = _("pass21").value;
	var un = _("usrnm").value;
	var y  = _("year1").value;
    var m  = _("mnth1").value;	
	var d  = _("day1").value;
	if (_('r1').checked) {
    var gndr = _('r1').value;
    }
	else if (_('r2').checked) {
    var gndr = _('r2').value;
    }
	
	
	if(fn == "" || ln == "" || m1 == "" || m2 == "" || p1 == "" || p2 == "" ||        y == "year" || m == "month" || d == "day" || (gndr != "male" && gndr !=       "female")) {
		_("status").style.visibility = "visible";
		_("status").innerHTML = "please fill up all the fields";
		
	}
	
	
	else if(_("terms").style.display == "none") {
      _("status").innerHTML = "please view the terms";		
	}
	else {
	  _("get_signed").style.display = "none";
	  _("status").innerHTML = "please wait..";
	  var ajax = ajaxObj("POST","sign_up.php");
	  ajax.onreadystatechange = function() {
	  if(ajaxReturn(ajax) == true) {  
	  if(ajax.responseText.replace(/^\s+|\s+$/g, "") != "signup_success"){﻿
		_("status").innerHTML = ajax.responseText;
		_("get_signed").style.display = "block";  
	  }
	  else {
		window.scrollTo(0,0);
		_("signup_form").innerHTML = "OK "+fn+", check your email inbox and junk mail box at <u>"+m1+"</u> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
				 
	  }
	}
}
ajax.send("fn="+fn+"&ln="+ln+"&mail="+m1+"&p="+p1+"&u="+un+"&y="+y+"&m="+m+"&d="+d+  "&g="+gndr);
}
}
function checkemail()
{
var x=_("mail2").value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
   _("email1_span").style.visibility = "visible";	
   _("email1_span").innerHTML = '<strong style="color:#f00;">'+x+' is not valid email </strong>';
  return false;
  }
else {
_("email1_span").style.visibility = "visible";	
_("email1_span").innerHTML = 'validating..';
		var ajax= ajaxObj("POST","sign_up.php");
		ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			
		_("email1_span").innerHTML = ajax.responseText;	
		
		}
		}
		ajax.send("emailcheck="+x);
}
}
function confirm_mail() {
	var m1 = _("mail2").value;
	var m2 = _("mail21").value;
	if(m1 != m2){
	   _("email2_span").style.visibility = "visible";	
	  _("email2_span").innerHTML = '<strong style="color:#f00;">email doesnot match</strong>';
	}
	else {
		 _("email2_span").style.visibility = "visible";
		  _("email2_span").innerHTML = '<strong style="color:#f00;">email matched</strong>';
	}
}
function checkpass() {
var p1 = _("pass2").value;
var hasDuplicates = (/([a-zA-Z0-9])\1+$/).test(p1);	
var hasNumeric =  /\d/.test(p1);	
var hasSpecial = /[@&"_\.-]/.test(p1);
if(p1.length<6) {
	 _("pswrd1_span").style.visibility = "visible";	
_("pswrd1_span").innerHTML = '<strong style="color:#f00;">password should be atleast  6 character</strong>';	
}
if(p1.length>=6){

	if(hasDuplicates) {
		
	 _("pswrd1_span").innerHTML = '<strong style="color:#f00;">password is not secure</strong>';		
	}
	
	if(hasSpecial || hasNumeric) {
	_("pswrd1_span").innerHTML = '<strong style="color:#f00;">password moderate</strong>';		
	}
	if(hasNumeric && hasSpecial) {
	_("pswrd1_span").innerHTML = '<strong style="color:#f00;">password good</strong>';		
	}
	if(hasNumeric && hasSpecial && p1.length>=10) {
	_("pswrd1_span").innerHTML = '<strong style="color:#f00;">password strong</strong>';		
	}
	
	
	
}

}
function verifyPass() {
	var p1 = _("pass2").value;
	var p2 = _("pass21").value;
	if(p1 != p2){
	  _("pswrd2_span").style.visibility = "visible";	
	  _("pswrd2_span").innerHTML = '<strong style="color:#f00;">password does not match</strong>';		
	}
	else {
		 _("pswrd2_span").style.visibility = "visible";
		 _("pswrd2_span").innerHTML = '<strong style="color:#f00;">password matched</strong>';
	}
}

function yr()
{
year=document.getElementById('year1').value;
month = document.getElementById('mnth1').value;
day=document.getElementById('day1').value;
if(month=="month")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the month of birth";
}
else if(year=="year")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the year of birth";
}
else if(day=="day")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the day of birth";
}else
{
document.getElementById('mnth1').disabled=false;
}
}

function mth()
{
year=document.getElementById('year1').value;
month = document.getElementById('mnth1').value;
day=document.getElementById('day1').value;
if(month=="month")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the month of birth";
}
else if(year=="year")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the year of birth";
}
else if(day=="day")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the day of birth";
}
else
{
document.getElementById('day1').disabled=false;
}
}

function dy()
{
year = document.getElementById('year1').value;
month = document.getElementById('mnth1').value;
day = document.getElementById('day1').value;
//alert(year);
if(year=="year")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the year of birth";
}
else if(month=="month")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the month of birth";
}
else if(day=="day")
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select the day of birth";
}
else
{
check();

}
}

function check()
{
year = document.getElementById('year1').value;
month = document.getElementById('mnth1').value;
day = document.getElementById('day1').value;
if(((day=="30")||(day=="31"))&&(month=="february"))
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select a valid date";
}
else if((day=="29")&&(month=="february"))
{
var y = parseInt(year);
if((y%400==0)||((y%4==0)&&(y%100!=0)))
{
}
else
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select a valid date";
}
}
else if((day=="31")&&((month=="april")||(month=="june")||(month=="september")||(month=="november")))
{
document.getElementById('lbl').innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Please select a valid date";
}
else
{
var date=year+"-"+month+"-"+day;

document.getElementById('test').value=date;
}
}

</script>

<div id="pageMiddle_su">

<div id="signUp" style="display:block;">

<form id="signup_form" autocomplete="on" onsubmit="return false;">

<div style="margin-bottom:7px;text-align:justify;">
<span style="font-style:oblique; font-weight:bold; font-size:1.5em">Welome to world of <span style="color:#6685ab; ">ensemble</span></span><br><span style="font-style:oblique;">where the world is always with you</span>
</div>

<div style="margin-bottom:7px;">
<input type="text" id="fname1" name="fname" placeholder="First name" size="23" required onfocus="emptyElement('status')" onblur="checkname()">
<input type="text" id="lname1" name="lname" placeholder="Last name"  size="22" required onfocus="emptyElement('status')" onblur="checkname()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="name_span" style="visibility:hidden;">hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</span>
 </div>

  
<div style="margin-bottom:7px;"><input type="email" id="mail2" name="email" placeholder="Email" size="50" required onfocus="emptyElement('status')"            onchange="checkemail()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="email1_span" style="position:absolute;visibility:hidden;">hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</span>
 </div>

<div style="margin-bottom:7px;"><input type="email" id="mail21" name="confirm-email" placeholder="Confirm Email" size="50" required onfocus="emptyElement('status')" onblur="confirm_mail()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="email2_span" style="visibility:hidden;">hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</span>
 </div>

<div style="margin-bottom:7px;"><input type="password" id="pass2" name="password" placeholder="Your Password" size="50" maxlength="25" required autocomplete="off" onfocus="emptyElement('status')" onkeyup="checkpass()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="pswrd1_span" style="visibility:hidden;">hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</span>
 </div>

<div style="margin-bottom:7px;"><input type="password"  id="pass21" name="confirm-password" placeholder="Confirm Password" size="50" maxlength="25"
required autocomplete="off" onfocus="emptyElement('status')" onblur="verifyPass()">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="pswrd2_span" style="visibility:hidden;">hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</span>
 </div>

<div style="margin-bottom:7px;"><input type="text"  id="usrnm" name="username" placeholder="UserName" size="50" maxlength="15" required onchange="checkusername()" onkeyup="restrict('username')" autocomplete="on" onfocus="emptyElement('status')">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="usrnm_span" style="visibility:hidden;">hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</span>
 </div>

<div class="ex" style="margin-bottom:2px;"><span style="font-size:20px;font-family:bold;font-weight:bold;"> Birthday</span></div>

<div class="ex" style="margin-bottom:2px;">
<select name="year" id="year1" onfocus="emptyElement('status')" onblur="yr()">
<option value="year" selected>Year</option>
<option value="1970">1970</option>
<option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990<option value="1991">1991</option></option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option>
<option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option>
</select>
<select name="month" id="mnth1" onfocus="emptyElement('status')" onblur="mth()">
<option value="month" selected>Month</option>
<option value="january">January</option>
<option value="february" >February</option>
<option value="march">March</option>
<option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>
<select name="day" id="day1" onfocus="emptyElement('status')" onblur="dy()">
<option value="day" selected>Date</option>
<option value="1">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
</select>

<label id="lbl"></label>
</div>

<div class="ex" style="margin-bottom:3px;">
<input type="radio" name="sex" value="female" id="r1" onfocus="emptyElement('status')"><span style="font-size:20px;font-family:bold;font-weight:bold;">Female</span>
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="radio" name="sex" value="male" id="r2" onfocus="emptyElement('status')"><span style="font-size:20px;font-family:bold;font-weight:bold;">Male</span>
</div>

 <div style="margin-bottom:5px;">
      <a href="#" onclick="return false" onmousedown="openTerms()">
        View the Terms Of Use
      </a>
    </div>
    <div id="terms" style="display:none;margin-bottom:7px;">
      <h3>ensemble Terms Of Use</h3>
      <p>1. how are you.</p>
      <p>2. m fine.</p>
      <p>3. Thank you.</p>
    </div>

<div class="ex" style="margin-bottom:5px;"><input class="signOnClick" id="get_signed" type="submit"  onclick="validate()" value="Welome to world of ensemble"  ; ></div>

<div class="ex" style="margin-bottom:17px;text-align:justify;font-size:12px">By clicking submit,you accept the <span style="color:#6685ab">Terms</span> & <span style="color:#6685ab"> Conditions. </span>
</div>

<span id="status">ffffffffffffffffffffffffffffffffffff</span>

</form>
</div>


</div>



</body>
</html>