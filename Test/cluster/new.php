<?php
include_once '../../Connection/check_logged_user.php';
/*$dir = "../../Users/".$log_username;
$file1 = fopen($dir."/like.txt","w");
$sql = "SELECT name_id FROM likesmembers WHERE username='$log_username'";
$query = mysqli_query($con,$sql);
$num_rows = mysqli_num_rows($query);
if($num_rows > 0){
	while($res = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$name_id = $res['name_id'];
		echo $name_id;
		$sql_nm = "SELECT name,type,category FROM likes WHERE name_id='$name_id'";
		$query_nm = mysqli_query($con,$sql_nm);
		$num_nm = mysqli_num_rows($query_nm);
		if($num_nm > 0){
			while($res_nm = mysqli_fetch_array($query_nm,MYSQLI_ASSOC)){
				$name = $res_nm['name'];
				
				$type = $res_nm['type'];
				echo $type;
				$category = $res_nm['category'];
				$data = $type."|".$category;
  				fwrite($file1,$data." ");
			}
		}
	}
}
echo $data;*/
$dir = "../../Users/".$log_username;
$file1 = fopen($dir."/test.txt","r");
$file2 = fopen($dir."/content.txt","w+");
$file_contnt = file_get_contents($dir."/test.txt");

getCat($file_contnt,$log_username);
function getCat($x,$y){
	
	$array = explode(" ",$x);
	$movies = array();
	$sports = array();
	$books = array();
	$brands = array();
	$tv = array();
	$music = array();
	for($i=0;$i<sizeof($array);$i++){
		//foreach($array as $i){
			$string = $array[$i];
			$string = explode("|",$string);
			for($j=0;$j<1;$j++){
				if($string[$j] == "movies"){
					$str = implode("|",$string);
					array_push($movies,$str);
				}
				if($string[$j] == "sports"){
					$str = implode("|",$string);
					array_push($sports,$str);
					
					
				}
				if($string[$j] == "music"){
					$str = implode("|",$string);
					array_push($music,$str);
				}
				if($string[$j] == "books"){
					$str = implode("|",$string);
					array_push($books,$str);
				}
				if($string[$j] == "tv"){
					$str = implode("|",$string);
					array_push($tv,$str);
				}
				if($string[$j] == "brands"){
					$str = implode("|",$string);
					array_push($brands,$str);
				}
			}
		/*if(strpos($string,"movies") != -1){
			
			echo $array[$i].'<br />';
		}*/
				
	}
	
	getClustr($movies,$y);
	getClustr ($sports,$y);
	getClustr ($books,$y);
	print_r ($books);
	print_r ($music);
	print_r ($tv);
	print_r ($brands);
	print_r ($sports);
	print_r ($movies);
	
	//call_user_func_array('getClus', $movies);
	
	
}

function getClustr(array $s,$y){
	 
	$result = array();
	$ispresent = false;
	
		for($i=0;$i<count($s);$i++){
			$countword = 0;
			$flag = 0;
			//echo $s[$i];
			$string = explode("|",$s[$i]);
		   $frst = $string[1];
		   for($k=($i-1);$k>=0;$k--){
			   if($s[$k]==$s[$i]){
				   $flag = 1;
			   }
			   
		   }
		    //echo ''.$frst;
		   		   if($flag == 0){
			   //echo 'hello';
			   
		   for($j=0;$j<count($s);$j++){
			//echo 'z';
			   $str = explode("|",$s[$j]);
			   $chk = $str[1];
			  
			   if($frst == $chk){
				   ++$countword;
				  // echo $countword;
				  $res = array($s[$i] => $countword);
				 // array_push($result,$res);
			   }else{
				  // echo 'ffff';
		       $res = array($s[$i] => $countword);
			   //array_push($result,$res);
			   }
			   //array_push($result,$res);
				  
		   }
		      
			   array_push($result,$res);
		   }
		      //array_unique($res);
		      
		   }
		  // file_put_contents("../../Users/".$log_username."/content.txt",$result,FILE_APPEND);
		  $tmpArr = array();
foreach ($result as $sub) {
	//echo $sub;
	
  foreach($sub as $f=>$h){
	  echo $f."=".$h."<br />";
	  $z = $f."=".$h."\r\n";
	  file_put_contents("../../Users/".$y."/content.txt",$z,FILE_APPEND);

  }
}
foreach ($result as $sub) {
	
	
  foreach($sub as $f=>$h){
	  
	  echo $f."=".$h."<br />";
	  $z = $f."=".$h."\r\n";
	  //file_put_contents("../../Users/".$y."/content.txt",$z,FILE_APPEND);

  }
}

//$result = implode('|', $tmpArr);
echo $y;
		  		print_r ($sub);
				print_r ($result);
	}
	
	//$dir = "../../Users/".$log_username;
//$file1 = fopen($dir."/test.txt","r");
/*$file2 = fopen($dir."/content.txt","r");
$file_contnt = file_get_contents($dir."/content.txt");
$str = explode("\r\n",$file_contnt);
print_r ($str);*/

 ?>