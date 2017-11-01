<?php
include_once('../../Connection/check_logged_user.php');


function putData($x,$y){
$strng = file_get_contents("../../Users/".$y."/".$x.".txt");
$arr = explode("\r\n",$strng);
print_r($arr);
$temp = array();
for($i=0;$i<sizeof($arr)-1;$i++){
	$new = explode("=",$arr[$i]);
	$got[$new[0]] = $new[1];
	//echo $new[1]."<br />";
}
arsort($got);
$new_arr = array_slice($got,0,3);
//$s = implode(" ",$new_arr[0].$new_arr[1]);
//echo $s;
$file1 = fopen("../../Users/".$y."/".$x.".txt","w+");

foreach($new_arr as $key=>$values){
	 file_put_contents("../../Users/".$y."/".$x.".txt", $key."=".$values."\r\n",FILE_APPEND);
}

print_r($new_arr);
}
?>