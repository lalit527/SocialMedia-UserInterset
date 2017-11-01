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
$frstname = "";
$lstname = "";
$sex = "Female";
$bg = "";
$profile_pic = "";
$profile_pic_btn = "";
$profile_form = "";
$cover_pic = "";
$cover_pic_btn = "";
$cover_form = "";
$pf_pic = "";
$hdr_pic = "";
$userlevel = "";
$joindate = "";
$lastseen = "";
$lastseenfrom = "";
$dplink = "";
$dplink = "";
$bg_link = "";
$lastsession = "";
$isOwner = "no";
$account_setting = "";
$logout = "";
$post = "";
$notification = "";
$convertedTime_lastseen = "";
$when_lastseen = "";
$message_btn = "";
$cover_pic = "";
if(!isset($_GET['u'])) {
	//header("location: http:index.php");	
	//exit();
	
	
}
else {
   $u = preg_replace('#[^a-z0-9]#i','',$_GET['u']);

$sql_bg = "SELECT background FROM useroptions WHERE username='$u' LIMIT 1";
$query_bg = mysqli_query($con,$sql_bg);
$row_bg = mysqli_fetch_row($query_bg);
$bg_link = $row_bg[0];   

$sql = "SELECT * FROM users WHERE username='$u' AND activated='1' LIMIT 1";

$user_query = mysqli_query($con,$sql);

$numuser = mysqli_num_rows($user_query);

if($numuser < 1){
	
	echo "This user is not yet activated";
	exit();
}


if($u == $log_username && $user_ok == true){
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
	'<button  id="covr_btn"
	onclick="showOption(\'cover_form\')">Change Cover Pic</button>';
	$cover_form = '<form id="cover_form" enctype="multipart/form-data" action="Parser/cover_system.php" method="post" onSubmit="return false">';
	$cover_form .= '<h4>Change your Cover Pic</h4>';
	$cover_form .= '<input type="file" name="profile" id="profile1" required>';
	$cover_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$cover_form .= '</form>';	
	
	$account_setting = '<div id="setting_div"><img src="Images/setting.png" alt="setting" id="setting_pic" style="width:30px;height:30px" onmousedown="showOption()"></div>';
	$account_setting .= '<div id="stngHvr_div"><nav><ul><li>hello</li><hr /><li>setting</li><hr /><li>account</li></ul></nav></div>';
	$logout = '<div id="logout_div"><a href="logout.php">Log Out</a></div>';
	$notification = '<div id="notify_div"><a href="notifications.php">Notification</a></div>';
	$message_btn = '<div id="msg_div"><a href="#" onmousedown="showOption(\'profile_form\')" 
	onclick="return false">Message</a></div>';
    	
	/*$post = '<div id="post_div"><p><input type="button" id="status_button" value="Status"></button><span id="status_span" style="float:right;"></span></p><hr /><form id="post_form" onSubmit="return false;"><textarea rows="5" cols="60" id="post_text"></textarea><hr /><select id="select_post"><option><div id="public_post_div">llllllll<img src="Images/blue.jpg"></div></option></select><input type="submit" id="post" value="post" onclick="postStatus()"><p>fffffffff</p></form></div>
';*/
}
while ($row = mysqli_fetch_array($user_query,MYSQLI_ASSOC)) {
	
	$profile_id = $row['id'];
	$frstname = $row['firstname'];
	$lstname = $row['lastname'];
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

$profile_pic = '<div id="pic_preview"><img src="Users/'.$u.'/'.$dplink.'" alt="'.$u.'" id="preview_dp" ></div>';
$cover_pic = '<div id="cp_preview"><img src="Users/'.$u.'/'.$cplink.'" alt="'.$u.'" id="preview_cp" ></div>';
if($dplink == ""){
	/*if($sex == "Female"){
	$profile_pic = '<div id="pic_preview"><img src="Images/dp_female.jpg" alt="'.$user1.'" id="preview_dp"></div>';
	}
	else if($sex == "Male"){
		$profile_pic = '<div id="pic_preview"><img src="Images/dp_male1.jpg" alt="'.$user1.'" id="preview_dp"></div>';
	}*/
	$profile_pic = '<div id="pic_preview"><img src="Images/dp_male1.jpg" alt="'.$u.'" id="preview_dp"></div>';
}
/*if($cplink == ""){
	/*if($sex == "Female"){
	$profile_pic = '<div id="pic_preview"><img src="Images/dp_female.jpg" alt="'.$user1.'" id="preview_dp"></div>';
	}
	else if($sex == "Male"){
		$profile_pic = '<div id="pic_preview"><img src="Images/dp_male1.jpg" alt="'.$user1.'" id="preview_dp"></div>';
	}
	$cover_pic = '<div id="pic_preview"><img src="Images/dp_male1.jpg" alt="'.$u.'" id="preview_dp"></div>';
}*/

}

}
?>
<?php
 
 $isFriend = false;
 $isSentBy = false;
 $isSentFrom = false;
 $ownerBlockViewer = false;
 $viewerBlockOwner = false;
 if($u != $log_username && $user_ok == true) {
	$friend_check = "SELECT id FROM friends WHERE user1='$log_username' AND user2='$u' AND accepted='1' OR user1='$u' AND user2='$log_username' AND accepted='1' LIMIT 1";
	$query = mysqli_query($con,$friend_check);
	$result_friend = mysqli_num_rows($query);
	
	if($result_friend > 0){
		
         $isFriend = true;  		
	}
	$pendind_frndBy = "SELECT id FROM friends WHERE user1='$log_username' AND user2='$u' AND accepted='0' LIMIT 1";
	$query = mysqli_query($con,$pendind_frndBy);
	$result_pendingBy = mysqli_num_rows($query);
	if($result_pendingBy > 0){
		$isSentBy = true;
	}
	$pendind_frndFrom = "SELECT id FROM friends WHERE user1='$u' AND user2='$log_username' AND accepted='0' LIMIT 1";
	$query = mysqli_query($con,$pendind_frndFrom);
	$result_pendingFrom = mysqli_num_rows($query);
	if($result_pendingFrom > 0){
		$isSentFrom = true;
	}
	$block_check1 = "SELECT id FROM blockedusers WHERE blocker='$u' AND blockee='$log_username' LIMIT 1";
	$query = mysqli_query($con,$block_check1);
	$result_block1 = mysqli_num_rows($query);
	if($result_block1 > 0){
          $ownerBlockViewer  = true;  		
	}
	$block_check2 = "SELECT id FROM blockedusers WHERE blocker='$log_username' AND blockee='$u' LIMIT 1";
	$query = mysqli_query($con,$block_check2);
	$result_block2 = mysqli_num_rows($query);
	if($result_block2 > 0){
        $viewerBlockOwner = true;  		
	}
 }

