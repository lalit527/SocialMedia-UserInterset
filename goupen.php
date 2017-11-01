<?php
 include_once ("Connection/check_logged_user.php");
 if($user_ok != true){
	 header("location: login.php");
	 exit();
 }
?>


<?php
include_once ("Connection/check_logged_user.php");
include_once ("TimeStamp/time_ago.php");
$timeAgoObject = new convertToAgo;

$u = "";
$f_name = "";
$l_name = "";
$sex = "Female";
$profile_pic = "";
$profile_pic_btn = "";
$profile_form = "";
$userlevel = "";
$joindate = "";
$lastseen = "";
$lastseenfrom = "";
$bglink = "";
$dplink = "";
$cplink = "";
$lastsession = "";
$isOwner = "no";
$account_setting = "";
$logout = "";
$post = "";
$notification = "";
$convertedTime_lastseen = "";
$when_lastseen = "";
$message_btn = "";
$status_ui = "";
$cover_pic = "";
   $u = $log_username;
   
$sql = "SELECT background From useroptions WHERE username='$log_username' LIMIT 1";
$query = mysqli_query($con,$sql);
$row_ftch = mysqli_fetch_row($query);
$bglink = $row_ftch[0];

$sql = "SELECT * FROM users WHERE username='$log_username' AND activated='1' LIMIT 1";

$user_query = mysqli_query($con,$sql);

$numuser = mysqli_num_rows($user_query);

if($numuser < 1){
	
	echo "This user is not yet activated";
	exit();
}


while ($row = mysqli_fetch_array($user_query,MYSQLI_ASSOC)) {
	
	$profile_id = $row['id'];
	$f_name = $row['firstname'];
	$l_name = $row['lastname'];
	$gender = $row['gender'];
	$dplink = $row['dplink'];
	$cplink = $row['cplink'];
	$signup = $row['signup'];
	$userlevel = $row['userlevel'];
	$lastseen = $row['lastlogin'];
	$lastseenfrom = $row['lastloginfrom'];
	$userlevel = $row['userlevel'];
	$joindate =strftime("%b %d, %Y", strtotime($signup));
	$lastsession = strftime("%b %d, %Y", strtotime($lastseen));
	if($gender == 'm') {
	   $sex = "Male";	
	   
	}
	$convertedTime_lastseen = ($timeAgoObject -> convert_dateTime($lastseen));
	$when_lastseen = ($timeAgoObject -> makeAgo($convertedTime_lastseen));
$cover_pic = '<div id="cp_preview"><img src="Users/'.$log_username.'/'.$cplink.'" alt="'.$u.'" id="preview_cp" height="200px" width="220px" style="border-radius:10px;opacity:0.8;
filter:alpha(opacity=80);"></div>';


$profile_pic = '<div id="pic_preview"><img src="Users/'.$log_username.'/'.$dplink.'" alt="'.$u.'" id="preview_dp" height="70px" width="50px" style="border-radius:3px;"><div id="name">'.$f_name.' '.$l_name.'<div><div>@'.$log_username.'</div><a href="">Edit</a></div></div></div>';

$pf_pic = '<div id="stng_pic"><img src="Users/'.$log_username.'/'.$dplink.'"  id="dp_stng" height="40px" width="40px"><div id="name_stng">'.$f_name.' '.$l_name.'  @'.$log_username.'</div></div>';

if($profile_pic == ""){
	$profile_pic = '<div id="pic_preview"><img src="Images/dp_male1.jpg" alt="'.$u.'" id="preview_dp" height="70px" width="50px"><div id="name">'.$f_name.''.$l_name.'<div><div>'.$log_username.'</div></div></div></div>';
}
}
$status_ui = '<div id="post_div1">';
	$status_ui .= '<p>Status</p>';
	$status_ui .= '<span id="status_span" style="float:right;"></span><hr />';
	$status_ui .= '<textarea id="text_post" rows="3"
	 cols="30" onkeyup="statusMax(this,250)" placeholder="What&#39;s new with you '.$u.'?"></textarea><hr />';
	$status_ui .= '<button id="post" onclick="postToStatus(\'status_post\',\'a\',\''.$u.'\',\'text_post\')">Post</button>';
	$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="CSS/style.css" rel="stylesheet" type="text/css">
