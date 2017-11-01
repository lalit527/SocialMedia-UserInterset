<?php
include_once ("Connection/check_logged_user.php");
    if($user_ok != true){
		exit();
	}
?>
<?php
include_once ("Connection/check_logged_user.php");
include_once ("TimeStamp/time_ago.php");
$timeAgoObject = new convertToAgo;

$u = "";
$profile_pic = "";
$profile_pic_btn = "";
$profile_form = "";
$cover_pic = "";
$cover_pic_btn = "";
$cover_form = "";
$name = "";
$joindate = "";
$dplink = "";
$bg_form = "";
$bg_pic_btn = "";
$name_id = "";
$cplink = "";
$bglink = "";
$isOwner = "no";
$cover_pic = "";
if(!isset($_GET['id_get'])) {
	//header("location: http:index.php");	
	//exit();
	
	
}
else {
   $id_get = preg_replace('#[^a-z0-9]#i','',$_GET['id_get']);
   //$type = preg_replace('#[^a-z0-9]#i','',$_GET['type']);


$sql = "SELECT * FROM likes WHERE name_id='$id_get' LIMIT 1";

$user_query = mysqli_query($con,$sql);

$numuser = mysqli_num_rows($user_query);

if($numuser < 1){
	
	echo "This user is not yet activated";
	exit();
}


/*if($u == $log_username && $user_ok == true){
	$isOwner = "yes";
    $profile_pic_btn = '<a href="#" onmousedown="showOption(\'profile_form\')" 
	onclick="return false">Change Profile Pic</a>';
	$profile_form = '<form id="profile_form" enctype="multipart/form-data" action="Parser/photo_system.php" method="post" onSubmit="return false">';
	$profile_form .= '<h4>Change your Profile Pic</h4>';
	$profile_form .= '<input type="file" name="profile" id="profile" required>';
	$profile_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$profile_form .= '</form>';	
	//toggleElement(\'profile_form\')
    $cover_pic_btn = 
	'<button  
	onclick="showOption(\'cover_form\')">Change Cover Pic</button>';
	$cover_form = '<form id="cover_form" enctype="multipart/form-data" action="Parser/photo_system.php" method="post" onSubmit="return false">';
	$cover_form .= '<h4>Change your Cover Pic</h4>';
	$cover_form .= '<input type="file" name="profile1" id="profile1" required>';
	$cover_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$cover_form .= '</form>';	
	
	
}*/
while ($row = mysqli_fetch_array($user_query,MYSQLI_ASSOC)) {
	
	$id = $row['id'];
	$name = $row['name'];
	$dplink = $row['pic'];
	$cplink = $row['c_pic'];
	$bglink = $row['back'];
	$type = $row['type'];
	$name_id = $row['name_id'];
	$creator = $row['creator'];
	$created = $row['created'];
	
	
$profile_pic = '<div id="pic_preview"><img src="likes/'.$name_id.'/'.$dplink.'" alt="'.$name.'" id="preview_dp" ></div>';
$cover_pic = '<div id="cp_preview"><img src="likes/'.$name_id.'/'.$cplink.'" alt="'.$name.'" id="preview_cp" ></div>';

}
if($creator == $log_username){
	//$isOwner = "yes";
    $profile_pic_btn = '<a href="#" onmousedown="showOption(\'profile_form\')" 
	onclick="return false">Change Profile Pic</a>';
	$profile_form = '<form id="profile_form" enctype="multipart/form-data" action="Parser/likrephoto_system.php" method="post" onSubmit="return false">';
	$profile_form .= '<h4>Change your Profile Pic</h4>';
	$profile_form .= '<input type="file" name="profile" id="profile" required>';
	$profile_form .= '<input type="text" name="name_id" id="txt" value="'.$id_get.'" style="display:none">';
	$profile_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$profile_form .= '</form>';	
	//toggleElement(\'profile_form\')
    $cover_pic_btn = 
	'<button  
	onclick="showOption(\'cover_form\')">Change Cover Pic</button>';
	$cover_form = '<form id="cover_form" enctype="multipart/form-data" action="Parser/like_cover_system.php" method="post" onSubmit="return false">';
	$cover_form .= '<h4>Change your Cover Pic</h4>';
	$cover_form .= '<input type="file" name="profile" id="profile1" required>';
	$cover_form .= '<input type="text" name="name_id" id="txt" value="'.$id_get.'" style="display:none">';

	$cover_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$cover_form .= '</form>';	
	
	
	$bg_pic_btn = '<a href="#" onmousedown="showOption(\'bg_form\')" 
	onclick="return false">Change Theme</a>';
	$bg_form = '<form id="bg_form" enctype="multipart/form-data" method="post"  action="Parser/like_bg.php" onSubmit="return false">';
	$bg_form .= '<h4>Change your Profile Pic</h4>';
	$bg_form .= '<input type="file" name="profile" id="background_input" required>';
	$bg_form .= '<input type="text" name="name_id" id="txt" value="'.$id_get.'" style="display:none">';
	$bg_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$bg_form .= '</form>';	
	
	
	
	$account_setting = '<div id="setting_div"><img src="Images/setting.png" alt="setting" id="setting_pic" style="width:30px;height:30px" onmousedown="showOption()"></div>';
	$account_setting .= '<div id="stngHvr_div"><nav><ul><li>hello</li><hr /><li>setting</li><hr /><li>account</li></ul></nav></div>';
	$logout = '<div id="logout_div"><a href="logout.php">Log Out</a></div>';
	$notification = '<div id="notify_div"><a href="notifications.php">Notification</a></div>';
	$message_btn = '<div id="msg_div"><a href="#" onmousedown="showOption(\'profile_form\')" 
	onclick="return false">Message</a></div>';
    	
	/*$post = '<div id="post_div"><p><input type="button" id="status_button" value="Status"></button><span id="status_span" style="float:right;"></span></p><hr /><form id="post_form" onSubmit="return false;"><textarea rows="5" cols="60" id="post_text"></textarea><hr /><select id="select_post"><option><div id="public_post_div">llllllll<img src="Images/blue.jpg"></div></option></select><input type="submit" id="post" value="post" onclick="postStatus()"><p>fffffffff</p></form></div>
';*/
}

}
?><?php
  /*
  $sql = "SELECT username FROM likesmembers WHERE name_id='$id_get'";
  $query = mysqli_query($con,$sql);
  $numrows = mysqli_num_rows($query);
  if($numrows > 0){
	  while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		  $mem = $row['username'];
		  $sql = "SELECT dplink,firstname,lastname FROM users WHERE username='$mem' LIMIT 1";
		  $query = mysqli_query($con,$sql);
		  $num = mysqli_fetch_row($query);
		  $pic = $num[0];
		  $fname = $num[1];
		  $lname = $num[2];
		  $memimage = '<a href="users?u="'.$mem.'><img src="Users/'.$mem.'/'.$pic.'" ></a>';
		  $likes_list .= '<a href="users?u="'.$mem.'><img src="Users/'.$mem.'/'.$pic.'" ><div>'.$fname.''.$lname.'</div>@'.$mem.'</a>';
	  }
  }
*/
?>
<?php
  $liked = false;
  $sql = "SELECT id FROM likesmembers WHERE username='$log_username' AND name_id='$name_id' LIMIT 1";
  $query = mysqli_query($con,$sql);
  $numrow = mysqli_num_rows($query);
  if($numrow > 0){
	  $liked = true;
  }
  if($liked == true){
  $like_btn = '<button onclick="gotoUnlike(\''.$id_get.'\',\''.$creator.'\')">unlike</button>';
  }else{
	$like_btn = '<button onclick="gotoLike(\''.$id_get.'\',\''.$creator.'\')">like</button>';  
  }
