<?php  
include_once("Connection/connect.php");
$data = '';
$pic = '';
if(isset($_GET['name']) && isset($_GET['file'])){
	$u = preg_replace("#[^a-z0-9]#i","",$_GET['name']);
    
    $f = preg_replace("#[^a-z0-9.]#i","",$_GET['file']);
   	$sql = "SELECT src FROM photos WHERE user='$u' AND gallery='$g' AND filename='$f' LIMIT 1";
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_row($query);
	
	$data = $row[0];
	$pic = '<img src="'.$data.'" style="width:700px;height:600px" onmouseover="openX()">';
}


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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