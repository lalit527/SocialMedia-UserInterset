<?php
include_once("Connection/connect.php");

$tbl_users = "CREATE TABLE IF NOT EXISTS users (
              id INT(11) NOT NULL AUTO_INCREMENT,
			  firstname VARCHAR(16) NOT NULL,
			  lastname VARCHAR(16) NOT NULL,
			  email VARCHAR(255) NOT NULL,
			  password VARCHAR(255) NOT NULL,
			  username VARCHAR(16) NOT NULL,
			  dob DATETIME NOT NULL,
			  gender ENUM('m','f') NOT NULL,	
			  country VARCHAR(255) NULL,
			  userlevel ENUM('a','b','c','d') NOT NULL DEFAULT 'a',
			  dplink VARCHAR(255) NULL,
			  ip VARCHAR(255) NOT NULL,
			  signup DATETIME NOT NULL,
			  lastlogin DATETIME NOT NULL,
			  notescheck DATETIME NOT NULL,
			  activated ENUM('0','1') NOT NULL DEFAULT '0',
              PRIMARY KEY (id),
			  UNIQUE KEY username (username,email)
             )";
$query = mysqli_query($con, $tbl_users);
if ($query === TRUE) {
	echo "<h3>user table created OK :) </h3>"; 
} else {
	echo "<h3>user table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_useroptions = "CREATE TABLE IF NOT EXISTS useroptions ( 
                id INT(11) NOT NULL,
                username VARCHAR(16) NOT NULL,
				background VARCHAR(255) NOT NULL,
				question VARCHAR(255) NULL,
				answer VARCHAR(255) NULL,
                PRIMARY KEY (id),
                UNIQUE KEY username (username) 
                )"; 
$query = mysqli_query($con, $tbl_useroptions); 
if ($query === TRUE) {
	echo "<h3>useroptions table created OK :) </h3>"; 
} else {
	echo "<h3>useroptions table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_friends = "CREATE TABLE IF NOT EXISTS friends ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                user1 VARCHAR(16) NOT NULL,
                user2 VARCHAR(16) NOT NULL,
                datemade DATETIME NOT NULL,
                accepted ENUM('0','1') NOT NULL DEFAULT '0',
                PRIMARY KEY (id)
                )"; 
$query = mysqli_query($con, $tbl_friends); 
if ($query === TRUE) {
	echo "<h3>friends table created OK :) </h3>"; 
} else {
	echo "<h3>friends table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_blockedusers = "CREATE TABLE IF NOT EXISTS blockedusers ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                blocker VARCHAR(16) NOT NULL,
                blockee VARCHAR(16) NOT NULL,
                blockdate DATETIME NOT NULL,
                PRIMARY KEY (id) 
                )"; 
$query = mysqli_query($con, $tbl_blockedusers); 
if ($query === TRUE) {
	echo "<h3>blockedusers table created OK :) </h3>"; 
} else {
	echo "<h3>blockedusers table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_status = "CREATE TABLE IF NOT EXISTS status ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                osid INT(11) NOT NULL,
                account_name VARCHAR(16) NOT NULL,
                author VARCHAR(16) NOT NULL,
                type ENUM('a','b','c') NOT NULL,
                data TEXT NOT NULL,
                postdate DATETIME NOT NULL,
                PRIMARY KEY (id) 
                )"; 
$query = mysqli_query($con, $tbl_status); 
if ($query === TRUE) {
	echo "<h3>status table created OK :) </h3>"; 
} else {
	echo "<h3>status table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_photos = "CREATE TABLE IF NOT EXISTS photos ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                user VARCHAR(16) NOT NULL,
                gallery VARCHAR(16) NOT NULL,
				filename VARCHAR(255) NOT NULL,
                description VARCHAR(255) NULL,
                uploaddate DATETIME NOT NULL,
                PRIMARY KEY (id) 
                )"; 
$query = mysqli_query($con, $tbl_photos); 
if ($query === TRUE) {
	echo "<h3>photos table created OK :) </h3>"; 
} else {
	echo "<h3>photos table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_notifications = "CREATE TABLE IF NOT EXISTS notifications ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                username VARCHAR(16) NOT NULL,
                initiator VARCHAR(16) NOT NULL,
                app VARCHAR(255) NOT NULL,
                note VARCHAR(255) NOT NULL,
                did_read ENUM('0','1') NOT NULL DEFAULT '0',
                date_time DATETIME NOT NULL,
                PRIMARY KEY (id) 
                )"; 
				
$query = mysqli_query($con, $tbl_notifications); 
if ($query === TRUE) {
	echo "<h3>notifications table created OK :) </h3>"; 
} else {
	echo "<h3>notifications table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_posts = "CREATE TABLE IF NOT EXISTS posts ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
                body VARCHAR(255) NOT NULL,
                date_added date NOT NULL,
				added_by varchar(255) NOT NULL,
                user_posted_to VARCHAR(255) NULL,
                PRIMARY KEY (id) 
                )"; 
$query = mysqli_query($con, $tbl_posts); 
if ($query === TRUE) {
	echo "<h3>photos table created OK :) </h3>"; 
} else {
	echo "<h3>photos table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_geoloc = "CREATE TABLE IF NOT EXISTS geoloc ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
				latitude VARCHAR(255) NOT NULL,
				longitude VARCHAR(255) NOT NULL,
				address VARCHAR(255) NOT NULL,
                date_added date NOT NULL,
				 PRIMARY KEY (id),
			  UNIQUE KEY latitude (latitude,longitude)
            )"; 
$query = mysqli_query($con, $tbl_geoloc); 
if ($query === TRUE) {
	echo "<h3>geo table created OK :) </h3>"; 
} else {
	echo "<h3>geo table NOT created :( </h3>"; 
}
////////////////////////////////////
$tbl_onlineUser = "CREATE TABLE IF NOT EXISTS useronline (
timestamp int(15) DEFAULT '0' NOT NULL,
username VARCHAR(20) NOT NULL,
ip varchar(40) NOT NULL,
PRIMARY KEY (username),
KEY ip (ip)

)"; 
$query = mysqli_query($con, $tbl_onlineUser); 
if ($query === TRUE) {
	echo "<h3>online table created OK :) </h3>"; 
} else {
	echo "<h3>online table NOT created :( </h3>"; 
}
//////////////////////////////////////////////////////////////
$tbl_pvtmsg = "CREATE TABLE IF NOT EXISTS pvtmsg(
                id INT(12) NOT NULL AUTO_INCREMENT,
				user_from VARCHAR(20) NOT NULL,
				user_to VARCHAR(20) NOT NULL,
				msg VARCHAR(255) NOT NULL,
				date_send DATETIME NOT NULL,
				did_read ENUM('0','1') NOT NULL DEFAULT '0',
				from_del ENUM('0','1') NOT NULL DEFAULT '0',
				to_del ENUM('0','1') NOT NULL DEFAULT '0',
                PRIMARY KEY(id),
				UNIQUE KEY user_from(user_from,user_to)				
             )";
