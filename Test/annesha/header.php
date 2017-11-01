<?php
//include_once('../../Connection/check_logged_user.php');
//echo $log_username;
$dplink = "";
$pf_pic = "";
$hd_pic = "";
$sql = "SELECT dplink,firstname,lastname,username FROM users WHERE username='$log_username' LIMIT 1";
$query = mysqli_query($con,$sql);
$num = mysqli_num_rows($query);
$row = mysqli_fetch_row($query);
$dplink = $row[0];
$f_name = $row[1];
$l_name = $row[2];
//$dplin = $row[3];

$pf_pic = '<div id="stng_pic"><img src="Users/'.$log_username.'/'.$dplink.'"  id="dp_stng" height="40px" width="40px"><div id="name_stng">'.$f_name.' '.$l_name.'  @'.$log_username.'</div></div>';

$hd_pic = '<img src="Users/'.$log_username.'/'.$dplink.'"  id="meicon1" height="30px" width="30px" style="border-radius:10px;margin-right:0;float:left;position:absolute;top:30px;left:15px;z-index:10000">';


$bg_upload = '<div class="fileinputs">
        <input type="file" class="file" />

        <div class="fakefile">
            <input type="button" value="Select file" />
        </div>
    ';

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script>
function showtwt(){
	alert("hello");
	
}
function showMsg(){
	   
    $("#message_div").fadeIn();
	//_('main').disabled = true;
	$("#main").fadeTo("fast",0.1);
    //$("#div3").fadeTo("slow",0.7);
     //readAll();

	
}

$(document).mouseup(function (e)
{
    var container = $("#message_div");
    

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 && !$('#msgicon').is(e.target)) // ... nor a descendant of the container
    {  
	    
			
        
		closevvv();
		exit();
		
    }
});/*
$(document).ready(function(){
  $("#main").click(function(){
    if($("#message_div").is(":visible")){
		$("#message_div").fadeOut("slow");
	}
  });*/
 function showStng(){
    
	_('stng_div').style.display = 'block'; 
	 
 }
 /*$(document).mouseout(function (e)
{
    var container = $("#stng_div");
    

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 && !$('#settingsicon').is(e.target)) // ... nor a descendant of the container
    {  
	    
			
        //$('.search').val('');
		$('#stng_div').fadeOut("slow");
		exit();
		
    }
});*/

 function loadStng(){
 	//alert('hello');
    $('#pageContent').hide();
	document.getElementById('pageUpperInclude').style.marginTop = -20;

	  $('#settingsInclude').load("settings.php");
}
</script>
<script>
$(document).ready(function(){
$(".search").keyup(function() 
{
	
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;
if(searchbox=='')
{}
else
{
$.ajax({
type: "POST",
url: "Parser/searching.php",
data: dataString,
cache: false,
success: function(html)
{
	//_('display').style.display = 'block';
    $("#display").html(html).show();
}
});
}return false; 
});
});
$(document).mousedown(function (e)
{  
    var container = '';
   if(($('#display').show())){
    var container = $("#display");
	if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {  
	    
			
        $('.search').val('');
		container.fadeOut("slow");
		exit();
		
    }
       exit();
   }if(document.getElementById('stng_div').style.display == 'block'){
    var container = $("#stng_div");
	if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 && !$('#settingsicon').is(e.target)) // ... nor a descendant of the container
    {  
	    
		alert("hello");	
        //$('.search').val('');
		container.fadeOut("slow");
		exit();
		
    }
	
   }

     
    });

</script>

<style>
#display
{
width:350px;
display:none;
margin-right:30px;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
position:absolute;
z-index:100000;
background:#FFF;
top:62px;
left:30.5%;
overflow:hidden;
}
.display_box
{
padding:4px; 
border-top:solid 1px #dedede; 
font-size:12px; 

}
.display_box:hover
{
background:#3b5998;
color:#FFFFFF;
}

 div.fileinputs {
            position: relative;
        }

        div.fakefile {
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 1;
        }

        div.fakefile input[type=button] {
            /* enough width to completely overlap the real hidden file control */
            cursor: pointer;
            width: 148px;
        }

        div.fileinputs input.file {
            position: relative;
            text-align: right;
            -moz-opacity:0 ;
            filter:alpha(opacity: 0);
            opacity: 0;
            z-index: 2;
        }
#stng_div{
	width:150px;
	height:300px;
	background-color:#FFF;
	border:thin solid #999;
	display:none;
	position:absolute;
	z-index:3000;
}
#stnd_upr {
	height:50px;
	padding:10px;
	
}
#dp_stng{
	border-radius:5px;
}
#stng_page,#stng_hlp,#stng_stng,#stng_log {
	
	padding:10px;
	font-size:16px;
	color:#000;
	font-stretch:expanded;
}
#name_stng{
	display:inline;
	margin-left:7px;
	vertical-align:text-top;
	
	
	padding-top:10px;list-style:none;position:absolute;top:0;
}

#stng_page:hover {
	background-color:#036;
	
}
#stnd_upr:hover,#stng_hlp:hover,#stng_stng:hover {
	background-color:#036;
	
}
#stng_log:hover {
	background-color:#036;
	
}
#page_lnk,#hlp_lnk,#log_lnk,#stng_lnk{
	
	color:#000;
	text-decoration:none;
	
}
#stng_hlp {
	
	
}
#stng_div {
	position:absolute;
	top:75px;
	left:75%;
	
}

</style>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php //include_once('message_div.php'); ?>

 <div id="head">
<div>
            <div id="left">
              <ul>
                        <li> <a href="users.php?u=<?php echo $log_username; ?>">
                            <?php echo $hd_pic;?> <img src="Images/me.jpg" id="meicon" style="margin-right:0;float:left;"> </a>
                        </li>
                        <li>  <a href="home.php">                          
                             <img src="Images/home1.jpg" id="homeicon"> 
                             
                        </li>
                        <li> 
                           <a href="notifications.php">
                           <img src="Images/alert2.jpg" id="alerticon"> </a>
                        </li>
                        <li id="msg_link"> 
                           <a id="msg_link" href="#" onclick="return false;" onmousedown="showMsg()">
                           <img src="Images/msg.png" id="msgicon"> </a>
                        </li>
                        <li> 
                           <a href="friend_request.php">
                            <img src="Images/frnd.jpg" id="frndicon"> </a>
                        </li>
              </ul>
            </div>
  </div>
            <div id="search">
		
		        <input type="text" class="search" id="srch"  name="searching" size="30" maxlength="120" placeholder="Search for people by name or username">
                <div id="display">
</div>

                        <input type="submit" value="    >" id="srchicon">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="#" onclick="return false;" onmousedown="showStng()"  ><img src="Images/set1.png" id="settingsicon"></a>
                         &nbsp;&nbsp;&nbsp;&nbsp;                        
                            <a href="#" onclick="return false;" onmousedown="showtwt()"> <img src="Images/log1.png" id="logicon"> </a> 
                            
                        
                        
             
		</form>
                
		</div>
	
      
        
            
     </div>  
     <div id="stng_div">

<div id="stnd_upr">
<?php echo $pf_pic;?></div><hr />
<div id="stng_page"><a href="create_page.php" id="page_lnk">Create Page</a></div><hr />
<div id="stng_hlp"><a href="#" id="hlp_lnk">Help</a></div><hr />
<div id="stng_stng"><a href="#" onclick="return false;" onmousedown="loadStng()" id="stng_lnk">Settings</a></div><hr />
<div id="stng_log"><a href="logout.php" id="log_lnk">Log out</a></div>
</div>


</body>
</html>