?>
<?php

$status_ui = "";
$statuslist = "";

	$status_ui = '<div id="post_div">';
	$status_ui .= '<p>Compose new Post</p>';
	$status_ui .= '<span id="status_span" style="float:right;"></span>';
	$status_ui .= '<textarea id="text_post" rows="5"
	 cols="60" onkeyup="statusMax(this,250)" onfocus="showPostDiv()" placeholder="Say something about '.$name.'?"></textarea>';
	 $status_ui .= '<div id="postbutton_div" style="display:none">';
	$status_ui .= '<button id="post" onclick="postToStatusLikes(\'status_post\',\'a\',\''.$name.'\',\'text_post\')">Post</button>';
	$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div></div>';
/* else if($isFriend == true && $log_username != $u){
	$status_ui = '<textarea id="text_post" onkeyup="statusMax(this,250)" placeholder="Hi '.$log_username.', say something to '.$u.'"></textarea>';
	$status_ui .= '<button id="post" onclick="postToStatus(\'status_post\',\'c\',\''.$u.'\',\'text_post\')">Post</button>';
}
?><?php 
$sql = "SELECT * FROM status WHERE account_name='$u' AND type='a' OR account_name='$u' AND type='c' ORDER BY postdate DESC LIMIT 20";
$query = mysqli_query($con, $sql);
$statusnumrows = mysqli_num_rows($query);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$statusid = $row["id"];
	$account_name = $row["account_name"];
	$author = $row["author"];
	$postdate = $row["postdate"];
	$data = $row["data"];
	$data = nl2br($data);
	$data = str_replace("&amp;","&",$data);
	$data = stripslashes($data);
	$statusDeleteButton = '';
	if($author == $log_username || $account_name == $log_username ){
		$statusDeleteButton = '<span id="sdb_'.$statusid.'"><a href="#" onclick="return false;" onmousedown="deleteStatus(\''.$statusid.'\',\'status_'.$statusid.'\');" title="DELETE THIS STATUS AND ITS REPLIES">delete status</a></span> &nbsp; &nbsp;';
	}
	$convertedTime = ($timeAgoObject -> convert_dateTime($postdate));
	$when_post = ($timeAgoObject -> makeAgo($convertedTime));
	// GATHER UP ANY STATUS REPLIES
	$status_replies = "";
	$sql = "SELECT * FROM status WHERE osid='$statusid' AND type='b' ORDER BY postdate ASC";
	$query_replies = mysqli_query($con, $sql);
	$replynumrows = mysqli_num_rows($query_replies);
    if($replynumrows > 0){
        while ($row2 = mysqli_fetch_array($query_replies, MYSQLI_ASSOC)) {
			$statusreplyid = $row2["id"];
			$replyauthor = $row2["author"];
			$replydata = $row2["data"];
			$replydata = nl2br($replydata);
			$replypostdate = $row2["postdate"];
			$replydata = str_replace("&amp;","&",$replydata);
			$replydata = stripslashes($replydata);
			$replyDeleteButton = '';
			if($replyauthor == $log_username || $account_name == $log_username ){
				$replyDeleteButton = '<span id="srdb_'.$statusreplyid.'"><a href="#" onclick="return false;" onmousedown="deleteReply(\''.$statusreplyid.'\',\'reply_'.$statusreplyid.'\');" title="DELETE THIS COMMENT">remove</a></span>';
			}
			$convertedTime_reply = ($timeAgoObject -> convert_dateTime($replypostdate));
	$when_reply = ($timeAgoObject -> makeAgo($convertedTime_reply));
            $sql_rply = "SELECT dplink FROM users WHERE username='$replyauthor' LIMIT 1";
			$query_rply = mysqli_query($con,$sql_rply);
			$result_rply = mysqli_fetch_row($query_rply);
			$result_reply_dp = $result_rply[0];
			//echo $result_reply_dp;
			$replyauthor_pic = 'Users/'.$replyauthor.'/'.$result_reply_dp.'';
			$status_replies .= '<div id="reply_'.$statusreplyid.'" class="reply_boxes"><div><b><img class="friendpics" src="'.$replyauthor_pic.'" alt="'.$replyauthor.'" title="'.$replyauthor.'">Reply by <a href="users.php?u='.$replyauthor.'">'.$replyauthor.'</a> '.$when_reply.':</b> '.$replyDeleteButton.'<br />'.$replydata.'</div></div>';
        }
    }
	$sql_post = "SELECT dplink FROM users WHERE username='$author' LIMIT 1" ;
	$query_post = mysqli_query($con,$sql_post);
	$result_post = mysqli_fetch_row($query_post);
	$result_author_dp = $result_post[0];
	$author_pic = 'Users/'.$author.'/'.$result_author_dp.'';
	
	$statuslist .= '<div id="status_'.$statusid.'" class="status_boxes"><div><b><img class="friendpics" src="'.$author_pic.'" alt="'.$author.'" title="'.$author.'">Posted by <a href="users.php?u='.$author.'">'.$author.'</a> '.$when_post.':</b> '.$statusDeleteButton.' <br />'.$data.'</div>'.$status_replies.'</div>';
	if($isFriend == true || $log_username == $u){
	    $statuslist .= '<textarea id="replytext_'.$statusid.'" class="replytext" onkeyup="statusMax(this,250)" placeholder="write a comment here"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)">Reply</button>';	
		
	}
}
*/

