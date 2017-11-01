<?php
$name = "";
include_once ("chat.class.php");
$mode = preg_replace('#[^a-z]#i','',$_POST['mode']);
$id = 0;
$chat = new chat();
//if the operation is send and retrieve
if($mode = "SendAndRetrieveNew"){
	$id = $_POST['id'];
	//$color = $_POST['color'];
	//$message = $_POST['message'];
	//$name = $_POST['name'];
	echo $id;
	
	
	/*if($name != "" || $message != "" || $color != ""){
		//$chat->postMessage($name,$message,$color);
	}*/
	if($mode == "DeleteAndRetrieveNew"){
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
	echo $chat->retrieveNewMessages($id);
}
?>