<link href="CSS/style1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="JavaScript/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="JavaScript/js/jquery.form.min.js"></script>
<script type="text/javascript" src="JavaScript/script.js"></script>
<script type="text/javascript" src="JavaScript/ajax.js"></script>
<script type="text/javascript" src="JavaScript/jquery1.min.js"></script>
<style>
body {
	margin:0px;
	padding:0px;
	background-image:url("Users/<?php echo $log_username;?>/<?php echo $bglink;?>");
	background-attachment:fixed;

}
#body_top{
    margin-top:-20px;
	padding:0px;	
	margin-bottom:30px;
	position:fixed;
	width:100%;
	height:200px;
	z-index:1;
}
#body_middle{
	margin-left:20px;
	width:90px;
	
}
#post_div1{
	width:300px;
	height:180px;
	z-index:100;
	background:#999;
	border:thin solid #06C;
	border-radius:5px;
}
#body_middle_left{
	position:absolute;
	top:75px;
	width:300px;
	background-color:#FFF;
	height:200px;
	border:thin solid #039;
	border-radius:10px;
}
#body_main {
   	
}
#name{
	display:inline;
	margin-left:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;top:0;
}
#name_stng{
	display:inline;
	margin-left:7px;
	vertical-align:text-top;
	
	
	padding-top:10px;list-style:none;position:absolute;top:0;
}
#pic_preview {
	position:absolute;
	left:50px;
	top:50px;
	width:300px;
	color:#000;
	font-size:20px;
	font-weight:bolder;
}
#middle_left_lower{
	position:absolute;
	top:475px;
	width:300px;
	background-color:#FFF;
	height:300px;
	border:thin solid #039;
	border-radius:5px;
}

#middle_middle {
	position:absolute;
	top:75px;
	left:50%;
	background-color:#039;
	width:500px;
}
#arrow_include {
	position:absolute;
	top:285px;
	width:200px;
	
	height:200px;
	}
	#members_include{
		position:absolute;
	top:785px;
	width:300px;
	left:02%;
	background:#FFF;
	height:300px;
	border:thin solid #000;
	border-radius:5px;
	}
#middle_div {
	position:absolute;
	top:65px;
	left:350px;
	width:500px;
	background-color:#069;
}
#middle_div_post {
	height:200px;
	margin-bottom:10px;
	
}
#how_upper {
	height:30px;
	background-color:#000;
	color:#FFF;
	padding:15px;
	
}
#members {
	height:30px;
	background-color:#000;
	color:#FFF;
	padding:15px;
}
#message_include {
	position:absolute;
	top:20%;
	right:20%;
	
	
}

#messageInclude {
	position:absolute;
	top:15%;
	left:80%;
	z-index:1;
	
}
#group_div {
	position:absolute;
	top:75%;
	left:07%;
	
}
#middle_div{
	position:absolute;
	top:60px;
	left:15%;
	
}
#settingsInclude{
	position:absolute;
	top:40px;
}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

<script>
//getNews();
//function getNews(){
	//alert("");
	$(document).ready(function(){
 
	
	$('#middle_div').load("news_feed.php");
	//alert("hello");
});

</script>
</head>

<body onload="init();">
<div id="messageInclude"><?php include_once ('Test/annesha/message_div.php'); ?>

</div>


<div id="main">
<div>
<div id="body_top"><?php include_once('Test/annesha/header.php'); ?></div>
<div id="settingsInclude">
</div>

<div id="body_main">
<?php include 'group_pageTop.php'; ?>
<div id="body_middle"><div id="cp"><div id="body_middle_left">
<?php echo $cover_pic;?><?php echo $profile_pic;?></div></div><div id="arrow_include"><?php echo $status_ui;?></div><div id="middle_left_lower"><div id="how_upper">Friends</div></div><div id="middle_middle"><?php //echo $status_ui;?></div></div><div id="members">All Members<div id="members_include"></div></div>
<div id="middle_div"><?php //include 'Template/news_feed.php';?></div>

<div id="body_bottom"></div>
</div>
</div></div>

</body>
</html>