?><?php
    $member_html = "";
	$frnd_html = "";
	$inv = "";
	$x = "";
    $sql  = "SELECT username FROM likesmembers WHERE name_id='$id_get'";
	$query = mysqli_query($con,$sql);
	$num_mem = mysqli_num_rows($query);
	if($num_mem > 0){
		while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
			$members = $row['username'];
			$x .= $members;
			$sql_pic = "SELECT dplink,firstname,lastname FROM users WHERE username='$members' LIMIT 1";
			$query_pic = mysqli_query($con,$sql_pic);
			$num_pic = mysqli_fetch_row($query_pic);
			$pic = $num_pic[0];
			$f = $num_pic[1];
			$l = $num_pic[2];
			$member_html .= '<div id="" class="image_div"><a href="users.php?u='.$members.'"><img src="Users/'.$members.'/'.$pic.'" style="width:70px;height:70px;"><div class="text-div" style="text-align:bottom">'.$f.' '.$l.'</a></div></div>';
			$sql_frnd = "SELECT COUNT(id) FROM friends WHERE user1='$members' AND user2='$log_username' OR user1='$log_username' AND user2='$members' LIMIT 1";
			$query_frnd = mysqli_query($con,$sql_frnd);
			$num_frnd = mysqli_fetch_row($query_frnd);
			$num_frnd = $num_frnd[0];
			
			if($num_frnd > 0){
				$frnd_html .= '<div id="" class="image_div"><a href="users.php?u='.$members.'"><img src="Users/'.$members.'/'.$pic.'" style="width:70px;height:70px;"><div class="text-div" style="text-align:bottom">'.$f.' '.$l.'</a></div></div>';
			}else{
				if($members != $log_username){
				$inv = '<div id=""><img src="Users/'.$members.'/'.$pic.'" style="width:70px;height:70px;"><button>invite</button></div>';
				}
			}
			
		}
	}
