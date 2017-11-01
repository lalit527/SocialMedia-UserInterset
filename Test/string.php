<?php
$lat = 87.99999999;
$lat_epld = explode('.',$lat);
$frst = $lat_epld[0];
$scnd = $lat_epld[1];
$scnd_prsn = substr($scnd,0,4);
$arr = array($frst,$scnd_prsn);
$arr_nw = implode('.',$arr);
//echo ''.$frst;
//echo ''.$arr[0];
echo ''.$arr_nw;

?>