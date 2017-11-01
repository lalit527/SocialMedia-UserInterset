<?php
$school = "";
$clg = "";
$wrk = "";
$skl = "";
$home = "";
$city = "";
$sql = "SELECT school,college,work,skills FROM work_edu WHERE username='$u' LIMIT 1";
$query = mysqli_query($con,$sql);
$num_row = mysqli_num_rows($query);
if($num_row > 0){
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$school = $row['school'];
		$clg = $row['college'];
		$wrk = $row['work'];
		$skl = $row['skills'];
	}
	
}
$sql = "SELECT home,current FROM places WHERE username='$u'";
$query = mysqli_query($con,$sql);
$num_row = mysqli_num_rows($query);
if($num_row > 0){
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$home = $row['home'];
		$city = $row['current'];
		
	}
	
}
$movie_pic = "";
$movie_html = "";
$sql_movies = "SELECT * FROM likes WHERE type='movies'";
$query_movies = mysqli_query($con,$sql_movies);
$num_row_movies = mysqli_num_rows($query_movies);
if($num_row_movies > 0){
	while($row = mysqli_fetch_array($query_movies,MYSQLI_ASSOC)){
		$id = $row['id'];
		$name = $row['name'];
		$name_id = $row['name_id'];
		$pic = $row['pic'];
		
		$movie_pic = 'likes/'.$name.'/'.$pic.'';
		$movie_html .= '<div id="movies_div" style="float:left;"><a href="#" onclick="return false" onmousedown="overDiv()"><img class="friendpics" src="'.$movie_pic.'" alt="'.$name.'" title="'.$name.'" style="height:220px;width:150px"></a><a href="like.php?id_get='.$name_id.'"><div id="movies_name" style="margin-left:20px;">'.$name.'</div></a></div>';
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
#main_about{
	width:80%;
	height:457px;
	border:thin solid #999;
	border-radius:5px;
	float:center;
	padding:3px;
	background-color:#FFF;
	margin-left:100px;
	
}
#main_left{
	width:50%;
	height:320px;
	border:thin solid #999;
	border-radius:2px;
	float:left;
	padding:3px;
	border-left:hidden;
	border-top:hidden;
	border-bottom:hidden;
	
	}
	a:active {
    color: gray;
	
}
#places
{margin-top:20px;
	margin-left:53%;

	} 
a {text-decoration: none}
	
	#see_all
	{ width:100%;
	height:50px;
	border:thin solid #999;
	border-radius:5px;
	float:center;
	background-color: #E5E5E5;
	
}
#movies_head,#serials_head,#music_head,#books_head,#sports_head
{
width:100%;
	height:50px;
	border:thin solid #999;
	border-radius:5px;
	float:center;
	
}
#movies_body,#serials_body,#music_body,#books_body,#sports_body
{
width:100%;
	height:250px;
	border:thin solid #999;
	border-radius:5px;
	float:center;
	overflow-x:hidden;
	overflow-y:auto;
}

</style>

<script>
function overDiv(){
	
}
function show_work() {
 document.getElementById('school_clg').style.display = 'none';
  document.getElementById('work_second').style.display = 'block';

document.getElementById('edit_img').style.display = 'none';
document.getElementById('work_edit').style.display = 'none';
}
function show_places() {
 document.getElementById('current').style.display = 'none';
  document.getElementById('current_second').style.display = 'block';
   document.getElementById('hometown_second').style.display = 'none';
  
}
function change_current() {
 document.getElementById('current').style.display = 'block';
  document.getElementById('current_second').style.display = 'none';
  document.getElementById('hometown').style.display = 'block';
  
}
function show_places_hmtwn() {
 document.getElementById('hometown').style.display = 'none';
  document.getElementById('hometown_second').style.display = 'block';
  document.getElementById('current').style.display = 'block';
   document.getElementById('current_second').style.display = 'none';
   
}
function change_hometown() {
 document.getElementById('hometown').style.display = 'block';
  document.getElementById('hometown_second').style.display = 'none';
  document.getElementById('hometown').style.display = 'block';
 
}

function show_birthday() {
 document.getElementById('birthday2').style.display = 'block';
  document.getElementById('birthday').style.display = 'none';
  document.getElementById('gender2').style.display = 'none';
  document.getElementById('lang2').style.display = 'none';
   document.getElementById('gender').style.display = 'block';

 
 
 
}
function change_birthday() {
 document.getElementById('birthday').style.display = 'block';
  document.getElementById('birthday2').style.display = 'none';
 document.getElementById('gender').style.display = 'block'; 
 
}
function show_gender() {
 document.getElementById('gender2').style.display = 'block';
  document.getElementById('gender').style.display = 'none';
  document.getElementById('birthday2').style.display = 'none';
  document.getElementById('lang2').style.display = 'none';
  document.getElementById('birthday').style.display = 'block';
   document.getElementById('lang').style.display = 'block';

 
}

