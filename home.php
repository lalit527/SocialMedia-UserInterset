<?php
 include_once ("Connection/check_logged_user.php");
 if($user_ok != true){
	 header("location: login.php");
	 exit();
 }
 
?>
<?php
   /* $sql = "SELECT code_access FROM useroptions WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$num  = mysqli_fetch_row($query);
	$num = $num[0];
	
	if($num != "" OR $num != NULL){
		header("location: login.php");
		exit();
	}*/
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
	$status_ui .= '<span id="status_span" style="float:right;"></span>';
	$status_ui .= '<textarea id="text_post" rows="3"
	 cols="28" onkeyup="statusMax(this,250)" onfocus="showExtra()" onblur="hideExtra()" placeholder="What&#39;s new with you '.$u.'?"></textarea>';
	 $status_ui .= '<div id="post_extra" style="display:none">';
	$status_ui .= '<button id="post" onclick="postToStatus(\'status_post\',\'a\',\''.$u.'\',\'text_post\')">Post</button>';
	$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div></div>';


$sql = "SELECT dplink FROM users WHERE username='$log_username'";
$query = mysqli_query($con,$sql);
$row_ownr = mysqli_fetch_row($query);
$dp_ownr = $row_ownr[0];
$dp_ownr_lnk = 'Users/'.$log_username.'/'.$dp_ownr.'';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ensemble</title>
<link href="CSS/style.css" rel="stylesheet" type="text/css">
<link href="CSS/style1.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="CSS/dialog.css">

<script type="text/javascript" src="JavaScript/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="JavaScript/js/jquery.form.min.js"></script>
<script type="text/javascript" src="JavaScript/script.js"></script>
<script type="text/javascript" src="JavaScript/ajax.js"></script>
<script type="text/javascript" src="JavaScript/jquery1.min.js"></script>
<script src="JavaScript/dialog.js"></script>

<script>
function showExtra(){
	_('post_extra').style.display = 'block';
	_('post_div1').style.height = '250';
}
function showBtn(x){
	$("#"+x).show();
	
}
function expand(x,y){
	// alert(""+x+y);
	    var b = document.getElementById(y);
		if(b.innerHTML == 'Collapse'){
			b.innerHTML = 'Expand';
			$("."+x).slideToggle("slow");
			exit();
		}
		
		if(b.innerHTML == 'Expand'){
		    b.innerHTML = 'Collapse';
			$("."+x).slideToggle("slow");
			exit();
		}
		
    
  
		//_(x).style.display = 'block';
		
}
function showPostDiv(){
		_('postbutton_div').style.display = 'block';
		//_('post_div1').style.height = '180';
	}
function showPhoto(){
	alert("hello");
}
</script>
<style>
#rply_pst{
	display:none;
	
}
#post_div1{
	width:250px;
	height:120px;
	z-index:100;
	background:#999;
	border:thin solid #06C;
	
    
	border-radius:5px;
	border-top-left-radius:0;
	border-top-right-radius:0;
}

#statusBtn {
   width:70px;
   height:50px;
   font-family: Arial, Helvetica, sans-serif;
   font-weight:200px;
   float:right;	
}
img.friendpics{border:#000 1px solid; width:40px; height:40px; margin:2px;}
#post_div {
	width: 50%;
	margin-right: auto;
	margin-left: auto;
	margin-top: 50px;
	background: #CCC;
	padding: 10px;
	border-radius: 10px;
	box-shadow: 1px 1px 3px #AAA;
}
.btn_rply{
	display:none;
	
}
#select_post {
	position:relative;
    width:80px;
  height:30px;	
    left:70%;

}


</style>

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
#body_middle_left{
	position:absolute;
	top:75px;
	width:250px;
	background-color:#FFF;
	height:200px;
	border:thin solid #039;
	border-radius:10px;
	border-bottom:0;
	border-bottom-left-radius:0;
	border-bottom-right-radius:0;
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
	width:200px;
	color:#000;
	font-size:20px;
	font-weight:bolder;
}
#middle_left_lower{
	position:absolute;
	top:325px;
	width:220px;
	background-color:#FFF;
	height:300px;
	border:thin solid #039;
	border-radius:5px;
}
#middle_left_lower1{
	position:absolute;
	top:75px;
	left:800px;
	width:200px;
	background-color:#FFF;
	height:350px;
	border:thin solid #039;
	border-radius:5px;
}
#how_upper1 {
	height:30px;
	background-color:#000;
	color:#FFF;
	padding:15px;
}

#status_home{
	position:absolute;
	
	top:275px;
	width:220px;
}
#middle_middle {
	position:absolute;
	top:75px;
	left:30%;
	background-color:#039;
	width:500px;
}
#arrow_include {
	position:absolute;
	top:435px;
	width:150px;
	
	height:300px;
	}