?>
<?php 
$friend_button = '<button disabled>Request As Friend_chk</button>';
$block_button = '<button disabled>Block User_chk</button>';
// LOGIC FOR FRIEND BUTTON
if($isFriend == true){
	$friend_button = '<button onclick="friendToggle(\'unfriend\',\''.$u.'\',\'friendBtn\')">Unfriend</button>';
}
else if($user_ok == true && $u != $log_username && $ownerBlockViewer == false){
	
	$friend_button = '<button onclick="friendToggle(\'friend\',\''.$u.'\',\'friendBtn\')">Request As Friend</button>';
	//$friend_button = '<button onclick="my()">Request As Friend</button>';
	
}
if($isSentBy == true){
	$friend_button = '<button onclick="" onMouseOver="showOption()">Friend Request Sent</button>';

}
if($isSentFrom == true){
	$friend_button = '<button onclick="">Respond to Friend Request</button>';
}

// LOGIC FOR BLOCK BUTTON
if($viewerBlockOwner == true){
	$block_button = '<button onclick="blockToggle(\'unblock\',\''.$u.'\',\'blockBtn\')">Unblock User</button>';
} else if($user_ok == true && $u != $log_username){
	$block_button = '<button onclick="blockToggle(\'block\',\''.$u.'\',\'blockBtn\')">Block User</button>';
}
?><?php
$friendsHTML = '';
$friends_view_all_link = '';
$sql = "SELECT COUNT(id) FROM friends WHERE user1='$u' AND accepted='1' OR user2='$u' AND accepted='1'";
$query = mysqli_query($con, $sql);
$query_count = mysqli_fetch_row($query);
$friend_count = $query_count[0];
if($friend_count < 1){
	$friendsHTML = $u." has no friends yet";
} else {
	$max = 7;
	$all_friends = array();
	$sql = "SELECT user1 FROM friends WHERE user2='$u' AND accepted='1' ORDER BY RAND() LIMIT $max";
	$query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		array_push($all_friends, $row["user1"]);
	}
	$sql = "SELECT user2 FROM friends WHERE user1='$u' AND accepted='1' ORDER BY RAND() LIMIT $max";
	$query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		array_push($all_friends, $row["user2"]);
	}
	$friendArrayCount = count($all_friends);
	if($friendArrayCount > $max){
		array_splice($all_friends, $max);
	}
	if($friend_count > $max){
		$friends_view_all_link = '<a href="view_friends.php?u='.$u.'">view all</a>';
	}
	$orLogic = '';
	foreach($all_friends as $key => $user){
			$orLogic .= "username='$user' OR ";
	}
	$orLogic = chop($orLogic, "OR ");
	$sql = "SELECT username, dplink FROM users WHERE $orLogic";
	$query = mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$friend_username = $row["username"];
		$friend_avatar = $row["dplink"];
		if($friend_avatar != ""){
			$friend_pic = 'Users/'.$friend_username.'/'.$friend_avatar.'';
		} else {
			$friend_pic = 'Images/dp_male1.jpg';
		}
		$friendsHTML .= '<a href="users.php?u='.$friend_username.'"><img class="friendpics" src="'.$friend_pic.'" alt="'.$friend_username.'" title="'.$friend_username.'"></a>';
	}
}
?>
<?php
//include_once ('../Connection/check_logged_user.php');
//$u = $_GET['u'];
$pic = "";
$status_ui = "";
$statuslist = "";
if($isOwner == "yes"){
	$status_ui = '<div id="post_div">';
	$status_ui .= '<p>Compose new Post</p>';
	$status_ui .= '<span id="status_span" style="float:right;"></span>';
	$status_ui .= '<textarea id="text_post" rows="5"
	 cols="60" onkeyup="statusMax(this,250)" onfocus="showPostDiv()" placeholder="What new about you '.$log_username.'?"></textarea>';
	 $status_ui .= '<div id="postbutton_div" style="display:none">';
	$status_ui .= '<button id="post" 
	onclick="goS(\'status_post\',\'a\',\''.$u.'\',\'text_post\'
);">Post</button>';
	$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div></div>';
}else if($isFriend == true && $log_username != $u){
	$status_ui = '<div id="post_div">';
	$status_ui .= '<p>Status</p>';
	$status_ui .= '<span id="status_span" style="float:right;"></span>';
	
	$status_ui .= '<textarea id="text_post" rows="5"
	 cols="60" onkeyup="statusMax(this,250)" onfocus="showPostDiv()" placeholder="Hi '.$log_username.', say something to '.$u.'"></textarea>';
	 $status_ui .= '<div id="postbutton_div" style="display:none">';
		$status_ui .= '<button id="post" onclick="goS(\'status_post\',\'c\',\''.$u.'\',\'text_post\')">Post</button>';
$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div>';

}

