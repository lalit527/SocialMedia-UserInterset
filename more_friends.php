<?php
include_once("Connection/check_logged_user.php");
// Make sure the user is logged in
if(isset($_SESSION['username'])){
	$u = $_SESSION['username'];
} else {
    echo "You need to be logged in.";
    exit();	
}
// Initialize Some Things
$moMoFriends = "";
$my_friends = array();
$their_friends = array();
// Get Friend Array
$sql = "SELECT user1, user2 
		FROM friends 
		WHERE (user1='$u' OR user2='$u')
		AND accepted='1'";		
$query = mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows > 0){
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		array_push($my_friends, $row["user2"]);
		array_push($my_friends, $row["user1"]);
	} 
	//remove your id from array
	$my_friends = array_diff($my_friends, array($u));
	//reset the key values
	$my_friends = array_values($my_friends);
	mysqli_free_result($query);
} else {
	//$sql = "SELECT username FROM users WHERE ";
}
// Get Friends Of Friends Array
// Exclude Yourself From Query
foreach ($my_friends as $k => $v) {
	// You may want to edit limit at end of following query ....example... LIMIT 50
	$sql = "SELECT user1, user2 
			FROM friends 
			WHERE (user1='$v' OR user2='$v') 
			AND accepted='1' 
			AND user1!='$u' 
			AND user2!='$u' 
			LIMIT 50";
	$query = mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($query);
	if ($numrows > 0){
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			array_push($their_friends, $row["user2"]);
			array_push($their_friends, $row["user1"]);
		}
	}
	//remove any duplicates
	$their_friends = array_unique($their_friends);
	// remove common friends
	$their_friends = array_diff($their_friends, $my_friends);
	// reset array values
	$their_friends = array_values($their_friends);
	mysqli_free_result($query);
}
// Build Output From Results
if (array_key_exists('0', $their_friends)){
	$moMoFriends = '<div id="moMoFriends">';
	$moMoFriends .= '<h2>People You May Like</h2>';
	foreach ($their_friends as $k2 => $v2){
		$query = mysqli_query($con, "SELECT dplink FROM users WHERE username='$v2'LIMIT 1");
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$moMoFriends .= '<a href="users.php?u='.$v2.'"><img src=" Users/'.$v2.'/'.$row["dplink"].'" alt="'.$v2.'" title="'.$v2.'" width="80px"></a>&nbsp;&nbsp;';
		}
	}
	$moMoFriends .= '</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/style.css">
</head>
<body>
<?php //include_once("template_pageTop.php"); ?>
<div id="pageMiddle"><?php echo $moMoFriends ?></div>
<?php //include_once("template_pageBottom.php"); ?>
</body>
</html>