<?php
include_once('../../Connection/check_logged_user.php');
$dp = "";
$pf_pic = "";
$sql = "SELECT dplink FROM users WHERE username='$log_username' LIMIT 1";
$query = mysqli_query($con,$sql);
$num = mysqli_num_rows($query);
$row = mysqli_fetch_row($query);
$dp = $row[0];
$pf_pic = '<div id="pic_preview"><img src="../../Users/'.$log_username.'/'.$dp.'"  id="dp_stng" height="40px" width="40px"></div>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
#stng_div{
	width:150px;
	height:300px;
	background-color:#FFF;
	border:thin solid #999;
	
	
}
#stnd_upr {
	height:30px;
	padding:10px;
	
}
#dp_stng{
	border-radius:5px;
}
#stng_page,#stng_hlp,#stng_stng,#stng_log {
	
	padding:10px;
	font-size:16px;
	color:#000;
	font-stretch:expanded;
}
#stng_page:hover {
	background-color:#036;
	
}
#stnd_upr:hover,#stng_hlp:hover,#stng_stng:hover {
	background-color:#036;
	
}
#stng_log:hover {
	background-color:#036;
	
}
#page_lnk,#hlp_lnk,#log_lnk,#stng_lnk{
	
	color:#000;
	text-decoration:none;
	
}
#stng_hlp {
	
	
}
</style>
</head>

<body>
<div id="stng_div">

<div id="stnd_upr">
<?php echo $pf_pic;?></div><hr />
<div id="stng_page"><a href="create_page.php" id="page_lnk">Create Page</a></div><hr />
<div id="stng_hlp"><a href="" id="hlp_lnk">Help</a></div><hr />
<div id="stng_stng"><a href="settings.php" id="stng_lnk">Settings</a></div><hr />
<div id="stng_log"><a href="logout.php" id="log_lnk">Log out</a></div>
</div>
</body>
</html>