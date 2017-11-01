
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
<script src="../../JavaScript/script.js" type="text/javascript"> </script>
<script src="../../JavaScript/ajax.js" type="text/javascript"> </script>

                                                      
<script>
var count = 0;
function emptyElement(x) {
	_(x).innerHtml = "";
}
function login() {
	
   var e = _("mail1").value;
  
   var p = _("pass1").value;
    //var count = 0;
   if (e == "" || p == "") {
	  _('status_div').style.visibility = "visible";
	  _('status_div').innerHTML = "Fill up all the form data"; 
   }
   else {
	   _('loginBtn').style.display = "none";
	     _('status_div').style.visibility = "visible";
		 _('status_div').innerHTML = "please wait..";
		 var ajax = ajaxObj("POST","http://localhost:8077/ensemble/index.html");
		 ajax.onreadystatechange = function() {
		      if(ajaxReturn(ajax) == true){
				  //alert("hello"+ajax.responseText);
				  var response = ajax.responseText;
				  alert(response);
				  var datArray = response.split("|");
				 if(datArray[0].replace(/^\s+|\s+$/g, "")  == "login_failed"){
					 
					 
					 }
					 
			  }
		 }
	   ajax.send("e="+e+"&p="+p);
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