$query = mysqli_query($con,$tbl_pvtmsg);
if ($query === TRUE) {
	echo "<h3>pvtmsg table created OK :) </h3>"; 
} else {
	echo "<h3>pvtmsg table NOT created :( </h3>"; 
}
			 
//////////////////////////////////////////////////////////////
$tbl_chat = "CREATE TABLE IF NOT EXISTS chat
(
chat_id int(11) NOT NULL auto_increment,
posted_on datetime NOT NULL,
user_name varchar(255) NOT NULL,
message text NOT NULL,
color char(7) default '#000000',
PRIMARY KEY (chat_id)
            )";
$query = mysqli_query($con,$tbl_chat);
if ($query === TRUE) {
	echo "<h3>chat table created OK :) </h3>"; 
} else {
	echo "<h3>chat table NOT created :( </h3>"; 
}
///////////////////////////////////////////////////
$tbl_group = "CREATE TABLE IF NOT EXISTS groups(
              id INT(11) NOT NULL AUTO_INCREMENT,
			  name VARCHAR(100) NOT NULL,
			  creation DATETIME NOT NULL,
			  logo VARCHAR(255) NOT NULL,
			  invrule ENUM('0','1') NOT NULL,
			  creator VARCHAR(16) NOT NULL,
              PRIMARY KEY(id)
               )";			 
$query = mysqli_query($con,$tbl_group);
if ($query === TRUE) {
	echo "<h3>group table created OK :) </h3>"; 
} else {
	echo "<h3>group table NOT created :( </h3>"; 
}
///////////////////////////////////////////////////
$tbl_gmembers = "CREATE TABLE IF NOT EXISTS gmembers(
              id INT(11) NOT NULL AUTO_INCREMENT,
			  gname VARCHAR(100) NOT NULL,
			  mname VARCHAR(100) NOT NULL,
			  creation DATETIME NOT NULL,
			  approved ENUM('0','1') NOT NULL,
			  admin ENUM('0','1') NOT NULL DEFAULT '0',
              PRIMARY KEY(id)
               )";			 
$query = mysqli_query($con,$tbl_gmembers);
if ($query === TRUE) {
	echo "<h3>group_member table created OK :) </h3>"; 
} else {
	echo "<h3>group_member table NOT created :( </h3>"; 
}
////////////////////////////////////////////////////
$tbl_grouppost = "CREATE TABLE IF NOT EXISTS grouppost(
                  id INT(11) NOT NULL AUTO_INCREMENT,
				  pid VARCHAR(16) NOT NULL,
				  gname VARCHAR(100) NOT NULL,
				  author VARCHAR(16) NOT NULL,
				  type ENUM('0','1') NOT NULL,
                  data TEXT NOT NULL,
				  pdate DATETIME NOT NULL,
                  PRIMARY KEY(id)  
                  )";
$query = mysqli_query($con,$tbl_grouppost);
if($query == TRUE) {
	echo "<h3>grouppost table created OK :) </h3>";
} else {
	echo "<h3>grouppost table not created :(</h3>";
}
////////////////////////////////////////////////////
$tbl_chatprsn = "CREATE TABLE IF NOT EXISTS chatprsn(
				  oname VARCHAR(100) NOT NULL,
				  fname VARCHAR(16) NOT NULL  
                  )";
