<?php
include_once("Connection/check_logged_user.php");
include_once("Connection/connect.php");
$album_photo = '';
if(isset($log_username)){
$sql = "SELECT album from albums WHERE username='".$log_username."' ORDER BY date DESC";
$query = mysqli_query($con,$sql);
$num_rows = mysqli_num_rows($query);
$album_name = array();
while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
	$album = $row['album'];
	
	$album_photo .= '<div id="album_photo"><div id="album_pic"></div><div id="album_inner">'.$album.'</div></div>';
	//array_push($album_name,$album);
}
/*foreach(){
	
}*/

}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Upload photos</title>
<script src="JavaScript/jquery-uploads.js"></script>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="CSS/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="CSS/bootstrap-theme.min.css">
<script type="text/javascript" src="JavaScript/bootstrap.min.js"></script>
  <style>
  #upload_images_div{
	width:90%;
	height:700px;
	border:thin solid #CCC;
	background-color:#09C;
	margin-left:20px;
	padding:0px;
	position:absolute;
	display:none;
  }
  #upload_images_upper{
	height:100px;
	padding:10px;
	}
  #uploaded_images{
	height:420px;
	overflow-y : auto;
	overflow-x : hidden;
	  
  }
  #upload_images_lower{
	height:200px;
	
  }
  #uploaded_images {width: 800px;margin: 0 auto}
  #uploaded_images div{float:left;padding-left: 10px;}
  .hide{display:none}
  </style>
<style>
#albm_name{
	  	
}
#albm_photo{
     height:200px;
	 weight:200px;
	 background:#009;	
}

#photo_mdl {
     margin-bottom:10px;	
}
#album_photo {
      height:250px;
	  width:200px;
	  margin:05px;
	  background-color:#33C;
	  float:left;	
	  border: thin solid #000;
	  position:relative;
}
#album_inner {
     
 width:200px;
	 height:50px;
	 background-color:#CCC;
	 }
#album_pic {
	width:200px;
	 height:200px;
	 background-color:#000;

}
#video_main{
	width:350px;
	height:300px;
	padding:10px;
	border:thin solid #999;
	border-radius:10px;
	background-color:#CCC;
	margin:auto;
	z-index:1;
	position:absolute;
	left:30%;
	top:30%;
	}
#image_upload_demo{
	width:95%;
	height:100%;
	padding:10px;
	border:thin solid #999;
	border-radius:10px;
	background-color:#CCC;
	margin:0px;
	z-index:1;
	position:absolute;
	left:02%;
	display:none;
	
	
}
#video_upper{
	height:20px;
}
#video_middle{
	height:150px;
}
#video_lower{
     height:inherit;	
}
#b1{
	background-color:#00F;
	float:right;
}

#photo_top {
	width:100%;
	z-index:0;
}
</style>
<script type="text/javascript" src="JavaScript/script.js"></script>
<script type="text/javascript" src="JavaScript/ajax.js"></script>
<script type="text/javascript" src="JavaScript/jquery1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script type="text/javascript">
// JavaScript Document
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file1").files[0];
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}

function video(){
	$('#photo_top').fadeTo("fast",0.15);
   $('#video_upload').load('MulUpload/upload.html',function(responseText,statusTxt,xhr){
	   if(statusTxt=="success"){
        //alert("External content loaded successfully!");
		
		
		}
      if(statusTxt=="error"){
		$('#photo_top').fadeIn();
		$('#photo_top').fadeTo("fast",1);  
        alert("Error: "+xhr.status+": "+xhr.statusText);
	  }
    }).fadeIn("slow");
   
 }
function cancel(){
	$('#video_upload').fadeOut();
		$('#photo_top').fadeIn();
		$('#photo_top').fadeTo("fast",1);
		
}

function create(){
     /*var name = _('albm_name').value;
	 var ajax = ajaxObj("POST","Parser/photo_album.php");
	 ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true){
			var response = ajax.responseText;
			var datArray = response.split('|');
			if(datArray[0].replace(/^\s+|\s+$/g, "") == 'created_ok'){
				//_('album_div').innerHTML += datArray[1];
				$('#album_div').prepend(datArray[1]);
}
		}
	 }
	 ajax.send("name="+name);*/
	 
	 /*jQuery('#photo_top').fadeTo("fast",0.15);
	 
   jQuery('#image_upload_demo').fadeIn("slow");*/
   window.location = 'imageupload/uploads_image.php';

}
  </script>
 
<script type="text/javascript" src="//..///JavaScript/upload_file.js">
</script>
<script>
</script>
</head>

<body>
<div id="image_upload_demo"><div id="upload_form" class="hide">
 <form action="multi_files.php" target="hidden_iframe" enctype="multipart/form-data" method="post">
 <input type="file" multiple name="upload_files[]" id="upload_files">
 <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
 <h3 id="status"></h3>
 </form>
 </div>

<div  align="center" style="padding:10px"> 
 <button onclick="Uploader.upload();" class="btn btn-primary btn-lg" id="btn2">Upload Files</button>
 <div id="wait" class="hide"><img src="upload-indicator.gif" alt=""></div>
</div>

<div>
<iframe name="hidden_iframe" id="hidden_iframe" class="hide"></iframe>
</div>
<div id="upload_images_div">
<div id="upload_images_upper"><p><input type="text" value="" placeholder="Untitled Album" size="55"></p><br /><p><input type="text" value="" placeholder="Say something about this album" size="55" width="120"><input type="text" placeholder="Where was this taken" size="40" style="float:right;"></p></div><hr noshade/>
<div id="uploaded_images" align="center"></div>
<hr noshade/>
<div id="upload_images_lower"><p><button id="btn_more" onclick="Uploader.upload();"  style="width:150px;height:50px;">Add more photos</button> <button id="btn_post" style="float:right;width:150px;height:50px;">Post</button></p></div>
</div>
</div>
<?php //include_once('imageupload/uploads_image.php');?></div>
<div id="main_upload">

<div id="photo_top">
<input type="text" id="albm_name" onBlur="gg()">

<button type="button" id="btn_srch" onClick="video()">Upload Video</button>
<button type="button" id="btn_crt" onClick="create()">Create Album</button>

<hr />
<div id="photo_mdl">
<b>Album</b><br />
<center><div id="album_div"><?php echo $album_photo; ?></div></center>
</div>  
</div>
<div id="video_upload"></div>

</div>
</body>
</html>