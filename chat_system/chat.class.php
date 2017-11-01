<?php
require_once ("config.php");
require_once ("error_handler.php");

class Chat
{
// database handler
private $mMysqli;
// constructor opens database connection
function __construct()
{
// connect to the database
$this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
}	//destructor closes database connection
	public function __destruct()
{
$this->mMysqli->close();
}
	//delete/empty database
	public function deleteAllMessages()
{
// build the SQL query that adds a new message to the server
$query = 'TRUNCATE TABLE chat';
// execute the SQL query
$result = $this->mMysqli->query($query);
}
	public function postNewMessage($name, $message, $color, $fname)
{
// escape the variable data for safely adding them to the database
$name = $this->mMysqli->real_escape_string($name);
$message = $this->mMysqli->real_escape_string($message);
$color = $this->mMysqli->real_escape_string($color);
$fname = $this->mMysqli->real_escape_string($fname);
// build the SQL query that adds a new message to the server
$query = 'INSERT INTO chat(posted_on, user_name, message, color, friend_name) ' .
'VALUES (NOW(), "' . $name . '" , "' . $message .
'","' . $color . '","' . $fname . '")';
// execute the SQL query
$result = $this->mMysqli->query($query);
}




	//get new messages
	public function retrieveNewMessages($id=0,$name,$fname)
{
// escape the variable data
$id = $this->mMysqli->real_escape_string($id);
$name = $this->mMysqli->real_escape_string($name);
$fname = $this->mMysqli->real_escape_string($fname);
// compose the SQL query that retrieves new messages
if($id>0)
{
// retrieve messages newer than $id
$query = 'SELECT chat_id, user_name, message, color, DATE_FORMAT( posted_on,    "%Y-%m-%d %H:%i:%s" ) AS posted_on, friend_name
FROM chat 
WHERE chat_id >'.$id.' AND (   
friend_name =  "'.$fname.'" 
OR user_name =  "'.$fname.'" 
)
AND (
user_name =  "'.$name.'" 
OR friend_name =  "'.$name.'" 

 
)
 ORDER BY chat_id ASC ';
/*'SELECT chat_id, user_name, message, color, ' .
' DATE_FORMAT(posted_on, "%Y-%m-%d %H:%i:%s") ' .
' AS posted_on,friend_name ' .
' FROM chat WHERE friend_name = '.$fname.' AND chat_id > ' . $id .
' ORDER BY chat_id ASC';
(   
friend_name =  "'.$fname.'" 
OR user_name =  "'.$fname.'" 
)
AND (
user_name =  "'.$name.'" 
OR friend_name =  "'.$name.'" 

 
)
WHERE (chat_id >'.$id.' AND (friend_name = "'.$fname.'" AND user_name = "'.$name.'")) 
OR (chat_id >'.$id.' AND (friend_name = "'.$name.'" AND user_name = "'.$fname.'")) 
*/
}
else
{
// on the first load only retrieve the last 50 messages from server
$query = 'SELECT chat_id, user_name, message, color,  posted_on,friend_name FROM
(SELECT chat_id, user_name, message, color, friend_name,DATE_FORMAT(posted_on, "%Y-%m-%d %H:%i:%s") AS posted_on 
FROM chat  
 ORDER BY chat_id DESC 
 LIMIT 50) AS Last50
 WHERE (friend_name = "'.$fname.'" AND user_name="'.$name.'") OR (friend_name = "'.$name.'" AND user_name="'.$fname.'")
 ORDER BY chat_id ASC';
 /*
' SELECT chat_id, user_name, message, color, posted_on, friend_name FROM ' .
' (SELECT chat_id, user_name, message, color, ' .' DATE_FORMAT(posted_on, "%Y-%m-%d %H:%i:%s") AS posted_on ,friend_name' . 
' FROM chat  ' .
' ORDER BY chat_id DESC ' .
' LIMIT 50) AS Last50' .
' WHERE friend_name = '.$fname.'' .
' ORDER BY chat_id ASC';*/
}
// execute the query
$result = $this->mMysqli->query($query);
$query2 = "SELECT dplink FROM users WHERE username='$fname'";
$result2 = $this->mMysqli->query($query2);
$pic = $result->fetch_row();

// build the XML response
$response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
$response .= '<response>';
// output the clear flag
$response .= $this->isDatabaseCleared($id);
// check to see if we have any results
if($result->num_rows)
{
// loop through all the fetched messages to build the result message
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
$id = $row['chat_id'];
$color = $row['color'];
$userName = $row['user_name'];
$time = $row['posted_on'];
$friend_name = $row['friend_name'];
$message = $row['message'];
$response .= '<id>' . $id . '</id>' .
'<color>' . $color . '</color>' .
'<time>' . $time . '</time>' .
'<name>' . $userName . '</name>' .
'<fname>' . $friend_name . '</fname>' .
'<pic>' . $pic . '</pic>' .

'<message>' . $message . '</message>';
}
// close 	`the database connection as soon as possible
$result->close();
}
// finish the XML response and return it
$response = $response . '</response>';
return $response;
}
	private function isDatabaseCleared($id)
{
if($id>0)
{
// by checking the number of rows with ids smaller than the client's
// last id we check to see if a truncate operation was performed in // the meantime
$check_clear = 'SELECT count(*) old FROM chat where chat_id<=' . $id;
$result = $this->mMysqli->query($check_clear);
$row = $result->fetch_array(MYSQLI_ASSOC);
// if a truncate operation occured the whiteboard needs to be reset
if($row['old']==0)
return '<clear>true</clear>';
}
return '<clear>false</clear>';
	
}
}
?>