function change_gender() {
 document.getElementById('birthday').style.display = 'block';
 document.getElementById('gender').style.display = 'block';
 document.getElementById('gender2').style.display = 'none';
 
  document.getElementById('birthday2').style.display = 'none';
 
}
function show_lang() {
 document.getElementById('lang2').style.display = 'block';
  document.getElementById('lang').style.display = 'none';
  document.getElementById('birthday2').style.display = 'none';
  document.getElementById('gender2').style.display = 'none';
  document.getElementById('birthday').style.display = 'block';

 document.getElementById('gender').style.display = 'block';
}

function change_lang() {
 document.getElementById('birthday').style.display = 'block';
 document.getElementById('gender').style.display = 'block';
 document.getElementById('gender2').style.display = 'none';
 document.getElementById('lang2').style.display = 'none';
 document.getElementById('birthday2').style.display = 'none';
 document.getElementById('lang').style.display = 'block';
 
}

function show_movies(){
 document.getElementById('movies_head').style.display = 'block';
 document.getElementById('movies_body').style.display = 'block';
document.getElementById('serials_head').style.display = 'block';
 document.getElementById('serials_body').style.display = 'block';
document.getElementById('music_head').style.display = 'block';
 document.getElementById('music_body').style.display = 'block';
document.getElementById('books_head').style.display = 'block';
 document.getElementById('books_body').style.display = 'block';
document.getElementById('sports_head').style.display = 'block';
 document.getElementById('sports_body').style.display = 'block';
}

function savework(){
	
	var wr = _('job').value;
	var cl = _('clg').value;
	var sc = _('school').value;
	var sk = _('skills').value;
	if(wr==""){
	
		
	}
	var ajax = ajaxObj("POST","tina123/about_parser.php");
	alert("123");
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			alert(""+ajax.responseText);
			if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "done"){
				_('work_second').style.display = 'none';
				_('school_clg').style.display = 'block';
				_('clg_span').innerHTML = cl;
				_('scl_span').innerHTML = sc;
				
			}
			
		}
	}
	ajax.send("action=savework&work="+wr+"&clg="+cl+"&scl="+sc+"&skl="+sk);
}

function savePlace(){
	
	var c = _('current_txt').value;
	var ajax = ajaxObj("POST","tina123/about_parser.php");
	alert("123"+c);
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			alert(""+ajax.responseText);
			if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "done"){
                 _('current_second').style.display = 'none';
				_('current').style.display = 'block';
				_('current_span').innerHTML = c;
				
			}
			
		}
	}
	ajax.send("action=current&city="+c);

}
function saveHome(){
	var h = _('hometown_txt').value;
	var ajax = ajaxObj("POST","tina123/about_parser.php");
	alert("123"+h);
	ajax.onreadystatechange = function(){
		if(ajaxReturn(ajax) == true){
			alert(""+ajax.responseText);
			if(ajax.responseText.replace(/^\s+|\s+$/g, "") == "done"){
				_('hometown_second').style.display = 'none';
				_('hometown').style.display = 'block';
				_('hometown_span').innerHTML = h;
				
				
			}
			
		}
	}
	ajax.send("action=home&home="+h);

}
</script>
</head>

<body>
<br /><br /><br /><br />
<div id="main_about" >

<img src="about.jpg"  align="left" >
<h2>About</h2>

<hr noshade/>
<div id="main_left" >

<div id="work_first">
<b>Work and Education &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
 if($u == $log_username && $user_ok == true){ ?>

<a href="#" onmousedown="show_work()"
	onclick="return false" id="work_edit">Edit</a> <img src="index.jpg"  align="right" id="edit_img"> <?php } ?>

</div> 
    
    <div id="work_second" style="display:none;"><form >
    <input type="button" id="btn_save" value="save changes" onclick="savework()" align="right">
    <br />
    <?php echo $wrk; ?><br />
    <input type="text" id="job" placeholder="Where did you work" size="35" value="<?php echo $wrk;?>"><br /><br />

     <input type="text" id="clg" placeholder="Where did you go for college" size="35" value="<?php echo $clg;?>">     
     
     <div id="clg1" style="margin-bottom:20px;">
    College  &nbsp;&nbsp;&nbsp;&nbsp;   <?php echo $clg; ?>
        </div><br />
     <input type="text" id="school" placeholder="Where did you go for schooling" size="35" value="<?php echo $school;?>">
    
     
     <div id="school1" style="margin-bottom:20px;">
    School &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $school; ?>
    </div>
    <br />
    <b>Proffesional Skills
     <input type="text" id="skills" placeholder="What skills do you have" size="35" value="<?php echo $skl; ?>">
    </form><hr /></div> 
    
    
    <div id="school_clg"><br />
    <div id="clg">
    College <span id="clg_span" style="margin-left:50px"><?php echo $clg;?></span>
    </div><br />
    
    
    <div id="school">
    School <span id="scl_span" style="margin-left:50px"><?php echo $school;?></span>
    </div>
    <br />
    
    </div>
    <hr />