$query = mysqli_query($con,$tbl_chatprsn);
if($query == TRUE) {
	echo "<h3>chatprsntable created OK :) </h3>";
} else {
	echo "<h3>chatprsn table not created :(</h3>";
}
////////////////////////////////////////////////////////
$tbl_album = "CREATE TABLE IF NOT EXISTS albums(
                 id INT(12) NOT NULL AUTO_INCREMENT,
				 username VARCHAR(16) NOT NULL,
				 album VARCHAR(16) NOT NULL,
				 date DATETIME NOT NULL,
				 location varchar(16) NOT NULL,
				 info varchar(16) NOT NULL, 
				 type ENUM('a','b','c') NOT NULL DEFAULT 'a',
				 PRIMARY KEY(id)
                 )";
$query = mysqli_query($con,$tbl_album);
if($query == true){
	echo "<h3>allbumtable created OK :) </h3>";
} else {
	echo "<h3>albumtable not created :(</h3>";
}
////////////////////////////////////////////////////////
$tbl_message = "CREATE TABLE IF NOT EXISTS message(
                 id INT(12) NOT NULL AUTO_INCREMENT,
				 receiver VARCHAR(16) NOT NULL,
				 sender VARCHAR(16) NOT NULL,
				 senttime DATETIME NOT NULL,
				 message text NOT NULL,
				 sdelete ENUM('0','1') NOT NULL DEFAULT '0',
				 rdelete ENUM('0','1') NOT NULL DEFAULT '0',
				 parent VARCHAR(255) NOT NULL,
				 hasreplies ENUM('0','1') NOT NULL DEFAULT '0',
				 rread ENUM('0','1') NOT NULL DEFAULT '0',
				 sread ENUM('0','1') NOT NULL DEFAULT '0',
				 PRIMARY KEY(id)
                 )";
$query = mysqli_query($con,$tbl_message);
if($query == true){
	echo "<h3>message table created OK :) </h3>";
} else {
	echo "<h3>message not created :(</h3>";
}
//////////////////////////////////////////////////////////
$tbl_info = 'CREATE TABLE work_edu IF NOT EXITS(
                id INT(11) NOT NULL AUTO_INCREMENT,
				username VARCHAR(16) NOT NULL,
				school VARCHAR(16) NOT NULL,
				college VARCHAR(16) NOT NULL,
				work VARCHAR(255) NOT NULL,
				skills VARCHAR(255) NOT NULL,
				PRIMARY KEY(id)
				)';
$query = mysqli_query($con,$tbl_info);
if($query == true){
	echo "<h3>work table created OK :) </h3>";
} else {
	echo "<h3>work not created :(</h3>";
}
////////////////////////////////////////////////////////////
$tbl_places = 'CREATE TABLE places IF NOT EXITS( 
                id INT(11) NOT NULL AUTO_INCREMENT,
				username VARCHAR(16) NOT NULL,
				current VARCHAR(255) NOT NULL,
				home VARCHAR(255) NOT NULL,
				PRIMARY KEY(id)

)';
$query = mysqli_query($con,$tbl_places);
if($query == true){
	echo "<h3>place table created OK :) </h3>";
} else {
	echo "<h3>place not created :(</h3>";
}
////////////////////////////////////////////////////////////
$tbl_likes = 'CREATE TABLE likes IF NOT EXITS( 
                id INT(11) NOT NULL AUTO_INCREMENT,
				name VARCHAR(16) NOT NULL,
				pic VARCHAR(255) NOT NULL,
				type VARCHAR(255) NOT NULL,
				PRIMARY KEY(id)

)';
$query = mysqli_query($con,$tbl_likes);
if($query == true){
	echo "<h3>likes table created OK :) </h3>";
} else {
	echo "<h3>likes not created :(</h3>";
}
////////////////////////////////////////////////////////////
$tbl_likesmember = 'CREATE TABLE likesmembers IF NOT EXISTS ( 
                id INT(11) NOT NULL AUTO_INCREMENT,
				name VARCHAR(16) NOT NULL,
				
				type VARCHAR(255) NOT NULL,
				username VARCHAR(255) NOT NULL,
				PRIMARY KEY(id)

)';
$query = mysqli_query($con,$tbl_likesmember);
if($query == true){
	echo "<h3>likesmember table created OK :) </h3>";
} else {
	echo "<h3>likesmember not created :(</h3>";
}
////////////////////////////////////////////////////////
$tbl_media = "CREATE TABLE IF NOT EXISTS media(
                    id INT(15) NOT NULL AUTO_INCREMENT,
					
					username VARCHAR(255) NOT NULL,
					file VARCHAR(255) NOT NULL,
				    type ENUM('a','b','c') NOT NULL,
					posted DATETIME NOT NULL,
					PRIMARY KEY(id)

)"; 
$query = mysqli_query($con,$tbl_media);
if($query == true){
	echo "<h3>media table created OK :) </h3>";
} else {
	echo "<h3>media not created :(</h3>";
}
?>