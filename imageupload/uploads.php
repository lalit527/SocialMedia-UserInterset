<!DOCTYPE html>
<html>
 <head>
  <title>HTML5 Multiple file Ajax Upload</title>
  <script src="../../JavaScript/jquery-uploads.js"></script>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../../CSS/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="../../CSS/bootstrap-theme.min.css">
<script type="text/javascript" src="../../JavaScript/bootstrap.min.js"></script>
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
 </head>

 <body>
 <div id="upload_form" class="hide">
 <form action="multi_files.php" target="hidden_iframe" enctype="multipart/form-data" method="post">
 <input type="file" multiple name="upload_files[]" id="upload_files">
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
<div id="upload_images_upper"><p><input type="text" value="" placeholder="Untitled Album" size="55"></p><br /><p><input type="text" value="" placeholder="Say something about this album" size="55" width="120"></p><input type="text" placeholder="Where was this taken" size="40" style="float:right;"></div><hr noshade/>
<div id="uploaded_images" align="center">
</div>
<hr noshade/>
<div id="upload_images_lower"><p><button id="btn_more" value="Add more photos"></button></p> </div>
</div>
</div>
 <script type="text/javascript">

    var Uploader = (function () {

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

  </script>
 </body>
</html>
