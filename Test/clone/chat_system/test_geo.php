<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!doctype html>
<html><head>
<meta http-equiv="Cache-Control" content="no-store" />


<link href="chat.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="chat.js" ></script>

<script type="text/javascript" src="jquery1.min.js"></script>
<script type="text/javascript" src="../../JavaScript/ajax.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#chat_user').load('dest.php').fadeIn("slow");

},1000); // refresh every 10000 milliseconds
//setInterval(chat(),10000);
function fun(f,u){
	
	//document.getElementById("chat_div").style.display = block;
	$('#chat_div').load('chat_box.php?f='+f+'&u='+u,function(responseText,statusTxt,xhr){
		if(statusTxt=="success"){
        //alert("External content loaded successfully!");
		init();}
      if(statusTxt=="error")
        alert("Error: "+xhr.status+": "+xhr.statusText);
    });
  }
		
	
	//alert(""+f+","+u);
     
	 //fuck();
	
function fuck(){
	
	alert("fuck");
	
}
</script>

<style>
body {
margin:0px;
padding:0px;	
}
#chat_wrap:hover {
	background: red;
}

#load_tweets{
  position:absolute;
	width: 200px;
	margin: 160px 0px 5px 0px;
	background: #F5F5F5;
	height: 500px;
	
	border-radius: 10px;
	box-shadow: 1px 1px 3px #AAA;	
}
#header_chat{

	height:30px;
	background-color:blue;
	margin-bottom:7px;
	font-family: Arial, Helvetica, sans-serif;
    padding:10px 0px 0px 5px;
    
}
#chat_user{
	height:420px;
	overflow-y : auto;
	overflow-x : hidden;
	background:green;
	
   
}
input {display:block ;
height:2em;

font-size:15px ;
}
#srch {
    width:195px;
    }
#chat_div {
	float:right;
}

</style>
</head>
<body>

<div id="load_tweets"><div id="header_chat">chat</div><div id="chat_user"></div><div id="search_user"><input type="text" id="srch" placeholder="search"/></div></div>


  <div id="chat_div"></div>
   
</body>
</html>