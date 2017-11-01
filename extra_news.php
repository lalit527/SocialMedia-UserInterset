
<?php
include_once 'Connection/check_logged_user.php';
include_once 'TimeStamp/time_ago.php';

if(isset($_GET['idlast'])){
	//session_regenerate_id (true);
	$_SESSION['lastStatusid'] = "";

$lastid = preg_replace("#[^0-9]#","",$_GET['idlast']);
	
$timeAgoObject = new convertToAgo();
$statuslist = "";
$u = $log_username;
$sql = "SELECT dplink FROM users WHERE username='$log_username'";
$query = mysqli_query($con,$sql);
$row_ownr = mysqli_fetch_row($query);
$dp_ownr = $row_ownr[0];
$dp_ownr_lnk = 'Users/'.$log_username.'/'.$dp_ownr.'';
 
$sql = "SELECT * FROM status WHERE (type='a' AND id>".$lastid.") OR (type='c' AND id>".$lastid.") OR (type='d' AND id>".$lastid.") OR (type='e' AND id>".$lastid.")  ORDER BY postdate DESC";
$query = mysqli_query($con, $sql);
$statusnumrows = mysqli_num_rows($query);
//echo $statusnumrows;

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	if($_SESSION['lastStatusid'] == ""){
	$_SESSION['lastStatusid'] = $row["id"];
	}
	$lastid = $row["id"];
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
	$sql_frndz = "SELECT Count(id) FROM friends WHERE (user1='$log_username' AND user2='$account_name' OR user2='$author') OR (user1='$account_name' AND user2='$log_username' OR user2='$author') AND accepted='1'";
	$query_frndz = mysqli_query($con, $sql_frndz);
	$r = mysqli_fetch_row($query_frndz);
    $r2 = $r[0];
	//echo $r2;
	if($r2 > 0 || ($account_name == $log_username) || ($author == $log_username)){
       //echo $r.$author.$account_name;   
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
	
	$statuslist .= '<div id="status_'.$statusid.'" class="status_boxes"><div id="post_box"><img src="'.$author_pic.'" alt="'.$author.'" title="'.$author.'" height="70px" width="50px"> <a href="users.php?u='.$author.'"><div style="display:inline;
	margin-left:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;">'.$result_author_f.' '.$result_author_l.'<div>@'.$author.'</a></div><div> '.$when_post.': '.$statusDeleteButton.'</div></div> <br />'.$note.'<br />'.$data.'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'.$statusid.'\',\'btn_tgl'.$statusid.'\')" id="btn_tgl'.$statusid.'">Expand</a></div></div><div id="rply_pst" class="rply_pst'.$statusid.'"><img class="friendpics" src="'.$dp_ownr_lnk.'" alt="'.$log_username.'" title="'.$log_username.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'.$statusid.'\')"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)" class="btn_rply">Reply</button>'.$status_replies.'</div></div>';

}
}
//$lid = $_SESSION['lastStatusid'];
echo $_SESSION['lastStatusid']."|".$statuslist;
exit();
}
exit();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<style>

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
div.reply_boxes{padding:12px; border:#999 1px solid; background:#F5F5F5;width:470px;border:thin solid #999;
	border-radius:5px;
}
div.reply_boxes > div > b{font-size:12px;}
#statusarea{
	width:530px;
	position:absolute;
	top:20%;
	left:30%;
	
    margin:10px;
	
}
#post_box{
	
	width:500px;
	border:thin solid #999;
	border-radius:5px;
	background-color:#E1E1E1;

}

</style>

</head>

<body>
<?php //echo $statuslist;?>

</body>
</html>