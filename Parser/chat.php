<?php
include_once ("chat.class.php");
$mode = $_POST['mode'];
$id = 0;
$chat = new chat();
//if the operation is send and retrieve
if($mode = "SendAndRetrieveNew"){
	$name = $_POST['name'];
	$message = $_POST['message'];
	$color = $_POST['color'];
	$id = $_POST['id'];
	if($name != "" || $message != "" || $color != ""){
		$chat->postMessage($name,$message,$color);
	}
	elseif($mode == "DeleteAndRetrieveNew"){
		$chat->deleteMessages();
	}
	elseif($mode == "RetrieveNew"){
         $id = $_POST['id'];		
	}
	//clear the output
	if(ob_get_length()) ob_clean();
	// Headers are to prevent browsers from caching
	header('Expires: Mon,26 jul 1997 05:00:00 GMT');
	header('Last-Modified: '. gmdate('D, d M Y H:i:s'). 'GMT' );
	header('Cache-control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	header('Content-type: text/xml');
	echo $chat->RetrieveNewMesssages($id);
}
?>