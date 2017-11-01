<?php
include_once('../Connection/check_logged_user.php');

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Upload Your image</title>
  <script src="../JavaScript/jquery-uploads.js"></script>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../CSS/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="../CSS/bootstrap-theme.min.css">
<script type="text/javascript" src="../JavaScript/bootstrap.min.js"></script>
<script type="text/javascript" src="../JavaScript/ajax.js"></script>
  <style>
  body{
	margin:0px;
	padding:0px;  
  }
  #upload_images_div{
	width:95%;
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
 </head>

 <body>
 <div id="upload_form" class="hide">
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
<div id="upload_images_upper"><p><input type="text" value="" placeholder="Untitled Album" id="albm" size="55"></p><br /><p><input type="text" value="" placeholder="Say something about this album" id="info" size="55" width="120"><input type="text" placeholder="Where was this taken" id="loc" size="40" style="float:right;"></p></div><hr noshade/>
<div id="uploaded_images" align="center"></div>
<hr noshade/>
<div id="upload_images_lower"><p><button id="btn_more" onclick="Uploader.upload();"  style="width:150px;height:50px;margin-left:10px;">&plusmn;&nbsp;Add more photos</button><button id="btn_post" style="float:right;width:150px;height:50px;margin-left:20px;" onClick="post()">Post</button><button  style="float:right;width:150px;height:50px;">Cancel</button><select id="type" style="float:right;width:150px;height:50px;">
  <option value="a">Public</option>
  <option value="b">Friends</option>
  <option value="c">Only me</option>
</select>
</p></div>
</div>
</div>
 <script type="text/javascript">
jQuery(function(){
	//alert("");
   jQuery('#btn2').trigger('click');
   //alert("");
});

    var Uploader = (function () {

        jQuery('#upload_files').on('change', function () {
            jQuery("#wait").removeClass('hide');
            jQuery('#upload_files').parent('form').submit();
        });

        var fnUpload = function () {
            jQuery('#upload_files').trigger('click');
			var xhr = jQuery.ajaxSettings.xhr();
			if (xhr.upload) {
        xhr.upload.addEventListener('progress', function (event) {
            var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
        }, false);
    }  
			        }
        //if ($('#mydiv').is(':empty')) {
        var fnDone = function (data) {

            var data = JSON.parse(data);
            if (typeof (data['error']) != "undefined") {
                jQuery('#uploaded_images').html(data['error']);
                jQuery('#upload_files').val("");
                jQuery("#wait").addClass('hide');
                return;
            }
            var divs = [];
            for (i in data) {
                divs.push("<div><img src='" + data[i] + "' style='height:300px;width:200px;' class='img-thumbnail' \></div>");
            }
			if ($('#uploaded_images').html().trim()) {
				 jQuery(divs.join("")).appendTo('#uploaded_images');
            jQuery('#upload_files').val("");
            jQuery("#wait").addClass('hide');

				 exit();
			}

			jQuery('#btn2').fadeOut("fast");
			jQuery('#upload_images_div').fadeIn("fast");
            jQuery('#uploaded_images').html(divs.join(""));
            jQuery('#upload_files').val("");
            jQuery("#wait").addClass('hide');
        
		}
	       
        return {
            upload: fnUpload,
            done: fnDone
        }

    }());

			   //Uploader1.upload();
/*var Uploader1 = (function () {
        jQuery('#upload_files').on('change', function () {
            jQuery("#wait").removeClass('hide');
            jQuery('#upload_files').parent('form').submit();
        });

        var fnUpload = function () {
            jQuery('#upload_files').trigger('click');
        }

        var fnDone = function (data) {

            var data = JSON.parse(data);
            if (typeof (data['error']) != "undefined") {
                jQuery('#uploaded_images').html(data['error']);
                jQuery('#upload_files').val("");
                jQuery("#wait").addClass('hide');
                return;
            }
            var divs = [];
            for (i in data) {
                divs.push("<div><img src='" + data[i] + "' style='height:300px;width:200px;' class='img-thumbnail' \></div>");
            }
           jQuery(divs.join("")).appendTo('#uploaded_images');
            jQuery('#upload_files').val("");
            jQuery("#wait").addClass('hide');
        }

        return {
            upload: fnUpload,
            done: fnDone
        }

    }());
*/
function post() {
	//alert("");
	var loc = document.getElementById('loc').value;
	var alb = document.getElementById('albm').value;
	var inf = document.getElementById('info').value;
	var typ = document.getElementById('type').value;
	var action = 'post';
	var ajax= ajaxObj("POST","multi_files.php");
		ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
		if(ajax.responseText.replace(/^\s+|\s+$/g, "") == 'done'){
			window.location = "../users.php?u=<?php echo $log_username;?>";
		}
	
		
		}
		}
		ajax.send("action="+action+"&loctn="+loc+"&albm="+alb+"&info="+inf+"&type="+typ);
}


  </script>
 </body>
</html>
