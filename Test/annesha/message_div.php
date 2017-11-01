<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
#message_div {
	position: absolute;
    top:98%;
	right:20%;
    width:500px;
   height:500px;
   background-color:#FFF;
   border:thin solid #06F;
   border-radius:10px;	
   display:none;
}
#message_div_upper {
	height:40px;
	background-color:#CCC;
	border-radius:10px 10px 0px 0px;
	color:#333;
	font:bold;
	padding-left:10px;
	padding-top:10px;
	padding-right:10px;
	font-size:1.5em;
}
#message_user {
	height:400px;
	background-color:#9F0;
	overflow-y : auto;
	overflow-x : hidden;

	
}
#message_middle {
	height:400px;
	background-color:#000;
	overflow-y : auto;
	overflow-x : hidden;
display:none;
}
#message_down {
	height:50px;
	background-color:#CCC;
	border-radius:0px 0px 10px 10px;
	
}
#closeaaaaaaaaa {
	
}
#include_close{
	
	
}
#button_new{
	height:30px;
	width:90px;
	margin-left:170px;
	
}
#middle_top {
	height:40px;
	background-color:#666;
	border:thin solid #333;
	padding:10px;
}
#text1{
	height:30px;
	width:480px;
}
#middle_area{
	height:300px;
	background-color:#069;
	display:none;
	overflow:hidden;
}
#text_area {
	height:80px;
	background-color:#3FF;
	padding:10px;
    z-index:1;	
	display:none;
}
#btn2 {
	height:40px;
	width:100px;
	float:left;
	margin-top:5px;
	margin-left:10px;
	display:none;
}
#btn3 {
	height:40px;
	width:120px;
	float:right;
	margin-top:5px;
	margin-right:10px;
	display:none;
}
#prvtmsg {
	text-decoration:none;
	
	
}
#middle_area_result{
	
	height:300px;
	background-color:#999;
	overflow-y: scroll;
overflow-x: hidden;
	
}
#message_wrap {
	border:thin solid #000;
	margin:0px;
	padding:5px;
	background-color:#CC9;
}
#message_wrap:hover {
	
	background-color:#066;
	
	
}

</style>

</script>

<script>
function closevvv() {
	$("#message_div").fadeOut("slow");
	$("#main").fadeTo("slow",1);
}
function newMessage(){
	document.getElementById('message_user').style.display = 'none';
	document.getElementById('message_middle').style.display = 'block';
	document.getElementById('btn3').style.display = 'block';
	document.getElementById('btn2').style.display = 'block';
    document.getElementById('text_area').style.display = 'block';
	document.getElementById('middle_area').style.display = 'block';
    document.getElementById('text1').style.display = 'block';
	//document.getElementById('btn2').style.display = 'block';



}
function hidemsg(){
	document.getElementById('message_middle').style.display = 'none';
	document.getElementById('btn3').style.display = 'none';
	document.getElementById('btn2').style.display = 'none';
    document.getElementById('text_area').style.display = 'none';
	document.getElementById('middle_area').style.display = 'none';
    document.getElementById('text1').style.display = 'none';
	//document.getElementById('btn2').style.display = 'block';

	document.getElementById('message_user').style.display = 'block';
}
function sendmsg(){
	alert("");
	}
</script>
<script>
// JavaScript Document
/*var chatURL = "../chat_test/chat.php";
//var getColorURL = "get_color.php";
var xmlHttpGetMessages = createXmlHttpRequestObject();
//var xmlHttpGetColor = createXmlHttpRequestObject();
var updateInterval = 1000;
var debugMode = true;
var cache = new Array();
var lastMessageID = -1;
var mouseX,mousey;

function createXmlHttpRequestObject()
{
// will store the reference to the XMLHttpRequest object
var xmlHttp;
// this should work for all browsers except IE6 and older
try
{
// try to create XMLHttpRequest object
xmlHttp = new XMLHttpRequest();
}
catch(e)
{
// assume IE6 or older
var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
"MSXML2.XMLHTTP.5.0",
"MSXML2.XMLHTTP.4.0",
"MSXML2.XMLHTTP.3.0",
"MSXML2.XMLHTTP",
"Microsoft.XMLHTTP");
// try every prog id until one works
for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++)
{
try
{
// try to create XMLHttpRequest object
xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
}
catch (e) {}
}
}
// return the created object or display an error message
if (!xmlHttp)
alert("Error creating the XMLHttpRequest object.");
else
return xmlHttp;
}


function init()
{ 


// get a reference to the text box where the user writes new messages
var oMessageBox = document.getElementById("message_box");
// prevents the autofill function from starting
oMessageBox.setAttribute("autocomplete", "off");
// references the "Text will look like this" message
var oUser=document.getElementById("name").value;
var friend = document.getElementById("text1").value;

// initiates updating the chat window
requestNewMessages();
}*/