?><?php
    /*$all_friends = array();
    $sql = "SELECT user2 FROM friends WHERE user1='$log_username' AND accepted='1'";
	$query = mysqli_query($con,$sql);
	$numrow = mysqli_num_rows($query);
	if($numrow > 0){
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		array_push($all_friends, $row["user2"]);
	}
	}
	$sql = "SELECT user1 FROM friends WHERE user2='$log_username' AND accepted='1'";
	$query = mysqli_query($con,$sql);
	$numrow = mysqli_num_rows($query);
	if($numrow > 0){
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		array_push($all_friends, $row["user1"]);
	}
	}
	$orLogic = '';
	foreach($all_friends as $key => $user){
			$orLogic .= "username='$user' OR ";
	}
	$orLogic = chop($orLogic, "OR ");
	$sql = "SELECT id FROM likesmembers WHERE name_id='$id_get' AND $orLogic";
    $query = mysqli_query($sql);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		
	}*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $name; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="CSS/dialog.css">
<link rel="stylesheet" href="CSS/user_style.css">
<script src="JavaScript/googleapis.js"></script>
<script src="JavaScript/script.js"></script>
<script src="JavaScript/ajax.js"></script>
<script src="JavaScript/dialog.js"></script>
<script src="JavaScript/user_script.js"></script>

<script type="text/javascript" src="JavaScript/jquery1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

<script>
//$("body").css("background-image", "url('likes/setme.png')");
	function showAbout(){
		
		_('div_user').style.display = 'none';
		_('tina_about').style.display = 'block';
	}
	function showWall(){
		
		_('tina_about').style.display = 'none';
		_('div_user').style.display = 'block';
	}
	function showPostDiv(){
		_('postbutton_div').style.display = 'block';
	}
	function postToStatus(action,type,user,ta){
		alert("");
	var data = _(ta).value;
	if(data == ""){
		var alrt = Alert.render("Status cannot be empty");
	
		//alert("Type something first weenis");
		return false;
	}
	//alert(type);
	_("post").disabled = true;
	var ajax = ajaxObj("POST", "Parser/likePost_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			//var response = .replace(/^\s+|\s+$/g, "");
			var datArray = ajax.responseText.split("|");
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "post_ok"){
				var sid = datArray[1];
				data = data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
				var currentHTML = _("statusarea").innerHTML;
				_("statusarea").innerHTML = '<div id="status_'+sid+'" class="status_boxes"><div><b>Posted by you just now:</b> <span id="sdb_'+sid+'"><a href="#" onclick="return false;" onmousedown="deleteStatus(\''+sid+'\',\'status_'+sid+'\');" title="DELETE THIS STATUS AND ITS REPLIES">delete status</a></span><br />'+data+'</div></div><textarea id="replytext_'+sid+'" class="replytext" onkeyup="statusMax(this,250)" placeholder="write a comment here"></textarea><button id="replyBtn_'+sid+'" onclick="replyToStatus('+sid+',\'<?php echo $likes; ?>\',\'replytext_'+sid+'\',this)">Reply</button>'+currentHTML;
				alert(<?php echo $likes; ?>);
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
<script type="text/javascript" src="JavaScript/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="JavaScript/js/jquery.form.min.js"></script>
<script>
function showE(){
	alert("hello");
	 var x =$('body').css('background-image', 'url("")');
	var y = x.val();
	alert(y);
	
	var profile = _("profile_bg").files[0];
	var name_id = _('txt').value;
	   
	/*var formData = new FormData(this);
	var ajax = ajaxObj("POST","Parser/like_bg.php");
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			alert(ajax.responseText);
		}
		
	}
	ajax.submit(formdata);
	
	*/

	
}
</script>
<script type="text/javascript">