?><?php 
/*$sql = "SELECT * FROM status WHERE account_name='$u' AND type='a' OR account_name='$u' AND type='c' ORDER BY postdate DESC LIMIT 20";
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

	$result_owner_dp = "";
	$owner_pic = "";
	$sql_pic = "SELECT dplink FROM users WHERE username='$log_username' LIMIT 1" ;
	$query_pic = mysqli_query($con,$sql_pic);
	$result_pic = mysqli_fetch_row($query_pic);
	$result_owner_dp = $result_pic[0];
	$owner_pic = 'Users/'.$log_username.'/'.$result_owner_dp.'';
	


?><?php
$photo = '';
    $sql = "SELECT gallery,filename,src FROM photos WHERE user='$u' ORDER BY uploaddate DESC LIMIT 9";
	$query = mysqli_query($con,$sql);
	$num = mysqli_num_rows($query);
	if($num > 0){
		while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
			$gallery = $row['gallery'];
			$filename = $row['filename'];
			$src = $row['src'];
			$photo .= '<div id="photo_main" style="float:left;margin:5px;"><img src="'.$src.'" style="width:90px;height:90px;"></div>'; 
		}
		
	}

?>
<?php

if($user_ok == true && $log_username == $u)
{
  
  ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    
      <script>
         //Define the function somewhere in the top or in external js and include it.
       var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
var marker;
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.watchPosition(showPosition);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }
function showPosition(position)
  {
	  
  document.getElementById('latlng').value = ""+position.coords.latitude + 
  ","+position.coords.longitude;
    check_geoloc();
  	//codeLatLng();
  }
function check_geoloc(){
	var input = document.getElementById('latlng').value;
	
  var latlngStr = input.split(',', 2);
  var lat = parseFloat(latlngStr[0]);
  var lng = parseFloat(latlngStr[1]);
  
  var ajax = ajaxObj("POST", "Connection/check_geoloc.php");
  
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var datArray = ajax.responseText.split("|");
			//var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			//alert(ajax.responseText);
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "found"){
				var rid = datArray[1];
				document.getElementById("result").value = rid;
			} else if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "not_found"){
				
				initialize();
				//codeLatLng();
			}
			else {
			alert(response);	
			}
		}
	}
	ajax.send("lat="+lat+"&lng="+lng);

}

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(22.4650201,88.37931929999999);
  var mapOptions = {
    zoom: 8,
    center: latlng,
    mapTypeId: 'roadmap'
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  codeLatLng();
}

function codeLatLng() {
  	
  var input = document.getElementById('latlng').value;
  var latlngStr = input.split(',', 2);
  var lat = parseFloat(latlngStr[0]);
  var lng = parseFloat(latlngStr[1]);
  var latlng = new google.maps.LatLng(lat, lng);
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
		  //infowindow.setContent(results[1].formatted_address);
	  
        map.setZoom(11);
        marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
		var address = results[1].formatted_address;
		document.getElementById("result").value = results[1].formatted_address;
		insert_geoloc(lat,lng,address);
       // infowindow.setContent(results[1].formatted_address);
       // infowindow.open(map, marker);
      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
  });
}

//google.maps.event.addDomListener(window, 'load', initialize);


function insert_geoloc(lat,lng,address){
	
  var ajax = ajaxObj("POST", "Connection/check_geoloc.php");
    	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			
			if(response == "insert_ok"){
				
							} else if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "not_found"){
				
				//codeLatLng();
			}
			else {
			alert(response);	
			}
		}
	}
	ajax.send("lat="+lat+"&lng="+lng+"&address="+address);
	
}
	    getLocation();

      </script>
  <?php
  
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $u; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="CSS/dialog.css">
<link rel="stylesheet" href="CSS/user_style.css">
<script src="JavaScript/googleapis.js"></script>
<script src="JavaScript/script.js"></script>
<script src="JavaScript/ajax.js"></script>
<script src="JavaScript/dialog.js"></script>
<script src="JavaScript/'''''...user_script.js"></script>
<script type="text/javascript" src="JavaScript/jquery1.min.js"></script>

</script>

<script>
	function showAbout(){
		
		_('div_user').style.display = 'none';
		_('tina_about').style.display = 'block';
	}
	function showWall(){
		
		_('tina_about').style.display = 'none';
		_('div_user').style.display = 'block';
	}
	function showPhotos(){
		
		_('div_user').style.display = 'none';
		_('photoShow_div').style.display = 'block';
	}
	

</script>
<script type="text/javascript" src="JavaScript/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="JavaScript/js/jquery.form.min.js"></script>

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
<script type="text/javascript">
$(document).ready(function() { 
  
	var options = { 
			target:   '#cp_preview',    
			resetForm: true         
		}; 
		
	 $('#cover_form').change(function() { 
			$(this).ajaxSubmit(options);  			 
			return false; 
		});
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
<script>
if(typeof(EventSource)!=="undefined")
  {
  var source=new EventSource("Template/status_post.php");
  source.onmessage=function(event)
    {
   // document.getElementById("statusarea").innerHTML+=event.data + "<br>";
    };
  }
else
  {
  document.getElementById("result").innerHTML="Sorry, your browser does not support server-sent events...";
  }
</script>

<style>
body {
	margin: 0 auto;
	padding: 0;
	width: 100%;
	font-family: Arial, Helvetica, sans-serif;
	color:#666666;
	background-image:url("Users/<?php echo $u;?>/<?php echo $bg_link;?>");
	background-attachment:fixed;
	 
  
	background-size: cover;
  background-position: center center;

	
}
div#profile_pic_box{float:right; border:#999 2px solid; width:180px; height:200px; margin:-170px 20px 0px 0px; overflow:hidden;border:07px solid #333;z-index:1;
position:relative;border-radius:5px;}
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
div#cp_box > #covr_btn {
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
div#cp_box:hover #covr_btn {
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
	position:absolute;

}
#settingsInclude{
	position:absolute;
	top:40px;
}
#pageUpperInclude {
	margin-top:-25px;
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
#photoShow_div {
	position:fixed;
	top:05%;
	left:10%;
	z-index:1;
	
}
#statusshow_include{
	position:absolute;
	top:100px;
	left:20%;
	z-index:1;
	width:600px;
}
#tina_about{
	position:absolute;
	top:70%;
}
#photoShow_div{
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
background-color:#66F;
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
	top:67%;
	left:05%;
	background-color:#E1E1E1;
	z-index:0;
	
}
#action_with {
	height:200px;
	
	width:400px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:70%;
	left:20%;
	background-color:#999;
}
#friends_divshow {
	
	height:350px;
	
	width:300px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:177%;
	left:05%;
	background-color:#E1E1E1;

}
#theme_div {
	
	height:100px;
	
	width:300px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:237%;
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
	top:60%;
	left:40%;
	
}
textarea#statustext{width:500px; padding:8px; border:#999 1px solid; font-size:16px;}
div.status_boxes{padding:2px; line-height:1.5em;width:500px;
	
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
	position:absolute;
	top:100%;
	left:40%;
	
    margin-top:10px;
	
}

.post_box{
	
	width:500px;
	border:thin solid #999;
	border-radius:5px;
	background-color:#E1E1E1;

}
#photo_album {
		height:350px;
	
	width:300px;
	border:thin solid #999;
	border-radius:5px;
	position:absolute;
	top:118%;
	left:05%;
	background-color:#E1E1E1;

	
}
#geo_div{
	
 display:none;
}
#status_show{
	
	position:absolute;
	top:05px;
	left:25%;
	
}
<style>
#messageInclude {
	position:fixed;
	top:15%;
	left:80%;
	z-index:100000000;
	
}

#status_show_div{
	width:500px;
			position:absolute;
	top:-40px;
	left:30%;
}
#upper_status_show{
	width:500px;
	}
#people_status{
width:500px;
	}
#date_status{
	width:500px;
}
#reply_status_show{
	width:500px;
	}
#replies{
	background-color:#9F6;
	
}
#status_show_upper{
	
	
}
#inc{
	width:100%;
	position:fixed;
	top:-20px;
}
#showAction{
	position:absolute;
	top:220px;
	right:270px;
	display:block;
}
#actionBlock{
	position:absolute;
	top:220px;
	right:240px;
	display:block;
}
#action {
	position:absolute;
	top:220px;
	
	display:block;
	float:left;
	
}
</style>
</head>
<body>








<div class="all">
<div id="messageInclude"><?php include_once ('Test/annesha/message_div.php'); ?>
</div>

<div id="main" >

<div id="pageUpperInclude"><?php include 'Test/annesha/header.php'; ?></div>
<div id="settingsInclude">
</div>

<div id="pageContent" >
 <div id="cp_box"><?php echo $cover_pic_btn; ?><?php echo $cover_form; ?><?php echo $cover_pic;?><div id="action"><p><span id="friendBtn"><?php echo $friend_button; ?></span><span id="blockBtn"><?php echo $block_button; ?></p></div>
  <div id="profile_pic_box"><?php echo $profile_pic_btn; ?><?php echo $profile_form; ?><?php echo $profile_pic; ?></div>
 
 <div id="cp_lower"><ul id="about_header">
<li id="about_li"><a id="about_a" href="#" onClick="return false" onMouseDown="showAbout()">About</a></li>
<li id="about_li"><a id="about_a"href="#" >Friends</a></li>
<li id="about_li"><a id="about_a" href="#" onClick="return false" onMouseDown="showPhotos()">Photos</a></li>
<li id="about_li"><a id="about_a"href="#" onClick="return false" onMouseDown="showWall()">My Wall</a></li>
</ul>
</div>
 
 </div>




<div id="pageMiddle" >
  <div id="div_user">
  <div id="basic_info">
  <p>Is the viewer the page owner, logged in and verified? <b><?php echo $isOwner; ?></b></p>
    <p>name: <?php echo $frstname. " " .$lstname; ?></p>
  <p>Gender: <?php echo $sex; ?></p>
  <p>User Level: <?php echo $userlevel; ?></p>
  <p>Join Date: <?php echo $joindate; ?></p>
  <p>Last Session: <?php echo $when_lastseen; ?></p>
  <p>Last Seen From: <?php echo $lastseenfrom; ?></p>
  </div>
  
  <div id="action_with" style="display:none;">
  <p>Friend Button: <span id="friendBtn"><?php echo $friend_button; ?></span>
  <?php echo $u." has ".$friend_count." friends"; ?> <?php echo $friends_view_all_link; ?></p>
  <p><a href="more_friends.php">Find more friends</a></p>
  <p>Block Button: <span id="blockBtn"><?php echo $block_button; ?></span></p>
  </div>
  
  
  <div id="friends_divshow" ><div id="" style="height:
  40px"><a href="#">Friends.<?php echo $friend_count;?></a></div><?php echo $friendsHTML; ?></div>
 <div id="geo_div">
 <p>
  <input id="latlng" type="text" value="">
      <input id="result" type="text" value="" >
     </p></div>
<div id="statusarea">

 <?php include_once("Template/status_post.php"); ?></div>
 <script>
 var z = <?php echo $statusid; ?>;
function yHandler(){
	
	var wrap = _('statusarea');
	var contentHeight = wrap.offsetHeight;
	var yOffset = window.pageYOffset; 
	var y = yOffset + window.innerHeight;
	if(y >= contentHeight){
		//alert("hello"+z);
		var ajax = ajaxObj("POST","Template/status_post.php");
	
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
	        //alert(ajax.returnText);
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			
			var datArray = response.split("|");
		$(wrap).append(datArray[1]);
		z = datArray[0];
		}
	}
	ajax.send("action=getmore&statusshown="+z);
	}
}
window.onscroll = yHandler;

</script>
 <div id="photo_album" ><div id="ph_upr" style="height:40px">Photos and Videos</div><div id=""><?php echo $photo;?></div></div>
 <hr />
 
  <?php echo $status_ui; ?>



  <?php //echo $statuslist; ?>
 <div id="map-canvas" style="width:20px;height:20px; display:none;" ></div>
 <div id="stng.hvr_div"></div>
</div>
</div></div></div></div>
<?php include_once("Template/dialog.php"); ?>
<div id="tina_about" style="display:none;"><?php include_once("tina123/tina.php"); ?></div>
<div id="photoShow_div" style="display:none;"><?php include_once("album/album_system.php"); ?></div>


</body>
</html>

<?php
if(isset($_GET['status'])){
	$s = preg_replace("#[^0-9]#i","",$_GET['status']);
	$a_n = preg_replace("#[^a-z0-9]#i","",$_GET['u']);
	$sql = "SELECT * FROM status WHERE account_name='$a_n' AND id='$s' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$getRow = mysqli_num_rows($query);
	if($getRow > 0){
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
$statusid = $row["id"];
	$account_name = $row["account_name"];
	$author = $row["author"];
	$type = $row["type"];
	$note = $row["note"];
	$postdate = $row["postdate"];
	$data = $row["data"];
	$result = $row["result"];
	$data = nl2br($data);
	$data = str_replace("&amp;","&",$data);
	$data = stripslashes($data);
	$statusDeleteButton = '';
	$result = preg_replace("#[^a-z0-9]#i","",$result);
	if($author == $log_username || $account_name == $log_username ){
		$statusDeleteButton = '<span id="sdb_'.$statusid.'"><a href="#" onclick="return false;" onmousedown="deleteStatus(\''.$statusid.'\',\'status_'.$statusid.'\');" title="DELETE THIS STATUS AND ITS REPLIES">delete status</a></span> &nbsp; &nbsp;';
	}
	$convertedTime = ($timeAgoObject -> convert_dateTime($postdate));
	$when_post = ($timeAgoObject -> makeAgo($convertedTime));
	
	if($type == "d"){
		$data1 = "";
		$result = trim($result);
		$sql_photo_albm = "SELECT filename,src FROM photos WHERE gallery='$result'";
		$query_photo_albm = mysqli_query($con,$sql_photo_albm);
		while($row_albm = mysqli_fetch_array($query_photo_albm,MYSQLI_ASSOC)){
			$filename = $row_albm['filename'];
			$pic = $row_albm['src'];
			$data1 .= '<a href="#" onclick="return false;" onmousedown="showGal(\''.$result.'\',\''.$filename.'\',\''.$a_n.'\')"><img src="'.$pic.'" style="height:200;width:240;
  border: 1px solid #ffffff; float: left;"></a>'; 
		}
		$data = '<div id="" style="display:inline;text-align:bottom;">'.$data1.'<div style="clear:both;">New Albuum</div><br /></div>';
		
	}
	
	if($type == "e"){
		$data1 = "";
		//$result = trim($result);
		$sql_vdo = "SELECT src FROM media WHERE file='$result' AND type='a' LIMIT 1";
		$query_vdo = mysqli_query($con,$sql_vdo);
		while($row_vdo = mysqli_fetch_array($query_vdo,MYSQLI_ASSOC)){
			$vdo = $row_vdo['src'];
			$data1 .= '<a href="#" onclick="return false;" onmousedown="showVGal(\''.$result.'\',\''.$a_n.'\')"><video width="500" height="300" style="border: 1px solid #ffffff; float: left;" controls>
  <source src="'.$vdo.'" type="video/mp4">
  <source src="'.$vdo.'" type="video/ogg">
  <source src="'.$vdo.'" type="video/ogg">
<source src="'.$vdo.'" type="video/avi">
  </video></a>'; 
		}
		$data = '<div id="" style="display:inline;text-align:bottom;">'.$data1.'<div style="clear:both;">New Video</div><br /></div>';
		
	}
	
	
	// GATHER UP ANY STATUS REPLIES
	$status_replies = "";
	$sql = "SELECT * FROM status WHERE osid='$statusid' AND type='b' ORDER BY postdate ASC";
	$query_replies = mysqli_query($con, $sql);
	$replynumrows = mysqli_num_rows($query_replies);
    if($replynumrows > 0){
        while ($row2 = mysqli_fetch_array($query_replies, MYSQLI_ASSOC)) {
			$statusreplyid = $row2["id"];
			$replyauthor = $row2["author"];
			$replynote = $row2["note"];
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
            $sql_rply = "SELECT dplink,firstname,lastname FROM users WHERE username='$replyauthor' LIMIT 1";
			$query_rply = mysqli_query($con,$sql_rply);
			$result_rply = mysqli_fetch_row($query_rply);
			$result_reply_dp = $result_rply[0];
			$result_reply_f = $result_rply[1];
			$result_reply_l = $result_rply[2];
			//echo $result_reply_dp;
			$replyauthor_pic = 'Users/'.$replyauthor.'/'.$result_reply_dp.'';
			$status_replies .= '<div id="reply_'.$statusreplyid.'" class="reply_boxes"><img class="friendpics" src="'.$replyauthor_pic.'" alt="'.$replyauthor.'" title="'.$replyauthor.'" ><div style="display:inline;
	margin-left:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;font-size:12px;margin-bottom:0;"><a href="users.php?u='.$replyauthor.'">'.$result_reply_f.' '.$result_reply_l.'@'.$replyauthor.'</a><br /> '.$when_reply.': '.$replyDeleteButton.'</div><br />'.$replydata.'</div>';
        }
    }
	$sql_post = "SELECT dplink,firstname,lastname FROM users WHERE username='$author' LIMIT 1" ;
	$query_post = mysqli_query($con,$sql_post);
	$result_post = mysqli_fetch_row($query_post);
	$result_author_dp = $result_post[0];
	$result_author_f = $result_post[1];
	$result_author_l = $result_post[2];
	$author_pic = 'Users/'.$author.'/'.$result_author_dp.'';
	
	$statuslist .= '<div id="status_'.$statusid.'" class="status_boxes" ><div class="post_box" id="postBox_'.$statusid.'" onmouseout="chBBcolor(\'postBox_'.$statusid.'\')" onmouseover="changeBBcolor(\'postBox_'.$statusid.'\')" onclick="gotoPost(\'postBox_'.$statusid.'\',\'postBox_'.$u.'\')"><img src="'.$author_pic.'" alt="'.$author.'" title="'.$author.'" height="70px" width="50px"> <a href="users.php?u='.$author.'"><div style="display:inline;
	margin-left:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;">'.$result_author_f.' '.$result_author_l.'<div>@'.$author.'</a></div><div> '.$when_post.': '.$statusDeleteButton.'</div></div> <br />'.$note.'<br />'.$data.'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'.$statusid.'\',\'btn_tgl'.$statusid.'\')" id="btn_tgl'.$statusid.'">Expand</a></div></div><div id="rply_pst" class="rply_pst'.$statusid.'"><img class="friendpics" src="'.$owner_pic.'" alt="'.$log_username.'" title="'.$log_username.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'.$statusid.'\')"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)" class="btn_rply">Reply</button>'.$status_replies.'</div></div>';
	}
	}
	?>
<style>
</style>	
<script>
changeOnStatus();
function changeOnStatus(){
	//alert('');
	_('pageContent').style.display = 'none';
	document.getElementById('pageUpperInclude').style.marginTop = -25;
	//$('#status_show').load("statusShow.php");
}
function showBtn(){
	_('replyBtn').style.display = 'block';
	
}

function closeCanvas(){
	$('#photoShow_div').fadeOut();
	$('.all').fadeIn();
	$('#pageUpperInclude').fadeIn();
	
}




function showGal(x,y,z){
	//alert(x+y+z);
	
	//window.location = "photo.php?name="+z+"&gallery="+x+"&file="+y;
	$('.all').fadeOut();
	$('#pageUpperInclude').fadeOut();
	$('#photoShow_div').load("photo.php?name="+z+"&gallery="+x+"&file="+y).fadeIn();
}
function showVGal(x,y){
	//alert(x+y+z);
	
	//window.location = "video.php?name="+y+"&file="+x;
	$('.all').fadeOut();
	$('#pageUpperInclude').fadeOut();
	$('#photoShow_div').load("video.php?name="+y+"&file="+x).fadeIn();
}


</script>
<?php if($getRow > 0) {?>

<div class="all">
<div id="status_show_div">
   <div id="status_show_upper">
        <div id="upper_status_show">
            <?php echo '<div id="status" class="status_boxes" ><div class="post_box" id="postBox" onmouseout="chBBcolor()" onmouseover=
			"changeBBcolor()" onclick="gotoPost()"><img src="'.$author_pic.'" alt="'.$author.'" title="'.$author.'" height="70px" width="50px"> <a href="users.php?u='.$author.'"><div style="display:inline;
	margin-left:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;">'.$result_author_f.' '.$result_author_l.'<div>@'.$author.'</a></div></div><br />'.$note.'<br />'.$data.'';?>
        </div>
            <div id="people_status">gggggggggggggggggg</div>
            <div id="date_status"><?php echo $when_post.': '.$statusDeleteButton?></div>
            <div id="reply_status_show"><?php echo '<div id="rply_pst" class="rply_pst" style="display:block;"><img class="friendpics" src="'.$owner_pic.'" alt="'.$log_username.'" title="'.$log_username.'"><textarea 
			id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn()"></textarea><button id="replyBtn" 
			onclick="replyToStatus('.$s.',\''.$u.'\',\'replytext_'.$statusid.'\',this)" class="btn_rply">Reply</button>'.$status_replies.'</div></div>';?></div>
            
   </div>
   <div id="replies"></div>
   </div>
 
</div>
</div>


<?php } ?><?php } ?>


<?php
if($log_username == $u){
$bg_pic_btn = '<a href="#" onmousedown="showOption(\'bg_form\')" 
	onclick="return false">Change Theme</a>';
	$bg_form = '<form id="bg_form" enctype="multipart/form-data" method="post"  action="Parser/user_bg.php" onSubmit="return false">';
	$bg_form .= '<h4>Change your Profile Pic</h4>';
	$bg_form .= '<input type="file" name="profile" id="background_input" required>';
	//$bg_form .= '<input type="text" name="name_id" id="txt" value="'.$id_get.'" style="display:none">';
	$bg_form .= '<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
';  
	$bg_form .= '</form>';	
	
?>
<div id="theme_div">
<?php echo $bg_form;?><?php echo $bg_pic_btn;?><div style="display:none;">
 <input id="background_input" type="file"/>
<button id="upload_button">Upload background<br/>or use drag and drop</button></p>
</div></div>
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

</div>


<?php  }?>

<?php if($viewerBlockOwner == true) { ?>
<script>
contentBlock();
function contentBlock(){
	_('pageMiddle').style.display = 'none';
	_('cp_lower').style.display = 'none';
	_('friendBtn').style.display = 'none';
}
</script>


<?php } ?>