<?php
if(isset($_POST['action']) && $_POST['action'] == "getmore"){
    include_once '../Connection/check_logged_user.php';
include_once '../TimeStamp/time_ago.php';
$timeAgoObject = new convertToAgo();
//$u = $log_username;
$lastid = "";
$friends = array();
$statuslist = "";
$lastid = preg_replace("#[^0-9]#","",$_POST['statusshown']);
//$lastid = 0;
$sql = "SELECT user1 FROM friends WHERE user2='$log_username' AND accepted='1'";
$query = mysqli_query($con,$sql);
$num_row = mysqli_num_rows($query);
if($num_row > 0){
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		array_push($friends,$row['user1']);
	}
	
}
$sql = "SELECT user2 FROM friends WHERE user1='$log_username' AND accepted='1'";
$query = mysqli_query($con,$sql);
$num_row = mysqli_num_rows($query);
if($num_row > 0){
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		array_push($friends,$row['user2']);
	}
	
}
$sql = "SELECT dplink FROM users WHERE username='$log_username'";
$query = mysqli_query($con,$sql);
$row_ownr = mysqli_fetch_row($query);
$dp_ownr = $row_ownr[0];
$dp_ownr_lnk = 'Users/'.$log_username.'/'.$dp_ownr.'';
$_SESSION['lastStatusid'] = "";
$sql =  "SELECT * FROM status WHERE (type='a' AND id<".$lastid.") OR (type='c' AND id<".$lastid.") OR (type='d' AND id<".$lastid.") OR (type='e' AND id<".$lastid.")  ORDER BY postdate DESC LIMIT 5";

$query = mysqli_query($con, $sql);
$statusnumrows = mysqli_num_rows($query);
if($statusnumrows < 1){
	echo $lastid."|"."";
	exit();
}

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	if($_SESSION['lastStatusid'] == ""){
	$_SESSION['lastStatusid'] = $row["id"];
	}
	//$lastid = $row["id"];
	$_SESSION['end'] = $row["id"];
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
		$sql_photo_albm = "SELECT src FROM photos WHERE gallery='$result'";
		$query_photo_albm = mysqli_query($con,$sql_photo_albm);
		while($row_albm = mysqli_fetch_array($query_photo_albm,MYSQLI_ASSOC)){
			$pic = $row_albm['src'];
			$data1 .= '<img src="'.$pic.'" style="height:250px;width:200px;
  border: 1px solid #ffffff; float: left;">'; 
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
			$data1 .= '<video width="500" height="300" style="border: 1px solid #ffffff; float: left;" controls>
  <source src="'.$vdo.'" type="video/mp4">
  <source src="'.$vdo.'" type="video/ogg">
  <source src="'.$vdo.'" type="video/ogg">
<source src="'.$vdo.'" type="video/avi">
  </video>'; 

		}
		$data = '<div id="" style="display:inline;text-align:bottom;">'.$data1.'<div style="clear:both;">New Video</div><br /></div>';
		
	}
	
	
	
	// GATHER UP ANY STATUS REPLIES
	$status_replies = "";
	$sql = "SELECT * FROM status WHERE osid='$statusid' AND type='b' ORDER BY postdate DESC";
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
	padding:0;list-style:none;position:absolute;">'.$result_author_f.' '.$result_author_l.'<div>@'.$author.'</a></div><div> '.$when_post.': '.$statusDeleteButton.'</div></div> <br />'.$note.'<br />'.$data.'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'.$statusid.'\',\'btn_tgl'.$statusid.'\')" id="btn_tgl'.$statusid.'">Expand</a></div></div><div id="rply_pst" class="rply_pst'.$statusid.'"><img class="friendpics" src="'.$dp_ownr_lnk.'" alt="'.$log_username.'" title="'.$log_username.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'.$statusid.'\')"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)" class="btn_rply">Reply</button><div id="replies_'.$statusid.'">'.$status_replies.'</div></div></div>';
	   /* $statuslist .= '<div id="rply_pst" class="rply_pst'.$statusid.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)">Reply</button></div>';	*/
	
} 
   
 
   echo $statusid."|".$statuslist;
   exit();
}



