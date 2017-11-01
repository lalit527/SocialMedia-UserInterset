// JavaScript Document
function friendToggle(type,user,elem) {
	var conf = Confirm.render("Press OK to confirm the '"+type+"' action for user '"+user+"'",type,user);
	
	
	/*if(conf == true){
		
	
	alert(""+conf);
	
	
    var ajax = ajaxObj("POST","../Parser/friend_system.php");	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true){
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "friend_request_sent"){
				_(elem).innerHTML = '<button >OK Friend Request Sent</button>';
			} else if(response == "unfriend_ok"){
				_(elem).innerHTML = '<button onclick="friendToggle(\'friend\',\'<?php echo $u; ?>\',\'friendBtn\')">Request As Friend</button>';
			} else {
				alert(ajax.responseText);
				_(elem).innerHTML = response;
			}
		}
	}
	ajax.send("type="+type+"&user="+user);
}*/
}
function sendRequest(type,user){
            document.getElementById('friendBtn').innerHTML = 'please wait..';
  var ajax = ajaxObj("POST","Parser/friend_system.php");
  	
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true){
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "friend_request_sent"){
				document.getElementById('friendBtn').innerHTML = '<button >OK Friend Request Sent</button>';
			} else if(response == "unfriend_ok"){
				document.getElementById('friendBtn').innerHTML = '<button onclick="friendToggle(\'friend\',\'<?php echo $u; ?>\',\'friendBtn\')">Request As Friend</button>';
			} else {
				alert(ajax.responseText);
				document.getElementById('friendBtn').innerHTML = response;
			}
		}
	}
	ajax.send("type="+type+"&user="+user);
	
}

function blockToggle(type,user,elem){
	
	var conf = Confirm.render("Press OK to confirm the '"+type+"' action for user '"+user+"'",type,user);
	
	/*if(conf != true){
		return false;
	}
	_('elem').innerHTML = 'please wait...';
	var ajax = ajaxObj("POST","../Parser/block_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
		if(ajax.responseText == "blocked_ok"){
				elem.innerHTML = '<button onclick="blockToggle(\'unblock\',\'<?php echo $u; ?>\',\'blockBtn\')">Unblock User</button>';
			} else if(ajax.responseText == "unblocked_ok"){
				elem.innerHTML = '<button onclick="blockToggle(\'block\',\'<?php echo $u; ?>\',\'blockBtn\')">Block User</button>';
			} else {
				alert(ajax.responseText);
				elem.innerHTML = 'Try again later';
			}
		}
	}
	ajax.send("type="+type+"&blockee="+blockee);*/
}
function blockRequests(type,user){
	document.getElementById('blockBtn').innerHTML = 'please wait..';
	var ajax = ajaxObj("POST","Parser/block_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
		if(response == "blocked_ok"){
				document.getElementById('blockBtn').innerHTML = '<button onclick="blockToggle(\'unblock\',\''+user+'\',\'blockBtn\')">Unblock User</button>';
			} else if(response == "unblock_ok"){
				document.getElementById('blockBtn').innerHTML = '<button onclick="blockToggle(\'block\',\''+user+'\',\'blockBtn\')">Block User</button>';
			window.reload = true;
			} else {
				alert(ajax.responseText);
				document.getElementById('blockBtn').innerHTML = response;
			}
		}
	}
	ajax.send("type="+type+"&blockee="+user);

}

function showOption(x) {
  
   var x = _(x);
	if(x.style.display == 'block'){
		x.style.display = 'none';
	}else{
		x.style.display = 'block';
	}
}
	

function replyToStatus(sid,user,ta,btn){
	var data = _(ta).value;
	if(data == ""){
		var alrt = Alert.render("Reply cannot be empty");
		return false;
	}
	_("replyBtn_"+sid).disabled = true;
	var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true){
			var datArray = ajax.responseText.split("|");
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "reply_ok"){
				var rid = datArray[1];
				data = data.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />").replace(/\r/g,"<br />");
				_("status_"+sid).innerHTML += '<div id="reply_'+rid+'" class="reply_boxes"><div><b>Reply by you just now:</b><span id="srdb_'+rid+'"><a href="#" onclick="return false;" onmousedown="deleteReply(\''+rid+'\',\'reply_'+rid+'\');" title="DELETE THIS COMMENT">remove</a></span><br />'+data+'</div></div>';
				_("replyBtn_"+sid).disabled = false;
				_(ta).value = "";
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=status_reply&sid="+sid+"&user="+user+"&data="+data);
}
function deleteStatus(statusid,statusbox){
	var conf = Confirm.render("Press OK to confirm deletion of this status and its replies","delete_status",statusid);
}
function deleteReply(replyid,replybox){
	var conf = Confirm.render("Press OK to confirm deletion of this reply","reply_delete",replyid);
	/*if(conf != true){
		return false;
	}
	var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "delete_ok"){
				_(replybox).style.display = 'none';
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=delete_reply&replyid="+replyid);*/
}
function statusMax(field, maxlimit) {
	if (field.value.length > maxlimit){
		alert(maxlimit+" maximum character limit reached");
		field.value = field.value.substring(0, maxlimit);
	}
}
function deleteStatusAjax(statusid){
	   var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "delete_ok"){
				_("status_"+statusid).style.display = 'none';
				_("replytext_"+statusid).style.display = 'none';
				_("replyBtn_"+statusid).style.display = 'none';
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=delete_status&statusid="+statusid);

}
function deleteReplyAjax(id){
	var ajax = ajaxObj("POST", "Parser/post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			if(response == "delete_ok"){
				_("reply_"+id).style.display = 'none';
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=delete_reply&replyid="+id);
}
function goS(){
alert("");	
}