#middle_div {
	position:absolute;
	top:70px;
	left:27%;
	width:500px;

	
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
	
}
#settingsInclude{
	position:absolute;
	top:40px;
}
#rply_pst{
	display:none;
	
}
#statusBtn {
   width:70px;
   height:50px;
   font-family: Arial, Helvetica, sans-serif;
   font-weight:200px;
   float:right;	
}
img.friendpics{border:#000 1px solid; width:40px; height:40px; margin:2px;}
#post_div {
	width: 50%;
	margin-right: auto;
	margin-left: auto;
	margin-top: 50px;
	background: #CCC;
	padding: 10px;
	border-radius: 10px;
	box-shadow: 1px 1px 3px #AAA;
}
.btn_rply{
	display:none;
	
}
#select_post {
	position:relative;
    width:80px;
  height:30px;	
    left:70%;

}
#post {
  background: #039;
  float:right;
  border: 1px solid;
  border-radius: 4px;
  width:50px;
  height:30px;	
}
#post_div {
	width: 500px;
	background: #E1E1E1;
	padding: 10px;
	border-radius: 10px;
	box-shadow: 1px 1px 3px #AAA;
	position:absolute;
	top:60%;
	left:40%;
	
}
textarea#statustext{width:500px; padding:8px; border:#999 1px solid; font-size:16px;}
div.status_boxes{padding:5px; line-height:1.2em;width:500px;

	
}
div.status_boxes > div{padding:8px; border:#99C20C 1px solid; background: #F4FDDF;		
border:thin solid #999;
	border-radius:5px;
	
    
}
div.status_boxes > div > b{font-size:12px;}
div.status_boxes > button{padding:5px; font-size:12px;}
textarea.rply_pst{width:400px; padding:1%; border:#999 1px solid;border:thin solid #999;
	border-radius:5px;
}
div.reply_boxes{padding:12px; border:#999 1px solid; background:#F5F5F5;width:470px;border:thin solid #999;
	border-radius:5px;
}
div.reply_boxes > div > b{font-size:12px;}
#statusarea{
	width:530px;
	position:absolute;
	top:20%;
	left:30%;
	
    margin-top:10px;
	
}
#post_box{
	
	width:500px;
	border:thin solid #999;
	border-radius:5px;
	background-color:#E1E1E1;
    margin-bottom:0;
}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script>
function showBtn(x){
	$("#"+x).show();
	
}
function expand(x,y){
	// alert(""+x+y);
	    var b = document.getElementById(y);
		if(b.innerHTML == 'Collapse'){
			b.innerHTML = 'Expand';
			$("."+x).slideToggle("slow");
			exit();
		}
		
		if(b.innerHTML == 'Expand'){
		    b.innerHTML = 'Collapse';
			$("."+x).slideToggle("slow");
			exit();
		}
		
    
  
		//_(x).style.display = 'block';
		
}
function showPostDiv(){
		_('postbutton_div').style.display = 'block';
	}
function showPhoto(){
	alert("hello");
}
</script>
<script>
function yHandler(){
	
	var wrap = _('middle_div');
	var contentHeight = wrap.offsetHeight;
	var yOffset = window.pageYOffset; 
	var y = yOffset + window.innerHeight;
	if(y >= contentHeight){
		//alert(x);
		var ajax = ajaxObj("POST","news_feed.php");
	
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
	        //alert(ajax.returnText);
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			
			var datArray = response.split("|");
		$(wrap).append(datArray[1]);
		x = datArray[0];
		}
	}
	ajax.send("action=getmore&statusshown="+x);
	}
}
window.onscroll = yHandler;

</script>
<script>
var x;
var z = 0;

function init(){
	//alert(self_post);
	var ajax = ajaxObj("POST","news_feed.php");
	
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			
			
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			
			var datArray = response.split("|");
			$('#middle_div').prepend(datArray[1]);
			var result = datArray[0].split("^");
			//alert(result[0]+result[1]);
			//var currentHTML = _('middle_div').innerHTML;
			//_('middle_div').innerHTML = datArray[1]+currentHTML;
			z=result[0];
			if(typeof x === "undefined"){
				x =  result[1];
			}
			
			
		}
		
	}
	ajax.send("status_id="+z+"self_post="+self_post);
	var t = setTimeout(function(){init()},20000);
}
</script>
<script>
function replyToStatus(sid,user,ta,btn){
	//alert("");
	var data = _(ta).value;
	alert(sid+user+ta+btn);
	if(data == ""){
		var alrt = Alert.render("Reply cannot be empty");
		return false;
	}
	_("replyBtn_"+sid).disabled = true;
	var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true){
			var datArray = ajax.responseText.split("|");
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "reply_ok"){
				var rid = datArray[1];
				data = data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
				var currentHTML = _("replies_"+sid).innerHTML; 
				_("replies_"+sid).innerHTML = '<div id="reply_'+sid+'" class="reply_boxes"><img class="friendpics" src="<?php echo $dp_ownr_lnk;?>" alt="<?php echo $log_username;?>" title="<?php echo $log_username;?>" ><div style="display:inline;margin-left:7px;vertical-align:text-top;padding:0;list-style:none;position:absolute;font-size:12px;margin-bottom:0;"><a href="users.php?u=<?php echo $log_username;?>"><?php echo $f_name." ". $l_name;?>@<?php echo $log_username;?></a><br />just now: <span id="srdb_'+rid+'"><a href="#" onclick="return false;" onmousedown="deleteReply(\''+rid+'\',\'reply_'+rid+'\');" title="DELETE THIS COMMENT">remove</a></span></div><br />'+data+'</div>'+currentHTML;
				
				
				_("replyBtn_"+sid).disabled = false;
				_(ta).value = "";
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=status_reply&sid="+sid+"&user="+user+"&data="+data);
}

