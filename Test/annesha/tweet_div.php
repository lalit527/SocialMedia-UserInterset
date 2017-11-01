<?php

$status_ui = "";
	$status_ui = '<div id="post_twt_div">';
	$status_ui .= '<p>Compose new Post</p>';
	$status_ui .= '<span id="status_span" style="float:right;"></span>';
	$status_ui .= '<textarea id="text_post" rows="7"
	 cols="65" onkeyup="statusMax(this,250)" onfocus="showTwtDiv()" placeholder="What new about you '.$log_username.'?"></textarea>';
	 $status_ui .= '<div id="postbutton_div" style="display:none;">';
	$status_ui .= '<button id="post" 
	onclick="goS(\'status_post\',\'a\',\''.$u.'\',\'text_post\'
);">Post</button>';
	$status_ui .= '<p>fffffff</p>';
	$status_ui .= '</div></div>';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function showTwtDiv(){
	document.getElementById('postbutton_div').style.display = 'block';
	document.getElementById('post_twt_div').style.height = '240';
}
</script>
<style>
#post_twt_div{
	width:555px;
	height:180px;
	z-index:100;
	background:#999;
	border:thin solid #06C;
	padding-left:10px;
    
	border-radius:5px;
	border-top-left-radius:0;
	border-top-right-radius:0;
}
textarea#statustext{width:500px; padding:8px; border:#999 1px solid; font-size:16px;}
#post {
  background: #039;
  float:right;
  margin-right:10px;
  border: 1px solid;
  border-radius: 4px;
  width:60px;
  height:40px;	
}

#statusBtn {
   width:70px;
   height:50px;
   font-family: Arial, Helvetica, sans-serif;
   font-weight:200px;
   float:right;	
}

</style>
</head>

<body>
<div id="twt_div">
<?php echo $status_ui; ?>

</div>
</body>
</html>