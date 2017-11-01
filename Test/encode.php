
<?php
/*$id = "hello world";

$id1 =  str_replace("l","P",$id);

echo $id1;*/
?>

<?php
/*$d = "hello world I will b onl9-yoi :)";
$d1 = "";
$d2 = "";
echo strlen($d);

for($i=0;$i<strlen($d);$i++){
	//echo $d[$i];
	$d1 .= encodeData($d[$i]);
	
}
/*for($i=0;$i<strlen($d1);$i++){
	//echo $d[$i];
	$d2 .= $cl->encodeData($d1[$i]);
	
}*/

//echo $d1;
//echo $d2;

/*function get_rand_id($length)
{
  if($length>0) 
  { 
  $rand_id="";
   for($i=1; $i<=$length; $i++)
   {
   mt_srand((double)microtime() * 1000000);
   $num = mt_rand(1,62);
   $rand_id .= assign_rand_value($num);
   }
  }
return $rand_id;
}*/
class encode{
function encodeData($num)
{
   $rand_value = "";
 //echo $num.'<br />';
  switch($num)
  {
	  /*case $num:
     $rand_value = $num;
    break;*/
    
    case "-":
     $rand_value = " ";
    break;
    
    case " ":
     $rand_value = "-";
    break;
    
	case "a":
     $rand_value = "Z";
    break;
    case "b":
     $rand_value = "Y";
    break;
    case "c":
     $rand_value = "X";
    break;
    case "d":
     $rand_value = "W";
    break;
    case "e":
     $rand_value = "V";
    break;
    case "f":
     $rand_value = "U";
    break;
    case "g":
     $rand_value = "T";
    break;
    case "h":
     $rand_value = "S";
    break;
    case "i":
     $rand_value = "R";
    break;
    case "j":
     $rand_value = "Q";
    break;
    case "k":
     $rand_value = "P";
    break;
    case "l":
     $rand_value = "O";
    break;
    case "m":
     $rand_value = "N";
    break;
    case "n":
     $rand_value = "M";
    break;
    case "o":
     $rand_value = "L";
    break;
    case "p":
     $rand_value = "K";
    break;
    case "q":
     $rand_value = "J";
    break;
    case "r":
     $rand_value = "I";
    break;
    case "s":
     $rand_value = "H";
    break;
    case "t":
     $rand_value = "G";
    break;
    case "u":
     $rand_value = "F";
    break;
    case "v":
     $rand_value = "E";
    break;
    case "w":
     $rand_value = "D";
    break;
    case "x":
     $rand_value = "C";
    break;
    case "y":
     $rand_value = "B";
    break;
    case "z":
     $rand_value = "A";
    break;
    case "A":
     $rand_value = "z";
    break;
    case "B":
     $rand_value = "y";
    break;
    case "C":
     $rand_value = "x";
    break;
    case "D":
     $rand_value = "w";
    break;
    case "E":
     $rand_value = "v";
    break;
    case "F":
     $rand_value = "u";
    break;
    case "G":
     $rand_value = "t";
    break;
    case "H":
     $rand_value = "s";
    break;
    case "I":
     $rand_value = "r";
    break;
    case "J":
     $rand_value = "q";
    break;
	case "K":
     $rand_value = "p";
    break;
    case "L":
     $rand_value = "o";
    break;
    case "M":
     $rand_value = "n";
    break;
    case "N":
     $rand_value = "m";
    break;
    case "O":
     $rand_value = "l";
    break;
    case "P":
     $rand_value = "k";
    break;
    case "Q":
     $rand_value = "j";
    break;
    case "R":
     $rand_value = "i";
    break;
    case "S":
     $rand_value = "h";
    break;
    case "T":
     $rand_value = "g";
    break;
    case "U":
     $rand_value = "f";
    break;
    case "V":
     $rand_value = "e";
    break;
    case "W":
     $rand_value = "d";
    break;
    case "X":
     $rand_value = "c";
    break;
    case "Y":
     $rand_value = "b";
    break;
    case "Z":
     $rand_value = "a";
    break;
    case "0":
     $rand_value = "9";
    break;
    case "1":
     $rand_value = "8";
    break;
    case "2":
     $rand_value = "7";
    break;
    case "3":
     $rand_value = "6";
    break;
    case "4":
     $rand_value = "5";
    break;
    case "5":
     $rand_value = "4";
    break;
    case "6":
     $rand_value = "3";
    break;
    case "7":
     $rand_value = "2";
    break;
    case "8":
     $rand_value = "1";
    break;
    case "9":
     $rand_value = "0";
    break;
    default:
	$rand_value = $num;
	break;
  }
return $rand_value;
}


}
?>
