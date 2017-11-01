<?php
include_once("connection/connect.php");
include_once("connection/check_logged_user.php");
$thisPage = basename($_SERVER['PHP_SELF']);
$thisGroup = "";
$agList = "";
$mgList = "";
$_SESSION['group'] = "notSet";
if($thisPage == "group.php"){
	if(isset($_GET['g'])){
        $thisGroup = preg_replace('#[^0-9a-z_]#i','',$_GET['g']);
		$_SESSION['group'] = $thisGroup;		
	}
}
if(isset($_SESSION['username'])){
	$sql = "SELECT name,logo FROM groups";
	$query = mysqli_query($con,$sql);
	$g_check = mysqli_num_rows($query);
	if($g_check > 0){
		while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
              $agList .= '<a href="group.php?g='.$row["name"].'"><img src="groups/'.$row["name"].'/'.$row["logo"].'" alt="'.$row["name"].'" title="'.$row["name"].'" width="50" height="50" border="0" /></a>';			
		}
     }
//my group list
$sql = "SELECT gm.gname,gp.logo FROM gmembers AS gm LEFT JOIN groups AS gp ON gp.name=gm.gname WHERE gm.mname = '$log_username'";
$query = mysqli_query($con,$sql);
$g_check = mysqli_num_rows($query);
if($g_check > 0){
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
              $mgList .= '<a href="group.php?g='.$row["gname"].'"><img src="groups/'.$row["gname"].'/'.$row["logo"].'" alt="'.$row["gname"].'" title="'.$row["gname"].'" width="50" height="50" border="0" /></a>';			
		}

}
	 
}
$envelope = '<img src="Images/notes_dead.jpg" width="22" height="12" alt="Notes" title="This envelope is for  you">';
$loginLink = '<a href="login.php">';
?>
<div id="pageTop">
<div id="pageTopWrap">
<div id="pageTopLogo">

</div>
<div id="pageTopReset">
<div id="menu1">
<div>
<?php //echo $envelope; ?> &nbsp; &nbsp; <?php //echo $loginLink ?>
</div>
</div>
<div id="menu2">
<div>
<?php /*if(isset($_SESSION['username'])) { ?>
    <a href="#"><img src="Images/group.png" alt="group" tilte="Group" border="0"  onclick="return false" onmousedown="showGroups()"/></a>
<?php } */?>
</div>
</div>
</div>
</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

<script src="JavaScript/script.js"></script>
<script src="JavaScript/ajax.js"></script>
<style>
#groupList {
	
}
#groupWrapper {
	border:thin solid #039;
	border-radius:5px;
	width:600px;

}
#groupForm {
	padding:10px;
	text-align:center;
	display:none;
}
#groupModule {
	position:absolute;
	top:20%;
	left:20%;
	z-index:1000;
	background-color:#333;
}
</style>
<script type="text/javascript">
function openCreate(){
	$('#groupForm').slideToggle();
	
}
var isShowing = "no";
function showGroups(){
	
	if(isShowing == "no"){
		//$('#main').fadeTo("slow",0.15);
		_('groupModule').innerHTML = '<div id="groupWrapper"><div id="groupList"><h2>My Groups</h2><hr /><?php echo $mgList; ?><h2>All Groups</h2><hr /><?php echo $agList; ?></div><a href="#" onclick="return false;" onmousedown="openCreate()"><h2>Create New Group</h2></a><div id="groupForm"><hr /><p>Group Name:<br /><input type="text" id="gname" onBlur="checkGname()"><span id="gnameStatus"></span></p><p>How do people Joinyour group?<br /><select name="invite" id="invite"><option value="null" selected>&nbsp;</option><option value="1">By requesting to join</option><option value="2">By simply joining</option></select></p><button id="newGroupBtn" onclick="createGroup()">Create Group</button><span id="status"></span></div></div><div class="clear"></div>';
		
		isShowing = "yes";
	} else {
		
	     _('groupModule').innerHTML = '';
		 isShowing = "no";	
	}
}
function checkGname(){
	var u = _("gname").value;
	var rx = new RegExp;
	rx = /[^a-z 0-9_]/gi;
	u = u.replace(rx,"");
	var rxx = new RegExp;
	rxx = /[ ]/g;
	u = u.replace(rxx, "_");
	
	if(u != ""){
		_("gnameStatus").innerHTML = 'checking.......';
		var ajax = ajaxObj("POST","Parser/group_parser.php");
		ajax.onreadystatechange = function() {
		     if(ajaxReturn(ajax) == true){
				_('gnameStatus').innerHTML = ajax.responseText; 
			 }
		}
		ajax.send("gnamecheck="+u);
	}
}
function createGroup(){
	var name = _('gname').value;
	var inv = _('invite').value;
	if(name == "" || inv == ""){
		alert("fill up all fields");
		return false;
	} else {
		_('newGroupBtn').style.display = "none";
		_('status').innerHTML = 'please wait....';
		var ajax = ajaxObj("POST","Parser/group_parser.php");
		ajax.onreadystatechange = function() {
		      if(ajaxReturn(ajax) == true){
				var response = ajax.responseText;
				
				var datArray = response.split("|");
				if(datArray[0].replace(/^\s+|\s+$/g, "") == "group_created"){
					var sid = datArray[1];
					window.location = "group.php?g="+sid;
				} else {
					alert(response);
				}
			  }
		}
		ajax.send("action=new_group&name="+name+"&inv="+inv);
	}
	
}
</script>
<div id="groupModule">

</div>