function sendMessage()
{
	
// save the message to a local variable and clear the text box
var oUser=_("name").value;
var friend = document.getElementById("text1").value;
     
var oCurrentMessage = document.getElementById("message_box").value;
      
// don't send void messages
/*if (trim(oCurrentMessage) != "" && trim(oUser) != "" && trim(friend) != "")
{   
    alert(""+oUser+friend+oCurrentMessage);
*/

//_("btn3").disabled = true;
	var ajax = ajaxObj("POST", "message_system/message_system.php");
	//alert("if"+oUser+friend+oCurrentMessage);
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "pm_sent"){
				//alert("Message has been sent.");
				_('middle_top').style.display = 'none';
		readMessage();
			} else {
				//alert(ajax.responseText);
			}
		}
	}
	
	ajax.send("action=new_message&user="+oUser+"&fuser="+friend+"&data="+oCurrentMessage);
}

function readMessage(){
	var oUser=_("name").value;
    var friend = document.getElementById("text1").value;
    var ajax = ajaxObj("POST", "message_system/message_system.php");
	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			//alert(""+ajax.responseText);
			if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "pm_sent"){
				document.getElementById('message_user').style.display = 'none';
				_('middle_top').style.display = 'none';
				_('middle_area_result').innerHTML = ajax.responseText;
			} else {
				_('middle_area_result').innerHTML = ajax.responseText;
				//alert(ajax.responseText);
			}
		}
	}
	
	ajax.send("action=get_message&user="+oUser+"&fuser="+friend);

	
}
function getIt(f,u){
	
	document.getElementById("text1").value = f;
	document.getElementById("name").value = u;
	//alert("hello"+f+u);
	//readMessage();
	var ajax = ajaxObj("POST", "message_system/message_system.php");
	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			//alert(""+ajax.responseText);
			if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "pm_sent"){
				//document.getElementById('message_user').style.display = 'none';
	//document.getElementById('message_middle').style.display = 'block';
	newMessage();
	_('middle_top').style.display = 'none';
				_('middle_area_result').innerHTML = ajax.responseText;
			} else {
				//document.getElementById('message_user').style.display = 'none';
	//document.getElementById('message_middle').style.display = 'block';
	//document.getElementById('text_area').style.display = 'block';
	_('middle_area_result').innerHTML = ajax.responseText;
	newMessage();
	_('middle_top').style.display = 'none';

				
				//alert(ajax.responseText);
			}
		}
	}
	
	ajax.send("action=get_message&user="+u+"&fuser="+f);
	
}


readAll();
 function readAll(){
	//alert("helloinit");
	
	var ajax = ajaxObj("POST", "message_system/message_system.php");
	//alert("hello");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			//alert(""+ajax.responseText);
			var response = ajax.responseText;
			var datArray = response.split('|');
			
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "hello"){
				
				
				_('message_user').innerHTML = datArray[1];
			} else {
				_('message_user').innerHTML = ajax.responseText;
				//alert(ajax.responseText);
			}
		}
	}
	
	ajax.send("action=readall");


}
function showDel(x){
	//alert(""+x);
	$("#"+x).show();
	//document.getElementById('').style.display = 'block';
	
}
function hideDel(x){
	//alert(""+x);
	$("#"+x).hide();
	//document.getElementById('').style.display = 'block';
	
}

function deleteMsg(){
	
	
}
</script>
<link href="../../chat_system/chat.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="message_div">
<div id="message_div_upper"><a href="#" onclick="return false;" onMouseDown="hidemsg()" id="prvtmsg">Private Message</a><button id="button_new" onclick="newMessage() ">Create New</button><a href="#" id="close" onClick="return false;" onmousedown="closevvv()" style="float:right;
	text-decoration:none;">X</a></div>
<div id="message_user">dddddddddddddd</div>    
<div id="message_middle">
<div id="middle_area">

<div id="middle_top"><input type="text" id="text1" placeholder="Enter name of the user" value=""><input type="text" id="name" value="<?php echo $log_username; ?>">
</div><div id="middle_area_result">
</div></div>
<div id="text_area"><textarea cols="57" rows="4" id="message_box"></textarea>
</div>
</div>
<div id="message_down">
<div id="show_option">
<button id="btn2">Add Images</button>
<button id="btn3" onClick="sendMessage()">Send Message</button>
</div>
</div></div>

</div>
</body>
</html>