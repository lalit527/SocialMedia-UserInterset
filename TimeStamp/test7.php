<?php
include_once ("time_ago.php");
$timeAgoObject = new convertToAgo;
$ts = "2014-02-27 13:00:50";
$convertedTime = ($timeAgoObject -> convert_dateTime($ts));
$when = ($timeAgoObject -> makeAgo($convertedTime));
echo "".$when;
?>