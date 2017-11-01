
<?php
//if(isset($_POST['username']) && isset($_POST['sendTo'])){
	//echo $_GET['f'];
$f = $_GET['f'];
$u = $_GET['u'];	
$chat_table = '<div id="total">
<div id="chat_header">hhhhhhhhhhhhhhhhhhhhhhhhh</div>
<table id="content" width="150" height="300">
<tr>
<td>
<div id="scroll">
</div>
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
<input type="text" id="userName" maxlength="10" size="10" onblur="checkUsername();" style="display:none"/>
<input type="text" id="messageBox" maxlength="2000" size="75"
onkeydown="handleKey(event)"/>
<input type="button" value="Send" onclick="sendMessage(\''.$f.'\',\''.$u.'\');" />
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="chat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="chat2.js" ></script>
</head>
<body onload="init()">
<noscript>
Your browser does not support JavaScript!!
</noscript>
<?php echo $chat_table; ?>
</body>
</html>