window.onload=function() {
}

</script>


<script type="text/javascript">
$(document).ready(function() { 
    //var x =$('body').css('background-image', 'url("'++'")');
	//var y = x.val();
	
	var options = { 
			target : '#cp_preview',   
			resetForm: true         
		}; 
		
	 $('#cover_form').change(function() { 
			$(this).ajaxSubmit(options);  			 
			return false; 
		});
});
</script>

<script type="text/javascript">
$(document).ready(function() { 
  
	var options = { 
			target:   '#pic_preview',    
			resetForm: true         
		}; 
		
	 $('#profile_form').change(function() { 
			$(this).ajaxSubmit(options);  			 
			return false; 
		});
 
//when upload progresses	
/*function OnProgress(event, position, total, percentComplete)
{
	//Progress bar
	progressbar.width(percentComplete + '%') //update progressbar percent complete
	statustxt.html(percentComplete + '%'); //update status text
	if(percentComplete>50)
		{
			statustxt.css('color','#fff'); //change status text to white after 50%
		}
}

//after succesful upload
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{

		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		
		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
		
		//Progress bar
		progressbox.show(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color','#000'); //initial color of status text

				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}*/

}); 

</script>
<link href="CSS/style.css" rel="stylesheet" type="text/css"><script>
/*function ajaxFileUpload(upload_file){
	var filename = upload_file.files;
	alert(filename);
	_('picture_preview').innerHTML = '<div><image src="Images/blue.jpg" border="0" </div>';
	//upload_field.form.action = 'Parser/photo_system.php';
	var ajax = ajaxObj("POST","Parser/photo_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			alert(ajax.responseText);
			}
	}
	ajax.send();
	
}*/
function postToStatusLikes(action,type,user,ta){
	alert("");
	var data = _(ta).value;
	if(data == ""){
		var alrt = Alert.render("Status cannot be empty");
	
		//alert("Type something first weenis");
		return false;
	}
	//alert(type);
	_("post").disabled = true;
	var ajax = ajaxObj("POST", "Parser/likePost_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			//var response = .replace(/^\s+|\s+$/g, "");
			var datArray = ajax.responseText.split("|");
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "post_ok"){
				var sid = datArray[1];
				data = data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
				var currentHTML = _("statusarea").innerHTML;
				_("statusarea").innerHTML = '<div id="status_'+sid+'" class="status_boxes"><div><b>Posted by you just now:</b> <span id="sdb_'+sid+'"><a href="#" onclick="return false;" onmousedown="deleteStatus(\''+sid+'\',\'status_'+sid+'\');" title="DELETE THIS STATUS AND ITS REPLIES">delete status</a></span><br />'+data+'</div></div><textarea id="replytext_'+sid+'" class="replytext" onkeyup="statusMax(this,250)" placeholder="write a comment here"></textarea><button id="replyBtn_'+sid+'" onclick="replyToStatus('+sid+',\'<?php echo $u; ?>\',\'replytext_'+sid+'\',this)">Reply</button>'+currentHTML;
				alert(<?php echo $u; ?>);
				_("post").disabled = false;
				_(ta).value = "";
			} else {
				alert(ajax.responseText);
			}
		}
	}
	ajax.send("action="+action+"&type="+type+"&user="+user+"&data="+data);
}

