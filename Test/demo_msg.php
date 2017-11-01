<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
#msg_div {
	position:absolute;
	width: 300px;
	margin-right: 30%;
	margin-left: 30%;
	margin-top: 50px;
	background: #F5F5F5;
	height: 400px;
	border-radius: 10px;
	box-shadow: 1px 1px 3px #AAA;
}
#msg_contnt{
	height:300px;
	
    overflow-y: scroll;
}
#msg_hdr {
	
	height:30px;

}
textarea#msg_txt{width:283px; height:50px; padding:8px; border:#999 1px solid; font-size:16px;}

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script>
$(document).ready(function () {
alert("");
   var vhref = $(location).attr('href');

   var vTitle = $(this).attr('title');

   //$('#spnTitle').html('<b>' + vTitle + '</b>');

   //alert(vhref);
   $('#msg_hdr').html('<b>' + vhref + '</b>');

});​

</script>
</head>

<body>
<div id="msg_div">
<div id="msg_hdr">

</div>
<hr />
<div id="msg_contnt">
</div>
<form id="msg_form" action="msg_system.php" method="POST">
<textarea id="msg_txt" ></textarea>
</form>
</div>

</body>
</html>