?>
<?php 
$sql = "SELECT * FROM status WHERE account_name='$u' AND type='a' OR account_name='$u' AND type='c' OR account_name='$u' AND type='d' OR account_name='$u' AND type='e' ORDER BY postdate DESC";
$query = mysqli_query($con, $sql);
$statusnumrows = mysqli_num_rows($query);
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
		$sql_photo_albm = "SELECT src FROM photos WHERE gallery='$result'";
		$query_photo_albm = mysqli_query($con,$sql_photo_albm);
		while($row_albm = mysqli_fetch_array($query_photo_albm,MYSQLI_ASSOC)){
			$pic = $row_albm['src'];
			$data1 .= '<img src="'.$pic.'" style="height:200px;width:240px;
  border: 1px solid #ffffff; float: left;">'; 
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
			$data1 .= '<video width="500" height="300" style="border: 1px solid #ffffff; float: left;" controls>
  <source src="'.$vdo.'" type="video/mp4">
  <source src="'.$vdo.'" type="video/ogg">
  <source src="'.$vdo.'" type="video/ogg">
<source src="'.$vdo.'" type="video/avi">
  </video>
'; 
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
	
	$statuslist .= '<div id="status_'.$statusid.'" class="status_boxes" ><div class="post_box" id="postBox_'.$statusid.'" onmouseout="chBBcolor(\'postBox_'.$statusid.'\')" onmouseover="changeBBcolor(\'postBox_'.$statusid.'\')" onclick="gotoPost(\'postBox_'.$statusid.'\',\'postBox_'.$u.'\')"><img src="'.$author_pic.'" alt="'.$author.'" title="'.$author.'" height="70px" width="50px" > <a href="users.php?u='.$author.'"><div style="display:inline;
	margin-right:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;">'.$result_author_f.' '.$result_author_l.'<div>@'.$author.'</a></div><div> '.$when_post.': '.$statusDeleteButton.'</div></div> <br />'.$note.'<br />'.$data.'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'.$statusid.'\',\'btn_tgl'.$statusid.'\')" id="btn_tgl'.$statusid.'">Expand</a></div></div><div id="rply_pst" class="rply_pst'.$statusid.'"><img class="friendpics" src="'.$owner_pic.'" alt="'.$log_username.'" title="'.$log_username.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'.$statusid.'\')"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)" class="btn_rply">Reply</button>'.$status_replies.'</div></div>';
	/*if($isFriend == true || $log_username == $u){
	    $statuslist .= '<div id="rply_pst" class="rply_pst'.$statusid.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)">Reply</button></div>';	
	}*/
}
?>

<script>
function showBtn(x){
	$("#"+x).show();
	
}
function expand(x,y){
	
	    var b = _(y);
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
     $('#main').fadeTo('slow',0.2);
	 $('#photoShow_div').load("photo.php?status="+x+"$name="+y);
	//alert("hello");
	
}
function changeBBcolor(x){
	
	_(x).style.border = "thin solid blue";
}
function chBBcolor(x){
	
	_(x).style.border = "thin solid #999";
}
function gotoPost(x,y){
	//alert(""+x+y);
	var d = x.split('_');
	var u = y.split('_');
	window.location = "users.php?u="+u[1]+"&status="+d[1];
}
// JavaScript Document
function friendToggle(type,user,elem) {
	var conf = Confirm.render("Press OK to confirm the '"+type+"' action for user '"+user+"'",type,user);
	
	
	/*if(conf == true){
		
	
	alert(""+conf);
	
	
    var ajax = ajaxObj("POST","../Parser/friend_system.php");	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true){
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "friend_request_sent"){
				_(elem).innerHTML = '<button >OK Friend Request Sent</button>';
			} else if(response == "unfriend_ok"){
				_(elem).innerHTML = '<button onclick="friendToggle(\'friend\',\'<?php echo $u; ?>\',\'friendBtn\')">Request As Friend</button>';
			} else {
				alert(ajax.responseText);
				_(elem).innerHTML = response;
			}
		}
	}
	ajax.send("type="+type+"&user="+user);
}*/
}
function sendRequest(type,user){
            document.getElementById('friendBtn').innerHTML = 'please wait..';
  var ajax = ajaxObj("POST","Parser/friend_system.php");
  	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true){
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "friend_request_sent"){
				document.getElementById('friendBtn').innerHTML = '<button >OK Friend Request Sent</button>';
			} else if(response == "unfriend_ok"){
				document.getElementById('friendBtn').innerHTML = '<button onclick="friendToggle(\'friend\',\'<?php echo $u; ?>\',\'friendBtn\')">Request As Friend</button>';
			} else {
				alert(ajax.responseText);
				document.getElementById('friendBtn').innerHTML = response;
			}
		}
	}
	ajax.send("type="+type+"&user="+user);
	
}

