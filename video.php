<?php  
include_once("Connection/connect.php");
$data = '';
$pic = '';
if(isset($_GET['name']) && isset($_GET['file'])){
	$u = preg_replace("#[^a-z0-9]#i","",$_GET['name']);
    $f = preg_replace("#[^a-z0-9.]#i","",$_GET['file']);
   	$sql = "SELECT src FROM media WHERE username='$u' AND file='$f' AND type='a' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_row($query);
	
	$vdo = $row[0];
	$pic = '
  <embed src="'.$vdo.'" width="700" height="500">

  ';
}


?>




<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
#big_area_pic {
	position:absolute;
	width:790px;
	height:600px;
	
}
#main_picarea{
	position:absolute;
	width:700px;
	height:600px;
	background-color:#000;
    
	border:thin solid #000;
	left:50px;

	
}
</style>
<script>
changeDim(<?php echo $s;?>);
function changeDim(x){
	document.getElementById('preview_cp'+x).style.width = 700;
	document.getElementById('preview_cp'+x).style.width = 600;
	
}
function openX(){
	document.getElementById('closeit').style.display = 'block';
}
</script>
</head>

<body>
<div id="big_area_pic">
<div id="closeit" style="float:right;font-size:36px;margin-right:7px;"><a href="#" onclick="return false;" onmousedown="closeCanvas()" style="text-decoration:none;">X</a></div>
<div id="main_picarea" >

<?php echo $pic; ?>
</div>

</div>
</body>
</html>