//window.onload = init1;
/*function(){
	alert("hello");
	var ajax = ajaxObj("POST", "message_system/message_system.php");
	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			alert(""+ajax.responseText);
			var response = ajax.responseText;
			var datArray = response.split(|);
			
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "hello"){
				
				
				_('message_middle').innerHTML = datArray[1];
			} else {
				_('message_middle').innerHTML = ajax.responseText;
				alert(ajax.responseText);
			}
		}
	}
	
	ajax.send("action=readall");

	
};*/
</script>
<style>
body {
	margin: 0 auto;
  
	padding: 0;
	width: 100%;
	font-family: Arial, Helvetica, sans-serif;
	color:#666666;
	background-image:url("likes/<?php echo $name_id;?>/<?php echo $bglink;?>");
	background-attachment:fixed;
  
	background-size: cover;
  background-position: center center;
	
}
#image_div {
	position: relative;
	
}
#text_div {
	position: absolute; 
   top: 50px; 
   left: 0;
   text-decoration:none;
}
div#profile_pic_box{float:right; border:#999 2px solid; width:180px; height:200px; margin:-170px 20px 0px 0px; overflow:hidden;border:07px solid #333;z-index:1;
position:relative;}

div#profile_pic_box > img{ }
#preview_cp{
	
	width:900px; height:300px;
}
div#cp_box > form{
	display:none;
	position:absolute; 
	z-index:3000;
	opacity:.8;
	background:#F0FEC2;
	width:180px;
	height:100px;
	overflow:hidden;
}
div#profile_pic_box:hover button {
    display: block;
}


div#profile_pic_box{float:right; border:#999 2px solid; width:180px; height:200px; margin:-170px 20px 0px 0px; overflow:hidden;border:07px solid #333;z-index:1;
position:relative;}
div#profile_pic_box > img{ width:180px; height:200px;z-index:1;}
#preview_dp{
	
	width:180px; height:200px;
	
}
#pic_preview{
	float:right; border:#999 2px solid; width:180px; height:200px; margin:00px 00px 0px 0px; overflow-y:hidden;overflow:hidden;
	width:180px; height:200px;
	
}


#preview_cp{
	
	
	width:900px; height:300px;
}
div#cp_box > button {
	display: none;
	position:absolute; 
	margin:120px 0px 0px 30px;
	z-index:3000;
	background:#D8F08E;
	border:#81A332 1px solid;
	border-radius:3px;
	padding:0px;
	font-size:12px;
	text-decoration:none;
	color:#60750B;
}
div#cp_box > form{
	display:none;
	position:absolute; 
	z-index:3000;
	
	background:#F0FEC2;
	overflow:hidden;
}
div#cp_box:hover button {
    display: block;
}