function showGal(x,y,z){
	//alert(x+y+z);
	
	//window.location = "photo.php?name="+z+"&gallery="+x+"&file="+y;
	$('.all').fadeOut();
	//$('#pageUpperInclude').fadeOut();
	$('#photoShow_div').load("photo.php?name="+z+"&gallery="+x+"&file="+y).fadeIn();
}
function showVGal(x,y){
	//alert(x+y+z);
	
	//window.location = "video.php?name="+y+"&file="+x;
	$('.all').fadeOut();
	//$('#pageUpperInclude').fadeOut();
	$('#photoShow_div').load("video.php?name="+y+"&file="+x).fadeIn();
}
function closeCanvas(){
	$('#photoShow_div').fadeOut();
	$('.all').fadeIn();
	//$('#pageUpperInclude').fadeIn();
	
}

</script>
<script>
var self_post = 0;
function postToStatus(action,type,user,ta){
//alert("");


var data = _(ta).value;
//alert(data);
	if(data == ""){
		var alrt = Alert.render("Status cannot be empty");
	
		//alert("Type something first weenis");
		return false;
	}
	//alert(type);
//_("post").disabled = true;
	var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			//var response = .replace(/^\s+|\s+$/g, "");
			var datArray = ajax.responseText.split("|");
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "post_ok"){
				var sid = datArray[1];
				self_post = sid;
				data = data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
				//var currentHTML = _("statusarea").innerHTML;
				//_("statusarea").innerHTML = 
				$('#middle_div').prepend('<div id="status_'+sid+'" class="status_boxes"><div class="post_box" id="postBox_'+sid+'" onmouseout="chBBcolor(\'postBox_'+sid+'\')" onmouseover="changeBBcolor(\'postBox_'+sid+'\')" onclick="gotoPost(\'postBox_'+sid+'\',\'postBox_'+user+'\')"><img src="<?php echo $dp_ownr_lnk;?>" title="'+user+'" height="70px" width="50px" > <a href="users.php?u=<?php echo $log_username;?>"><div style="display:inline;margin-right:7px;vertical-align:text-top;padding:0;list-style:none;position:absolute;"><?php echo $f_name. " " .$l_name; ?><div>@'+user+'</a></div>	<div> just now: <span id="sdb_'+sid+'"><a href="#" onclick="return false;" onmousedown="deleteStatus(\''+sid+'\',\'status_'+sid+'\');" title="DELETE THIS STATUS AND ITS REPLIES">delete status</a></span> &nbsp; &nbsp;</div></div><br /><br />'+data+'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'+sid+'\',\'btn_tgl'+sid+'\')" id="btn_tgl'+sid+'">Expand</a></div></div><div id="rply_pst" class="rply_pst'+sid+'"><img class="friendpics" src="<?php echo $dp_ownr_lnk;?>" alt="<?php echo $log_username;?>" title="<?php echo $log_username;?>"><textarea id="replytext_'+sid+'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'+sid+'\')"></textarea><button id="replyBtn_'+sid+'" onclick="replyToStatus('+sid+',\'<?php echo $log_username;?>\',\'replytext_'+sid+'\',this)" class="btn_rply">Reply</button></div></div>');
			
				
				
				_("post").disabled = false;
				_(ta).value = "";
			} else {
				alert(ajax.responseText);
			}
		}
	}
	ajax.send("action="+action+"&type="+type+"&user="+user+"&data="+data);
	}
	
</script>

</head>

<body onload="init()">
<div id="messageInclude"><?php include_once ('Test/annesha/message_div.php'); ?>

</div>


<div id="main" class="all">
<div>
<div id="body_top"><?php include_once('Test/annesha/header.php'); ?></div>
<div id="settingsInclude">
</div>

<div id="body_main">
<?php include 'group_pageTop.php'; ?>
<div id="body_middle"><div id="cp"><div id="body_middle_left">
<?php echo $cover_pic;?><?php echo $profile_pic;?></div></div><div id="status_home"><?php echo $status_ui;?></div><div id="arrow_include"><?php include_once('Test/annesha/arrow.php'); ?></div><div id="middle_left_lower"><div id="how_upper">Treanding</div></div></div>
<div id="middle_div" ><?php //include 'news_feed.php';?><?php //include_once 'extra_news.php';?></div>
<div id="middle_left_lower1"><div id="how_upper1">Treanding</div></div></div>
<div id="body_bottom"></div>
</div>
</div></div>
<div id="chat_box_home"></div>
<?php include_once("Template/dialog.php"); ?>
<div id="photoShow_div"></div>
</body>
</html>