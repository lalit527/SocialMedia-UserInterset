<?php
include_once('Connection/check_logged_user.php');
//include_once('Template/status_post.php');
?><?php 
   if(isset($_GET['status'])){
	   $status = preg_replace("#[^0-9]","",$_GET['status']);
	   $user = preg_replace("#[^0-9]","",$_GET['u']);
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
	padding:0;list-style:none;position:absolute;">'.$result_author_f.' '.$result_author_l.'<div>@'.$author.'</a></div><div> '.$when_post.': '.$statusDeleteButton.'</div></div> <br />'.$data.'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'.$statusid.'\',\'btn_tgl'.$statusid.'\')" id="btn_tgl'.$statusid.'">Expand</a></div></div><div id="rply_pst" class="rply_pst'.$statusid.'"><img class="friendpics" src="'.$owner_pic.'" alt="'.$log_username.'" title="'.$log_username.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'.$statusid.'\')"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$user.'\',\'replytext_'.$statusid.'\',this)" class="btn_rply">Reply</button>'.$status_replies.'</div></div>';
	/*if($isFriend == true || $log_username == $u){
	    $statuslist .= '<div id="rply_pst" class="rply_pst'.$statusid.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)">Reply</button></div>';	
	}*/
}

   }

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="Test/annesha/style.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>


<style>
#messageInclude {
	position:fixed;
	top:15%;
	left:80%;
	z-index:100000000;
	
}

body{
	margin:0;
	padding:0;
}
#status_show_div{
	width:600px;
	border:thin solid #CCC;
	border-radius:10px;
	height:600px;
	position:absolute;
	top:80px;
	left:22%;
}
#upper_status_show{
	height:200px;
	padding-left:30px;
	padding-right:30px;
	padding-top:20px;
}
#people_status{
	height:50px;
	background-color:#666;
	padding-left:30px;
	padding-top:5px;
	padding-bottom:5px;
}
#date_status{
	height:50px;
	background-color:#003;
    padding-left:30px;
	padding-top:5px;
	padding-bottom:5px;

}
#reply_status_show{
	height:70px;
	background-color:#093;
    padding-left:30px;
	padding-right:30px;
	padding-top:5px;
	padding-bottom:5px;
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
</style>
</head>

<body>
<div id="messageInclude"><?php //include_once ('Test/annesha/message_div.php'); ?>
</div>

<div id="inc"><?php include 'Test/annesha/header.php';?></div>
<div id="status_show_div">
   <div id="status_show_upper">
        <div id="upper_status_show">
            <img src="'.$author_pic.'" alt="'.$author.'" title="'.$author.'" height="70px" width="50px"> <a href="users.php?u='.$author.'"><div style="display:inline;
	margin-left:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;">
	<?php echo $result_author_f.' '.$result_author_l;?><div>
	<?php echo '@'.$author;?></a></div><div>
	<?php echo $when_post.': '.$statusDeleteButton?>
        </div><hr />
            <div id="people_status">gggggggggggggggggg</div>
            <div id="date_status">ssssssssssssssssssss</div>
            <div id="reply_status_show">lllllllllllllllll</div>
            
   </div>
   <div id="replies"></div>
   </div>
 
</div>

</body>
</html>