#cp_box {
	width:900px;
	height:300px;
	border:thin solid #000;
	margin-left:20px;
	
	background-color:#999;
	position:absolute;
	top:08%;
	
    }
#cp_namedddddd {
	width:50px;
	height:10px;
	margin:105px 100px 0px 0px;
}
#cp_lower{
	width:900px;
	height:50px;
	border:thin solid #000;
	margin-top:0px;
}
#pageUpperInclude {
	margin-top:-40px;
	padding:0;
	position:fixed;
	width:100%;
	magrin-bottom:0px;
	z-index:1000;
}
#messageInclude {
	position:fixed;
	top:15%;
	left:80%;
	z-index:1;
	
}
#tina_about{
	position:absolute;
	top:70%;
}
#about_header
{
	list-style-type:none;
margin:0;
padding:0;

}
#about_li
{
float:left;
}
#about_a:link,#about_a:visited
{
display:block;
width:160px;
height:40px;
font-weight:bold;
color:#FFFFFF;
background-color:#98bf21;
text-align:center;
padding:4px;
text-decoration:none;
text-transform:uppercase;
}
#about_a:hover,#about_a:active
{
background-color:#7A991A;
}
#basic_info {
	height:300px;
	width:300px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:65%;
	left:05%;
	background-color:#E1E1E1;
	z-index:0;
	
}
#action_with {
	height:200px;
	display:none;
	width:400px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:70%;
	left:20%;
	background-color:#999;
}
#friends_divshow {
	
	height:200px;
	
	width:300px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:165%;
	left:05%;
	background-color:#E1E1E1;

}
#post_div {
	width: 500px;
	background: #E1E1E1;
	padding: 10px;
	border-radius: 10px;
	box-shadow: 1px 1px 3px #AAA;
	position:absolute;
	top:70%;
	left:40%;
	
}
textarea#statustext{width:500px; padding:8px; border:#999 1px solid; font-size:16px;}
div.status_boxes{padding:12px; line-height:1.5em;width:500px;
	
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
div.reply_boxes{padding:12px; border:#999 1px solid; background:#F5F5F5;width:480px;border:thin solid #999;
	border-radius:5px;
}
div.reply_boxes > div > b{font-size:12px;}
#status_allmmmmmmmmmmmmm{
	width:600px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:200%;
	left:20%;
	background-color:#999;

	
}
#statusarea{
	width:530px;
	border:thin solid #FFF;
	border-radius:5px;
	position:absolute;
	top:105%;
	left:40%;
	background-color:#FFF;;
    margin-top:10px;
	
}
#post_box{
	
	width:500px;
	border:thin solid #999;
	border-radius:5px;
	background-color:#E1E1E1;

}
#photo_album {
		height:300px;
	
	width:300px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:115%;
	left:05%;
	background-color:#E1E1E1;

	
}
#bg_include {
	width:300px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:275%;
	left:05%;
	background-color:#E1E1E1;
    height:100px;
}
#geo_div{
	display:none;
	
}
#ThemeInclude {
	
	
}
#req_div{
	position:absolute;
	top:240px;
	right:270px;
}
#lk_bt {
	width:100px;
	height:100px;
	
}
</style>
<script>
function gotoLike(x,y){
	//alert("hello"+x+y);
	var ajax = ajaxObj("POST","Parser/likemember_parser.php");
	
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			var response = ajax.responseText;
			//alert("hello"+response);
			if(response.replace(/^\s+|\s+$/g, "") == 'liked'){
				_('req_div').innerHTML = '<button onclick="gotoUnlike()">Unlike</button>';
			}
		}
		
	}
	ajax.send("action=like&id="+x+"&creator="+y);
}
function gotoUnlike(x,y){
	alert(""+x+y);
	var ajax = ajaxObj("POST","Parser/likemember_parser.php");
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			var response = ajax.responseText;
			alert(response);
			if(response.replace(/^\s+|\s+$/g, "") == 'unliked'){
				_('req_div').innerHTML = '<button onclick="gotoUnlike()">like</button>';
			}
		}
		
	}
	ajax.send("action=unlike&id="+x+"&creator="+y);

	
}
</script>
</head>
<body>