function blockToggle(type,user,elem){
	
	var conf = Confirm.render("Press OK to confirm the '"+type+"' action for user '"+user+"'",type,user);
	
	/*if(conf != true){
		return false;
	}
	_('elem').innerHTML = 'please wait...';
	var ajax = ajaxObj("POST","../Parser/block_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
		if(ajax.responseText == "blocked_ok"){
				elem.innerHTML = '<button onclick="blockToggle(\'unblock\',\'<?php echo $u; ?>\',\'blockBtn\')">Unblock User</button>';
			} else if(ajax.responseText == "unblocked_ok"){
				elem.innerHTML = '<button onclick="blockToggle(\'block\',\'<?php echo $u; ?>\',\'blockBtn\')">Block User</button>';
			} else {
				alert(ajax.responseText);
				elem.innerHTML = 'Try again later';
			}
		}
	}
	ajax.send("type="+type+"&blockee="+blockee);*/
}
function blockRequests(type,user){
	document.getElementById('blockBtn').innerHTML = 'please wait..';
	var ajax = ajaxObj("POST","Parser/block_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
		if(response == "blocked_ok"){
				document.getElementById('blockBtn').innerHTML = '<button onclick="blockToggle(\'unblock\',\''+user+'\',\'blockBtn\')">Unblock User</button>';
			} else if(response == "unblock_ok"){
				document.getElementById('blockBtn').innerHTML = '<button onclick="blockToggle(\'block\',\''+user+'\',\'blockBtn\')">Block User</button>';
			} else {
				alert(ajax.responseText);
				document.getElementById('blockBtn').innerHTML = response;
			}
		}
	}
	ajax.send("type="+type+"&blockee="+user);

}

function showOption(x) {
  
   var x = _(x);
	if(x.style.display == 'block'){
		x.style.display = 'none';
	}else{
		x.style.display = 'block';
	}
}
	

function replyToStatus(sid,user,ta,btn){
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
				_("status_"+sid).innerHTML += '<div id="reply_'+rid+'" class="reply_boxes"><div><b>Reply by you just now:</b><span id="srdb_'+rid+'"><a href="#" onclick="return false;" onmousedown="deleteReply(\''+rid+'\',\'reply_'+rid+'\');" title="DELETE THIS COMMENT">remove</a></span><br />'+data+'</div></div>';
				_("replyBtn_"+sid).disabled = false;
				_(ta).value = "";
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=status_reply&sid="+sid+"&user="+user+"&data="+data);
}
function deleteStatus(statusid,statusbox){
	var conf = Confirm.render("Press OK to confirm deletion of this status and its replies","delete_status",statusid);
}
function deleteReply(replyid,replybox){
	var conf = Confirm.render("Press OK to confirm deletion of this reply","reply_delete",replyid);
	/*if(conf != true){
		return false;
	}
	var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "delete_ok"){
				_(replybox).style.display = 'none';
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=delete_reply&replyid="+replyid);*/
}
function statusMax(field, maxlimit) {
	if (field.value.length > maxlimit){
		alert(maxlimit+" maximum character limit reached");
		field.value = field.value.substring(0, maxlimit);
	}
}
function deleteStatusAjax(statusid){
	   var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "delete_ok"){
				//
				alert("hellodel");
				_("status_"+statusid).style.display = 'none';
				_("replytext_"+statusid).style.display = 'none';
				_("replyBtn_"+statusid).style.display = 'none';
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=delete_status&statusid="+statusid);

}
function deleteReplyAjax(id){
	var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "delete_ok"){
				_("reply_"+id).style.display = 'none';
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=delete_reply&replyid="+id);
}


</script>

<script>
function goS(action,type,user,ta){
alert("");
var data = _(ta).value;
alert(data);
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
				data = data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
				var currentHTML = _("statusarea").innerHTML;
				_("statusarea").innerHTML = '<div id="status_'+sid+'" class="status_boxes"><div class="post_box" id="postBox_'+sid+'" onmouseout="chBBcolor(\'postBox_'+sid+'\')" onmouseover="changeBBcolor(\'postBox_'+sid+'\')" onclick="gotoPost(\'postBox_'+sid+'\',\'postBox_'+user+'\')"><img src="<?php echo $owner_pic;?>" title="'+user+'" height="70px" width="50px" > <a href="users.php?u=<?php echo $log_username;?>"><div style="display:inline;margin-right:7px;vertical-align:text-top;padding:0;list-style:none;position:absolute;"><?php echo $f_name. " " .$l_name; ?><div>@'+user+'</a></div>	<div> just now: <span id="sdb_'+sid+'"><a href="#" onclick="return false;" onmousedown="deleteStatus(\''+sid+'\',\'status_'+sid+'\');" title="DELETE THIS STATUS AND ITS REPLIES">delete status</a></span> &nbsp; &nbsp;</div></div><br /><br />'+data+'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'+sid+'\',\'btn_tgl'+sid+'\')" id="btn_tgl'+sid+'">Expand</a></div></div><div id="rply_pst" class="rply_pst'+sid+'"><img class="friendpics" src="<?php echo $owner_pic;?>" alt="<?php echo $log_username;?>" title="<?php echo $log_username;?>"><textarea id="replytext_'+sid+'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'+sid+'\')"></textarea><button id="replyBtn_'+sid+'" onclick="replyToStatus('+sid+',\'<?php echo $log_username;?>\',\'replytext_'+sid+'\',this)" class="btn_rply">Reply</button></div></div>'+currentHTML;
			
				
				
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
<style>
.status_photo{
	width:500;
	height:300;
	
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

</style>

  <?php echo $statuslist; ?>

