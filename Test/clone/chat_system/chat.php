<?php
require_once("chat.class.php");
$mode = $_POST['mode'];
$id = 0;
$chat = new Chat();

if($mode == 'SendAndRetrieveNew'){
   $name = $_POST['name'];
   $message = $_POST['message'];
   $color = $_POST['color'];
   $id = $_POST['id'];
   echo 'hello';
   if($name != "" || $message != "" || $color != ""){
	   $chat->postNewMessage($name,$message,$color);
   }
}elseif($mode == "DeleteAndRetrieveNew"){
	$chat->deleteAllMessages();
}elseif($mode == "RetrieveNew"){
    $id = $_POST['id'];
		
}

if(ob_get_length()) ob_clean();

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: text/xml');

echo $chat->retrieveNewMessages($id);
?>