<?php
require_once("chat.class.php");
$mode = $_POST['mode'];
$id = 0;
$chat = new Chat();

if($mode == 'SendAndRetrieveNew'){
   $name = $_POST['name'];
   $fname = $_POST['fname'];
   $message = $_POST['message'];
   $color = $_POST['color'];
   $id = $_POST['id'];
   
   if($name != "" || $message != ""){
	   $chat->postNewMessage($name,$message,$color,$fname);
	   echo 'hello';
   }
}elseif($mode == "DeleteAndRetrieveNew"){
	$chat->deleteAllMessages();
}elseif($mode == "RetrieveNew"){
    $id = $_POST['id'];
	$name = $_POST['name'];
	$fname = $_POST['fname'];
}

if(ob_get_length()) ob_clean();

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: text/xml');

echo $chat->retrieveNewMessages($id,$name,$fname);
?>