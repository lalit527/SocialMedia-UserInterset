<?php 
//include_once('../Connection/check_logged_user.php');
//$u = preg_replace("#[^a-z0-9]#i","",$_GET['u']);
$a1 = '';
$a2 = '';
$album = "";
	$album_html = '';	
$all_file = array();
$sql = "SELECT * From albums WHERE username='$u'";
$query = mysqli_query($con,$sql);
$numrow = mysqli_num_rows($query);
//$row = mysqli_fetch_array($query);
//$row1 = $row[0];
//echo ''.$row1;
if($numrow > 0){
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$album = $row['album'];
		$album_id = $row['album_id'];
		$location = $row['location'];
		$info = $row['info'];
		$type = $row['type'];
		$date = $row['date'];
		//$album = $row[];
		
		$sql_cnt = "SELECT COUNT(id) FROM photos WHERE gallery='$album_id' AND user='$u'";
	    $query_cnt = mysqli_query($con,$sql_cnt);
		$count = mysqli_fetch_row($query_cnt);
		$count = $count[0];
		$sql_id = "SELECT filename FROM photos WHERE gallery='$album_id' AND user='$u' ORDER BY uploaddate DESC LIMIT 1";
		$query_id = mysqli_query($con,$sql_id);
		$numrow_1 = mysqli_num_rows($query_id);
		$file = '';
		if($numrow_1 > 0){
			while($row_pic = mysqli_fetch_array($query_id,MYSQLI_ASSOC)){
				$file = $row_pic['filename'];
				
				//$a2 .= $file;
			}
		}
		
		$album_html .= '<a href="#" onclick="return false" onmouseover="changeContnt(\''.$album_id.'\',\''.$u.'\')" 
		onmousedown="showContnt(\''.$album_id.'\',\''.$u.'\')"><div class="album_all_div" id="album_all"  ><div id="album_contnt"><img src="Users/'.$u.'/album/'.$album_id.'/'.$file.'" style="width:200px;height:200px;"></div></a><div id="album_info">'.$album.'<br />'.$count.' photos<br /><br /></div></div>';
	}
	
}
//echo $album_html;
		//echo $a2;

?><?php 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function video(){
	document.getElementById('video_include').style.display = 'block';
   $('#video_include').load("album/upload.php");

};
function album(){
	window.location = "album/uploads_image.php";
}
function audio(){
	document.getElementById('audio_include').style.display = 'block';
   $('#audio_include').load("upload.php");

}
function changeContnt(x,y){
	
	var ajax = ajaxObj("POST","../Parser/changePic_parser.php");
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			
		}
	}
}
function showContnt(x,y){
	//alert(""+x+y);
	//$('')
	//$('#album_area').load('');
	
}
</script>

<style>
#album_area{
	width:800px;
	height:auto;
}
.album_all_div{
	width:200px;
	height:200px;
	border:thin solid #000;
	
	float:left;
	margin:20px;
	margin-bottom:40px;
	
}
#album_div{
	
}
#album{
	width:800px;
	
	border:thin solid #000;
	border-radius:10px;
	

}
#video_include{
	width:500px;
	height:300px;
	border:thin solid #000;
	border-radius:10px;
	display:none;
}
#audio_include{
	width:500px;
	height:300px;
	border:thin solid #000;
	border-radius:10px;
	display:none;

}
#photo_include {
	width:200px;
	
	border:thin solid #000;
	border-radius:10px;

}
#pic_area{
	position:absolute;
	
}
#albumdiv_all{
	width:800px;
	border:thin solid #000;
	position:absolute;
	background:#CCC;
	
}
</style>

</head>

<body>
<div id="albumdiv_all">
<div id="album">
<?php if($u == $log_username) { ?>
<div id="upper"><button id="btn_vd" onclick="video()">Upload Video</button>
<button id="btn_albm" onclick="album()">Create Album</button><button id="btn_albm" onclick="audio()">Upload Audio</button></div>
<?php } ?>
<div id="video_include"><?php //include ('upload.php');?></div>
<div id="audio_include"></div><hr />
<div id="album_area"><?php echo $album_html;?></div>
<div id="albumphoto_area"><?php //echo $album_html;?></div>

</div>
</div>
</body>
</html>