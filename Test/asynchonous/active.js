// JavaScript Document
var xmlHttp = createXmlHttpRequestObject();
var serverAddress = "smartproxyping.php";
var getNumberParams = "action=GetNumber" + 
"&min=1" + 
"&max=100"; 
var checkAvailabilityParams = "action=CheckAvailability";
var requestsCounter = 0; 
var checkInterval = 10; 
var updateInterval = 1; 
var updateIntervalIfServerBusy = 10; 
var minServerBufferLevel = 50; 
function createXmlHttpRequestObject()
{
var xmlHttp;

try
{

xmlHttp = new XMLHttpRequest();
}
catch(e)
{

var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
"MSXML2.XMLHTTP.5.0",
"MSXML2.XMLHTTP.4.0",
"MSXML2.XMLHTTP.3.0",
"MSXML2.XMLHTTP",
"Microsoft.XMLHTTP");
for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++)
{
try
{
xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
}
catch (e) {}
}
}
if (!xmlHttp)
alert("Error creating the XMLHttpRequest object.");
else
return xmlHttp;
}

function process()
{
	
if (xmlHttp)
{
try
{
if (requestsCounter % checkInterval == 0)
{
xmlHttp.open("GET", serverAddress + "?" + checkAvailabilityParams, true);
xmlHttp.onreadystatechange = handleCheckingAvailability;
xmlHttp.send(null);
}
else
{
xmlHttp.open("GET", serverAddress + "?" + getNumberParams, true);
xmlHttp.onreadystatechange = handleGettingNumber;
xmlHttp.send(null);
}
}
catch(e)
{
alert("Can't connect to server:\n" + e.toString());
}
}
}
function handleCheckingAvailability()
{
if (xmlHttp.readyState == 4)
{if (xmlHttp.status == 200)
{
try
{
checkAvailability();
}
catch(e)
{
// display error message
alert("Error reading server availability:\n" + e.toString());
}
}
else
{
// display status message
alert("Error reading server availability:\n" + xmlHttp.statusText);
}
}
}
// handles the response received from the server
function checkAvailability()
{
// retrieve the server's response
var response = xmlHttp.responseText;
// if the response is long enough, or if it is void, we assume we just
// received a server-side error report
if(response.length > 5 || response.length == 0)
throw(response.length == 0 ? "Server error" : response);
// obtain a reference to the <div> element on the page
myDiv = document.getElementById("myDivElement");
// display the HTML output
if (response >= minServerBufferLevel)
{
// display new message to user
myDiv.innerHTML += "Server buffer level is at " + response + "%, "
+ "starting to retrieve new numbers. <br/>";
// increases counter to start retrieving new numbers
requestsCounter++;
// reinitiate sequence
setTimeout("process();", updateInterval * 1000);
}
else
{
// display new message to user
myDiv.innerHTML += "Server buffer is too low (" + response + "%), "
+ "will check again in " + updateIntervalIfServerBusy
+ " seconds. <br/>";
// reinitiate sequence
setTimeout("process();", updateIntervalIfServerBusy * 1000);
}
}
// function called when the state of the HTTP request changes
function handleGettingNumber()
{
// when readyState is 4, we are ready to read the server response
if (xmlHttp.readyState == 4)
{
// continue only if HTTP status is "OK"
if (xmlHttp.status == 200)
{
try
{
// do something with the response from the server
getNumber();
}
catch(e)
{
// display error message
alert("Error receiving new number:\n" + e.toString());
}
}
else
{
// display status message
alert("Error receiving new number:\n" + xmlHttp.statusText);
}
}
}
// handles the response received from the server
function getNumber()
{
// retrieve the server's response
var response = xmlHttp.responseText;
// if the response is long enough, or if it is void, we assume we just
// received a server-side error report
if(response.length > 5 || response.length == 0)
throw(response.length == 0 ? "Server error" : response);
// obtain a reference to the <div> element on the page
myDiv = document.getElementById("myDivElement");
// display the HTML output
myDiv.innerHTML += "New random number retrieved from server: "
+ response + "<br/>";
// increase requests count
requestsCounter++;
// reinitiate sequences
setTimeout("process();", updateInterval * 1000);
}