<div id="messageInclude"><?php include_once ('Test/annesha/message_div.php'); ?>
</div>
<div id="main">
<div id="pageUpperInclude"><?php include 'Test/annesha/header.php'; ?></div>
 <div id="cp_box"><?php echo $cover_pic_btn; ?><?php echo $cover_form; ?><?php echo $cover_pic;?><div id="req_div" style="display:block"><?php echo $like_btn;?></div>
 <div id="profile_pic_box"><?php echo $profile_pic_btn; ?><?php echo $profile_form; ?><?php echo $profile_pic; ?></div>
 
 <div id="cp_lower"><ul id="about_header">
<li id="about_li"><a id="about_a" href="#" onClick="return false" onMouseDown="showE()">Edit</a></li>
<li id="about_li"><a id="about_a"href="#" >Likes</a></li>
<li id="about_li"><a id="about_a"href="#">Photos</a></li>
<li id="about_li"><a id="about_a"href="#" onClick="return false" onMouseDown="showW()">Wall</a></li>
</ul>
</div>
 
 </div>




<div id="pageMiddle">
  <div id="div_user">
  <div id="basic_info">
  <div style="height:30px;background:#000">Friends who liked this page</div>
  <?php echo $frnd_html;?>
      </div>
  
  <div id="action_with">
  
  fffffff
  </div>
  
  
  <div id="friends_divshow">
  <div style="height:30px;background:#000">People who liked this page</div>
  <?php echo $member_html;?>
 </div>
 <div id="geo_div">
 <p>
     </p></div>

 <p><?php //include_once("Template/status_post.php"); ?></p>
 <div id="photo_album"><?php echo $inv; ?><p>
 
 </div>
  <?php echo $status_ui; ?>



  <?php //echo $statuslist; ?>
 <div id="map-canvas" style="width:20px;height:20px; display:none;" ></div>
 <div id="stng.hvr_div"></div>
</div>
</div></div>
<?php include_once("Template/dialog.php"); ?>
<div id="tina_about" style="display:none;"><?php //include_once("tina123/tina.php"); ?></div>
</body>
</html>
<?php if($creator == $log_username) { ?>
<div id="bg_include">   <?php echo $bg_form;?><?php echo $bg_pic_btn;?><div style="display:none;">
 <input id="background_input" type="file"/>
<button id="upload_button">Upload background<br/>or use drag and drop</button></p>
</div>
 <hr />
 <script>
 var file, 
    render;
//var ajax = ajaxObj("POST","Parser/like_bg.php");
document.getElementById("upload_button").addEventListener("click", function(){
  document.getElementById("background_input").click();
}, false);

document.body.addEventListener("drop", function(ev){
  file = ev.dataTransfer.files[0];
  if(!file.type.match("image.*")) {
    alert("This file isn't image or it's unsupported format");
    return;
  }
  reader = new FileReader();
  reader.addEventListener("load", (function(theFile) {
    return function(e) {
      document.body.style.backgroundImage = "url('" + e.target.result + "')";
		};
	})(file), false);
  reader.readAsDataURL(file);
}, false);

document.getElementById("background_input").addEventListener("change", function(ev){
  file = ev.target.files[0];
  if(!file.type.match("image.*")) {
    alert("This file isn't image or it's unsupported format");
    return;
  }
  reader = new FileReader();
  reader.addEventListener("load", (function(theFile) {
    return function(e) {
      document.body.style.backgroundImage = "url('" + e.target.result + "')";
		};
	})(file), false);
  reader.readAsDataURL(file);
}, false);
 </script>
 <script type="text/javascript">
$(document).ready(function() { 
    //var x =$('body').css('background-image', 'url("'++'")');
	//var y = x.val();
	
	var options = { 
			target : '',   
			resetForm: true         
		}; 
		
	 $('#bg_form').change(function() { 
			$(this).ajaxSubmit(options);  			 
			return false; 
		});
});
</script>


<?php } ?>