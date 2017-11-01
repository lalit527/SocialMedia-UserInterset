<?
//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<?php
if(isset($_GET['u']) && isset($_GET['f'])){
	$name =  $_GET['u'];
	$fname =  $_GET['f'];
$chat_table = '<div id="total">
<div id="chat_header">'.$fname.'</div>
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
<input type="text" id="userName" maxlength="10" size="10" onblur="checkUsername();" style="display:none" value="'.$name.','.$fname.'"/>
<input type="text" id="messageBox" maxlength="2000" size="75"
onkeydown="handleKey(event)"/>
<input type="button" value="Send" onclick="sendMessage();" />
<input type="button" value="clear window" onclick="deleteMessages();"/>

</div>
</div>';
/*}else{
	echo 'illegal access';
}*/

//echo $chat_table;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>AJAX Chat</title>

<meta http-equiv="Cache-Control" content="no-store" />


<link href="chat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="chat.js">
</script>
</head>
<body onload="init();">
<noscript>
Your browser does not support JavaScript!!
</noscript>
<?php echo $chat_table; ?>
</body>
</html>