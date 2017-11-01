<?php

$status_ui = "";
$statuslist = "";
if($isOwner == "yes"){
	$status_ui = '<div id="post_div">';
	$status_ui .= '<p>Compose new Post</p>';
	$status_ui .= '<span id="status_span" style="float:right;"></span>';
	$status_ui .= '<textarea id="text_post" rows="5"
	 cols="60" onkeyup="statusMax(this,250)" onfocus="showPostDiv()" placeholder="What new about you '.$log_username.'?"></textarea>';
	 $status_ui .= '<div id="postbutton_div" style="display:none">';
	$status_ui .= '<button id="post" onclick="postToStatus(\'status_post\',\'a\',\''.$u.'\',\'text_post\')">Post</button>';
	$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div></div>';
}else if($isFriend == true && $log_username != $u){
	$status_ui = '<div id="post_div">';
	$status_ui .= '<p>Status</p>';
	$status_ui .= '<span id="status_span" style="float:right;"></span>';
	
	$status_ui .= '<textarea id="text_post" rows="5"
	 cols="60" onkeyup="statusMax(this,250)" placeholder="Hi '.$log_username.', say something to '.$u.'"></textarea>';
	 $status_ui .= '<div id="postbutton_div" style="display:none">';
		$status_ui .= '<button id="post" onclick="postToStatus(\'status_post\',\'c\',\''.$u.'\',\'text_post\')">Post</button>';
$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div>';

}
?><?php 
$sql = "SELECT * FROM status WHERE account_name='$u' AND type='a' OR account_name='$u' AND type='c' AND type='d' ORDER BY postdate DESC LIMIT 20";
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
	if($type == "d"){
		$sql_photo_albm = "SELECT filename FROM photos WHERE user='$account_name' AND gallery='$data'";
		$query_photo_albm = mysqli_query($con,$sql_photo_albm);
		while($row_albm = mysqli_fetch_array($query_photo_albm,MYSQLI_ASSOC)){
			$pic = $row_albm['filename'];
			$img .= '<img src="Users/'.$account_name.'/album/'.$data.'/'.$pic.'" style="height:200;width:240;display: inline;
  margin: 5px;
  border: 1px solid #ffffff;" onclick="showPic(\''.$account_name.'\',\'album\',\''.$data.'\',\''.$pic.'\')">'; 
		}
		$data = '<div style="height: auto;
  width: auto;
  float: left;
  ">'.$img.'</div>';
		
	}
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
	
	_(x).style.border = "thick solid blue";
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
<div id="statusarea">
  <?php echo $statuslist; ?>
</div>
