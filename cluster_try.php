<?php
include_once ('Connection/check_logged_user.php');
$sql = "SELECT data FROM status WHERE author='$log_username'";
$query = mysqli_query($con,$sql);
$rows = mysqli_num_rows($query);
$all_data = array();
if($rows > 0){
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$data = $row['data'];
		//$data = strip_tags($data);
		array_push($all_data,$data);
	}
	
}
//$all_data = strip_tags($all_data);
$all_data = preg_replace("#[^a-z ]#i","",$all_data);

//print_r ($all_data);

$stopwords = 'a, about, above, above, across, after, afterwards, again, against, all, almost, alone, along, already, also,although,always,am,among, amongst, amoungst, amount,  an, and, another, any,anyhow,anyone,anything,anyway, anywhere, are, around, as,  at, back,be,became, because,become,becomes, becoming, been, before, beforehand, behind, being, below, beside, besides, between, beyond, bill, both, bottom,but, by, call, can, cannot, cant, co, con, could, couldnt, cry, de, describe, detail, do, done, down, due, during, each, eg, eight, either, eleven,else, elsewhere, empty, enough, etc, even, ever, every, everyone, everything, everywhere, except, few, fifteen, fify, fill, find, fire, first, five, for, former, formerly, forty, found, four, from, front, full, further, get, give, go, had, has, hasnt, have, he, hence, her, here, hereafter, hereby, herein, hereupon, hers, herself, him, himself, his, how, however, hundred, ie, if, in, inc, indeed, interest, into, is, it, its, itself, keep, last, latter, latterly, least, less, ltd, made, many, may, me, meanwhile, might, mill, mine, more, moreover, most, mostly, move, much, must, my, myself, name, namely, neither, never, nevertheless, next, nine, no, nobody, none, noone, nor, not, nothing, now, nowhere, of, off, often, on, once, one, only, onto, or, other, others, otherwise, our, ours, ourselves, out, over, own,part, per, perhaps, please, put, rather, re, same, see, seem, seemed, seeming, seems, serious, several, she, should, show, side, since, sincere, six, sixty, so, some, somehow, someone, something, sometime, sometimes, somewhere, still, such, system, take, ten, than, that, the, their, them, themselves, then, thence, there, thereafter, thereby, therefore, therein, thereupon, these, they, thickv, thin, third, this, those, though, three, through, throughout, thru, thus, to, together, too, top, toward, towards, twelve, twenty, two, un, under, until, up, upon, us, very, via, was, we, well, were, what, whatever, when, whence, whenever, where, whereafter, whereas, whereby, wherein, whereupon, wherever, whether, which, while, whither, who, whoever, whole, whom, whose, why, will, with, within, without, would, yet, you, your, yours, yourself, yourselves, the,wow,hello';
//$stopwords = '"the","is","and","your","me","for","where","the","hello","wow"';
$stopwords = explode(",",$stopwords);
$stopwords = array_flip($stopwords);
//$all_data = preg_replace("#'$stopwords'#i","",$all_data);

$result=array(); $temp=array();
foreach ($all_data as $s)
if (isset($stopwords[$s]) OR strlen($s)<3)
 {
 if (sizeof($temp)>0)
  {
  $result[]=implode(' ',$temp);
  $temp= "";
  }            
 } else $temp[]=$s;

if (sizeof($temp)>0) $result[]=implode(' ',$temp);

//
//echo sizeof($result);
print_r ($result);

$phrases=array_count_values($result);
arsort($phrases);
print_r ($phrases);

//$res = implode("|",$result);
//echo $res;
//$rest = explode("|",$res);
//print_r ($rest);
//$count = array();

/*foreach($rest as $i){
	$count[$i] = 0; 
	for($j=$i+1;$j<sizeof($rest);$j++){
	if($rest[$i] == $rest[$j]){
		
		++$count[$i];
	}
	}
	$i++;
}
//print_r ($rest);
//$dir = "Users/".$log_username;
//$file = $log_username.".txt";
//$file1 = fopen($dir."/cluster.txt","w");
//if(!file_exists("$dir/$file")){
	//		mkdir("$dir/$file", 0755, TRUE);
		//	}

			
foreach($result as $i){
	fwrite($file1,$i.'|');
	
}

while (!feof($file1)) {
$line = fgets($file1);
echo $line;
}
echo 'done';
fclose($file1);
?><?php
/*$dir = "Users/".$log_username;
$file1 = fopen($dir."/cluster.txt","w");

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
  				$fl = array(
	                    array($type,$category)	
				);
			}
		}
	}
}
echo $fl[0][0];*/
?>