</div>
<div id="places"> 
<b>Places Lived <br /><br />
<div id="current">
<span id="current_span"><?php echo $city;?></span>
<span id="crnt" style="color:blue; margin-left:85%; font-size:12px;">
<?php 
 if($u == $log_username && $user_ok == true){ ?>
<a href="#" onmousedown="show_places()" 
	onclick="return false">Edit </a> <?php }?></span>
</div><br />
<div id="current_second" style="display:none;color:">
<p>Current city:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" size="25" id="current_txt" value="<?php echo $city?>"></p><p><input type="button" id="btn_save" value="save changes" onclick="savePlace()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="cancel" onclick="change_current()"></p></form></center>
</div>

<div id="hometown">
<span id="hometown_span"><?php echo $home;?></span>
<span id="hmtwn" style="color:blue; margin-left:82%; font-size:12px;">
<?php 
 if($u == $log_username && $user_ok == true){ ?>

<a href="#" onmousedown="show_places_hmtwn()" 
	onclick="return false">Edit </a> <?php } ?></span>
</div><br />
<div id="hometown_second" style="display:none;">
<p>Homwtown:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" size="25" id="hometown_txt" value="<?php echo $home;?>"></p><p><input type="button" id="btn_save" value="save changes" onclick="saveHome()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="cancel" onclick="change_hometown()"></p></form></center>
</div>
<hr />
<div id="main_info">
<b>Your Main Information<br /><br />
<div id="birthday">Birthdate: hello
<span id="edit" style="font-size:12px; margin-left:72%;"><?php 
 if($u == $log_username && $user_ok == true){ ?>
 <a href="#" onmousedown="show_birthday()" 
	onclick="return false">Edit </a> <?php } ?></span></div>
    <span id="birthday2" style="display:none; "> Birthdate:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="bday">
    <p><input type="button" id="btn_save" value="save changes"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="cancel" onclick="change_birthday()"></p></span>
<br />
    
<div id="gender" >Gender: hello <span id="edit" style="font-size:12px; margin-left:74%;"><?php 
 if($u == $log_username && $user_ok == true){ ?>
 <a href="#" onmousedown="show_gender()" 
	onclick="return false">Edit </a> <?php } ?></span></div>
    <span id="gender2" style="display:none;">Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <select>
  <option value="Male">Male</option>
  <option value="Female">Female</option>
</select>
    <p><input type="button" id="btn_save" value="save changes"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="cancel" onclick="change_gender()"></p></span>

    <br />
   
<div id="lang">Language: hello <span id="edit" style="font-size:12px; margin-left:71%;"> <?php 
 if($u == $log_username && $user_ok == true){ ?>
<a href="#" onmousedown="show_lang()" 
	onclick="return false">Edit </a> <?php }?></span></div>
     <span id="lang2" style="display:none;"> Languages&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" size="20">
    <p><input type="button" id="btn_save" value="save changes"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="cancel" onclick="change_lang()"></p></span>

   <br /> 
    <br />
    
</div>
</div>
<div id="see_all">
    <a href="#" onmousedown="show_movies()" id="edit"
	onclick="return false" style=" margin-left:500px;"><span style="font-family: 'Comic Sans MS', cursive; color: #06F; font-size:26px;">Check All</a> 

    </div><br>
<div id="movies_head"  style="display:none;"> <img src="film.jpg" >

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-family: 'Comic Sans MS', cursive;  font-size:20px;">Movies</span>
</div>
<div id="movies_body" style="display:none;">
<?php echo $movie_html; ?>
</div>
<br>
<div id="serials_head"  style="display:none;"> <img src="tv.jpg"  >

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-family: 'Comic Sans MS', cursive;  font-size:20px;">TV Programs</span>
</div>
<div id="serials_body" style="display:none;">
hello
</div>
<br>

<div id="music_head"  style="display:none;"> <img src="music.jpg"  >

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-family: 'Comic Sans MS', cursive;  font-size:20px;">
Music</span>
</div>
<div id="music_body" style="display:none;">
hello
</div>
<br>

<div id="books_head"  style="display:none;"> <img src="books.jpg"  >

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-family: 'Comic Sans MS', cursive;  font-size:20px;">
Books</span>
</div>
<div id="books_body" style="display:none;">
hello
</div>
<br>

<div id="sports_head"  style="display:none;"> <img src="sports.jpg"  >

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-family: 'Comic Sans MS', cursive;  font-size:20px;">
Sports</span>
</div>
<div id="sports_body" style="display:none;">
hello
</div>
<br>

</div>
</body>
</html>
