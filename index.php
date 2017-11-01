	<?php include ("Connection/connect.php") ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="CSS/login_style.css" rel="stylesheet" type="text/css">
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="JavaScript/login_script.js"></script>

<style>
body { margin:0px; }

</style>
</head>

<body>

<?php include ("Template/pagetop_login.php") ?>



<div id="pageMiddle">

<div id="menu" >
<form action="" autocomplete="on">
<fieldset id="f1">
<legend><b>Login to <span style="color:#6685ab">ensemble</span></b></legend>
<br>

<p><input type="email" id="mail1" name="mail" placeholder="Enter Your Email" size="46" autofocus required></p>
 <p><input type="password" id="pass1" name="pass" placeholder="Enter Your Password" size="46" maxlength="15" autocomplete="off" required></p>

<button id="loginBtn" type="Submit"  >Login</button>
<br><p>
<input type="checkbox" id="chk1" name="remember" value="remember">Remember me &nbsp &nbsp  
<a id="fp" href="http://www.ensemble_retrivepassword.php/" target="_parent">Forgot password?</a> 
</p>
</fieldset>
</form>
</div>


<div id="signUp" style="">
<form action="sign_up.php" method="post" autocomplete="on">
<fieldset id="q1">
<div style="margin-bottom:4px;text-align:center;">
<span style="font-style:oblique; font-weight:bold; font-size:1.5em">Welome to world of <span style="color:#6685ab; ">ensemble</span></span><br><span style="font-style:oblique;">where the world is always with you</span>
</div>
<div style="margin-bottom:4px;">
<input type="text" id="fname1" name="fname" placeholder="First name"   size="23" required >
<input type="text" id="lname1" name="lname" placeholder="Last name"  size="22" required >
 </div> 
<div style="margin-bottom:4px;"><input type="email" id="mail2" name="email" placeholder="Email" size="50" required></div>

<div style="margin-bottom:4px;"><input type="email" id="mail21" name="confirm-email" placeholder="Confirm Email" size="50" required></div>
<div style="margin-bottom:4px;"><input type="password" id="pass2" name="password" placeholder="Your Password" size="50" maxlength="15" required autocomplete="off"></div>
<div style="margin-bottom:4px;"><input type="password"  id="pass21" name="confirm-password" placeholder="Confirm Password" size="50" maxlength="15"
required autocomplete="off"></div>
<div class="ex" style="margin-bottom:2px;"><span style="font-size:20px;font-family:bold;font-weight:bold;"> Birthday</span></div>
<div class="ex" style="margin-bottom:2px;">
<select name="year" id="year1">
<option value="year" selected>Year</option>
<option value="1970">1970</option>
<option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option>
<option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option>
</select>
<select name="month" id="mnth1">
<option value="month" selected>Month</option>
<option value="january">January</option>
<option value="february" >February</option>
<option value="march">March</option>
<option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option></select>
<select name="day" id="day1">
<option value="day" selected>Date</option>
<option value="1">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
</select>
</div>
<div class="ex" style="margin-bottom:3px;">
<input type="radio" name="sex" value="female"><span style="font-size:20px;font-family:bold;font-weight:bold;">Female</span>
&nbsp;&nbsp;
&nbsp;&nbsp;<input type="radio" name="sex" value="male"><span style="font-size:20px;font-family:bold;font-weight:bold;">Male</span>
</div>

<div class="ex" style="margin-bottom:3px;"><input class="signOnClick" type="submit" value="Welome to world of ensemble"  ; ></div>
<div class="ex" style="margin-bottom:2px;text-align:center;font-size:12px">By clicking submit,you accept the <span style="color:#6685ab">Terms</span> & <span style="color:#6685ab"> Conditions. </span>
</div>
</fieldset>
</form>
</div>
</div>

<?php include ("Template/pagebottom_login.php") ?>
</body>
</html>
