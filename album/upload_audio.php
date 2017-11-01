<!DOCTYPE html>
<html>
<head>
<script>

// JavaScript Document
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file").files[0];
	var formdata = new FormData();
	formdata.append("file", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "photo_parser_audio.php");
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

/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
</script>
<style>
</style>
</head>
<body>
<div id="video_main">
<div id="video_upper">Upload video</div>
<hr noshade/>
<div id="video_middle">
<form id="upload_form" enctype="multipart/form-data" method="post">
  <input type="file" name="file" id="file"><br>
  
  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
  <h3 id="status"></h3>
  <p id="loaded_n_total"></p>
</form></div>
<hr noshade/>
<div id="video_lower"><input type="button" id="b1" value="Upload File" onclick="uploadFile()"><center><input type="button" id="b2" value="Cancel" onclick="cancel()"></center></div>
</div>
</body>
</html>
