 <?php
include_once '../../Connection/check_logged_user.php';
include_once 'clustr.php';

$dir = "../../Users/".$log_username;
//$file1 = fopen($dir."/test.txt","r");
$file2 = fopen($dir."/content.txt","r");
$file_contnt = file_get_contents($dir."/content.txt");
$arr_res = explode("\r\n",$file_contnt);
print_r($arr_res);
$all = array();
$d = array();
for($i=0;$i<sizeof($arr_res)-1;$i++){

    $result = explode("=",$arr_res[$i]);

}
for($i=0;$i<sizeof($arr_res)-1;$i++){
	$flag = 0;
	$new_res = explode("|",$arr_res[$i]);
	$file2 = fopen($dir."/".$new_res[0].".txt","w+");
	echo $new_res[0]."\r\n";
	//array_push($all,$new_res[1]);
	//$arr = explode(" ",$new_res[1]);
	//print_r ($all);
	for($k=($i);$k>=0;$k--){
		$ff = explode("|",$arr_res[$k]);
		//$real = explode("=",$ff[1]);
		
			   if($ff[0]==$new_res[0]){
				   $flag = 1;
				   $str_snd = $ff[1]."\r\n";
				   array_push($d,$ff[0]);
				   $file_name = "../../Users/".$log_username."/".$ff[0].".txt";
				   //putData($file_name,$str_snd);
				   				 file_put_contents("../../Users/".$log_username."/".$ff[0].".txt", $str_snd,FILE_APPEND);  
				   //echo $ff[1]."--";
                   
			   }
			  
		   }
		  		  }
				  $x = array_unique($d);
				  foreach($x as $use){
					  putData($use,$log_username);
				  }
//print_r($x);
?>