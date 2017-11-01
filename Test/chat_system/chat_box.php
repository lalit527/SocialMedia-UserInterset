<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php
//if(isset($_POST['username']) && isset($_POST['sendTo'])){
	$name = "";
	$user_frnd = "";
	$name =  $_GET['f'];
	$user_frnd = $_GET['u'];
	
	/*$name_var = explode('.',$name);
	$user = $name_var[0];
	$user_frnd = $name_var[1];*/
$chat_table = '<div id="total">
<div id="chat_header">'.$name.$user_frnd.'<div id="close" style="float:right">X</div></div>
<table id="content" width="150" height="300">
<tr>
<td>
</td>
<td id="colorpicker" style="display:none">
<br />
<input id="color" type="hidden" readonly value="#000000" style="display:none"/>
<span id="sampleText" style="display:none">
</span>
</td>
</tr>
</table>
<div id="go">
<input type="text" id="userName" value="'.$user_frnd.'" maxlength="10" size="10" 
onblur="checkUsername('.$user_frnd.');" style="display:none"/>
<input type="text" id="messageBox" maxlength="2000" size="75"
onkeydown="handleKey(event)"/>
<input type="button" value="Send" onclick="sendMessage(\''.$name.'\',\''.$user_frnd.'\');" />
<input type="button" value="clear window" onclick="deleteMessages();"/>

</div>
</div>';
/*}else{
	echo 'illegal access';
}*/

//echo $chat_table;
?>
<!DOCTYPE HTML>
<html>
<head>
<title>AJAX Chat</title>

<meta http-equiv="Cache-Control" content="no-store" />


<link href="chat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="chat2.js" ></script>
</head>
<body onload="init()">
<noscript>
Your browser does not support JavaScript!!
</noscript>
<?php //echo $chat_table; ?>
<p><div id="scroll">
kkkkkkkkkkkkkkkkkkkkk</div>
</p>
</body>
</html>