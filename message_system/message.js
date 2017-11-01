// JavaScript Document
var chatURL = "chat.php";
var getColorURL = "get_color.php";
var xmlHttpGetMessages = createXmlHttpRequestObject();
var xmlHttpGetColor = createXmlHttpRequestObject();
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
alert("");
// get a reference to the text box where the user writes new messages
var oMessageBox = document.getElementById("messageBox");
// prevents the autofill function from starting
oMessageBox.setAttribute("autocomplete", "off");
// references the "Text will look like this" message
var oSampleText = document.getElementById("sampleText");
// set the default color to black
oSampleText.style.color = "black";
// ensures our user has a default random name when the form loads
var oUser=document.getElementById("userName").value;

var all = oUser.split(',');

var u = all[0];
var f = all[1];

checkUsername();
// initiates updating the chat window
requestNewMessages();
}
