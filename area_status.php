<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="status_'.$statusid.'" class="status_boxes" ><div class="post_box" id="postBox_'.$statusid.'" onmouseout="chBBcolor(\'postBox_'.$statusid.'\')" onmouseover="changeBBcolor(\'postBox_'.$statusid.'\')" onclick="gotoPost(\'postBox_'.$statusid.'\',\'postBox_'.$u.'\')"><img src="'.$author_pic.'" alt="'.$author.'" title="'.$author.'" height="70px" width="50px" > <a href="users.php?u='.$author.'"><div style="display:inline;
	margin-right:7px;
	vertical-align:text-top;
	padding:0;list-style:none;position:absolute;">'.$result_author_f.' '.$result_author_l.'<div>@'.$author.'</a></div><div> '.$when_post.': '.$statusDeleteButton.'</div></div> <br />'.$note.'<br />'.$data.'<div><a href="#" onclick="return false" onmousedown="expand(\'rply_pst'.$statusid.'\',\'btn_tgl'.$statusid.'\')" id="btn_tgl'.$statusid.'">Expand</a></div></div><div id="rply_pst" class="rply_pst'.$statusid.'"><img class="friendpics" src="'.$owner_pic.'" alt="'.$log_username.'" title="'.$log_username.'"><textarea id="replytext_'.$statusid.'" class="rply_pst" onkeyup="statusMax(this,250)" placeholder="write a comment here" onfocus="showBtn(\'replyBtn_'.$statusid.'\')"></textarea><button id="replyBtn_'.$statusid.'" onclick="replyToStatus('.$statusid.',\''.$u.'\',\'replytext_'.$statusid.'\',this)" class="btn_rply">Reply</button>'.$status_replies.'</div></div><div id="rply_pst" class="rply_pst'+sid+'"><img class="friendpics" src="<?php echo $owners_pic;?>" alt="<?php echo $log_username;?>" title="<?php echo $log_username;?>">
</body>
</html>