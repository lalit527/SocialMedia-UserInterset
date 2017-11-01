<?php
  include_once('Connection/check_logged_user.php');
  $pages_liked= '';
  $sql = "SELECT name_id FROM likesmembers WHERE username='$log_username'";
  $query = mysqli_query($con,$sql);
  $numrows = mysqli_num_rows($query);
  $pages = '';
  if($numrows > 0){
	  while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		  $name = $row['name_id'];
		 // $type = $row['type'];
		 // $pages = '<div id=""></div>';
		  //array_push($pages,$name);
		  $sql = "SELECT * FROM likes WHERE name_id='$name'";
		  $query = mysqli_query($con,$sql);
		  $num = mysqli_num_rows($query);
		  if($num > 0){
			  while($row_lk = mysqli_fetch_array($query,MYSQLI_ASSOC)){
				  $id = $row_lk['id'];
				  $name_lk = $row_lk['name'];
				  $pic = $row_lk['pic'];
				  $c_pic = $row_lk['c_pic'];
				  $back = $row_lk['back'];
				  $type = $row_lk['type'];
				  $name_id = $row_lk['name_id'];
				  $creator = $row_lk['creator'];
				  $created = $row_lk['created'];
				 $pages_liked .= '<a href="#" onclick="return false" onmousedown="gotoLike(\''.$name_id.'\')"><div id="like_main"><div>
				 <img src="likes/'.$name_id.'/'.$pic.'" style="width:50px;height:50px;float:left;">'.$name.'<br /></div></div></a>'; 
			  }
		  }
	  }
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
#page_sports{
	position: absolute;
	width: 284px;
	height: 292px;
	border: thin solid #000;
	top: 8px;
	left: 345px
}
#sports_div{
	position: absolute;
	 
	width: 284px;
	height: 292px;
	display:none;
     
}
#page_movies{
	position: absolute;
	width: 300px;
	height: 300px;
	border: thin solid #000;
	top: 4px;
	left: 672px
}
#page_books{
	position: absolute;
	width: 300px;
	height: 300px;
	border: thin solid #000;
	left: 7px;
	top: 342px;
}
#page_music{
	position: absolute;
	width: 310px;
	height: 296px;
	border: thin solid #000;
	left: 8px;
	top: 10px;
	
}
#page_brands{
	position: absolute;
	width: 300px;
	height: 300px;
	border: thin solid #000;
	left: 336px;
	top: 342px;
}
#page_celebs{
	position: absolute;
	width: 300px;
	height: 301px;
	border: thin solid #000;
	left: 673px;
	top: 343px;
}
#action  {
	position:absolute;
	right:20px;
}
#page_all {
	position:absolute;
	top:50px;
}
</style>
<script type="text/javascript" src="JavaScript/script.js"></script>
<script type="text/javascript" src="JavaScript/ajax.js"></script>
<script>
function checkName(x){
	alert(x);
	var n = document.getElementById('txt').value;
	alert(n+x);
}
function showSport(){
	document.getElementById('sportsimg').style.display = 'none';
	document.getElementById('sports_div').style.display = 'block';
	document.getElementById('movies_div').style.display = 'none';
	document.getElementById('moviesimg').style.display = 'block';
	document.getElementById('musicimg').style.display = 'block';
	document.getElementById('music_div').style.display = 'none';
	
}
function showMovies(){
	document.getElementById('moviesimg').style.display = 'none';
	document.getElementById('movies_div').style.display = 'block';
	document.getElementById('sports_div').style.display = 'none';
	document.getElementById('sportsimg').style.display = 'block';
	document.getElementById('musicimg').style.display = 'block';
	document.getElementById('music-div').style.display = 'none';

}
function showMusic(){
	document.getElementById('moviesimg').style.display = 'block';
	document.getElementById('musicimg').style.display = 'none';
	document.getElementById('music_div').style.display = 'block';
	document.getElementById('movies_div').style.display = 'none';
	document.getElementById('sports_div').style.display = 'none';
	document.getElementById('sportsimg').style.display = 'block';

}

function showBooks(){
	document.getElementById('bookpage').style.display = 'none';
    document.getElementById('book_div').style.display = 'block';
    document.getElementById('music_div').style.display = 'none';
	
}
function showCeleb(){
	document.getElementById('celeb').style.display = 'none';
    document.getElementById('celeb_div').style.display = 'block';
    document.getElementById('movies_div').style.display = 'none';
    
}
function showBrand(){
	document.getElementById('brand').style.display = 'none';
    document.getElementById('brand_div').style.display = 'block';
    document.getElementById('sports_div').style.display = 'none';
    
}
function adminPg(){
	
	
}

function createSports(){
	alert("hello1");
	var x = document.getElementById('txt_sprt').value;
	alert("hello2"+x);
	var ajax = ajaxObj("POST", "Parser/like_parser.php");
	
	alert("hello3");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText.replace(/^\s+|\s+$/g, "");
			alert(response);
			if(response == "insert_ok"){
				
				window.location = "like.php?likes="+x+"&type=sports";
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=sports&name="+x);

	
}
function createSports(){
	alert("hello1");
	var x = document.getElementById('txt_sprt').value;
	alert("hello2"+x);
	var ajax = ajaxObj("POST", "Parser/like_parser.php");
	
	alert("hello3");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText;
			alert(response);
			var datArray = response.split('|');
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "insert_ok"){
				
				window.location = "like.php?id_get="+datArray[1];
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=sports&name="+x);

	
}
function createMovies(){
	alert("hello1");
	var x = document.getElementById('txt_mvi').value;
	var y=document.getElementById("movies_optn").value;
	alert("hello2"+x+y);
	var ajax = ajaxObj("POST", "Parser/like_parser.php");
	
	alert("hello3");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var response = ajax.responseText;
			alert(response);
			var datArray = response.split('|');
			if(datArray[0].replace(/^\s+|\s+$/g, "") == "insert_ok"){
				
				window.location = "like.php?id_get="+datArray[1];
			} else {
				alert(response);
			}
		}
	}
	ajax.send("action=movies&name="+x+"&category="+y);

	
	
}

</script>
</head>

<body>
<div id="action"><button onclick="" id="btnmy">Pages I liked</button>
<button onclick="adminPg()" id="btncr">Pages I admin</button>
</div>
<div id="page_all">
<div id="page_sports">
<a href="#" onclick="return false" onmousedown="showSport()"><center> <img id="sportsimg" src="Images/sports.jpg"  width="301" height="290"  /> <div id="sports_div"><br /><br /><br />Create a Sports Page<br /><br /><input type="text" id="txt_sprt" placeholder="Enter name" onblur="checkName(\'sports\')"/><br /><br />
Choose your category:<br /><br />
<select id="sports_optn">
<option value="blank">  </option>
  <option value="cricket">Cricket</option>
  <option value="football">Soccer</option>
  <option value="racing">Racing</option>
  <option value="boxing">Boxing</option>
  <option value="tennis">Tennis</option>
  <option value="hockey">Hockey</option>
  <option value="golf">Golf</option>
  <option value="swimming">Swimming</option>
  
</select>
<br /><br /><br />

 <input type="button" value="Create" onclick="createSports()"/></div></center></a>
</div>


<div id="page_movies">
<a href="#" onclick="return false" onmousedown="showMovies()"><center> <img id="moviesimg" src="Images/movies.jpg"  width="301" height="290"  /> <div id="movies_div"><br /><br /><br />Create a Movie Page<br /><br /><input type="text" id="txt_mvi" onblur="checkName(\'movies\')" placeholder="Enter name" /><br /><br />
Choose your category:<br /><br />
<select id="movies_optn">
<option value="blank">  </option>
  <option value="comedy">Comedy</option>
  <option value="action">Action</option>
  <option value="sci-fi">Sci-Fi</option>
  <option value="anime">Animation</option>
  <option value="horror">Horror</option>
  <option value="romance">Romance</option>
  <option value="drama">Drama</option>
  <option value="thriller">Thriller</option>
</select>
<br /><br /><br />

 <input type="button" value="Create" onclick="createMovies()"/></div> </center></a>
</div>


<div id="page_music">
<a href="#" onclick="return false" onmousedown="showMusic()"><center> <img id="musicimg" src="Images/music.jpg"  width="303" height="296"  />  <div id="music_div"style="display:none;"><br /><br /><br />Create a Music Page<br /><br /><input type="text" placeholder="Enter name" id="music_txt" onblur="checkName(\'music\')"/><br /><br />
Choose your category:<br /><br />
<select id="music_optn">
<option value="blank">  </option>
  <option value="hard_rock">Hard Rock</option>
  <option value="classical">Classical</option>
  <option value="hiphop">Hip Hop/Rap</option>
  <option value="metal">Metal</option>
  <option value="folk">Folk</option>
  <option value="contemporary">Contemporary</option>
</select>
<br /><br /><br />
 <input type="button" value="Create" onclick="createMusic()"/></div> </center></a>
</div>

<div id="page_books">
<a href="#" onclick="return false" onmousedown="showBooks()"><center> <img id="bookpage" src="Images/books.jpg"  width="301" height="290"  /><div id="book_div" style="display:none;"><br /><br /><br />Create a Books Page<br /><br /><input type="text" placeholder="Enter name" id="books_txt" onblur="checkName(\'book\')"/><br /><br />
Choose your category:<br /><br />
<select id="books_optn">
<option value="blank">  </option>
  <option value="fiction">Fiction</option>
  <option value="horror">Horror</option>
  <option value="mystry">Mystery</option>
  <option value="romance">Romance</option>
  <option value="health">Health</option>
  <option value="comics">Comics</option>
  <option value="art">Art & Literature</option>
  <option value="politics">Politics</option>
  <option value="cooking">Cooking</option>
</select>
<br /><br /><br />

 <input type="button" value="Create" onclick="createBooks()"/></div> </center></a>

</div>
<div id="page_celebs">
<a href="#" onclick="return false" onmousedown="showCeleb()"><center> <img id="celeb" src="Images/serials.png"  width="301" height="290"  /><div id="celeb_div" style="display:none;"><br /><br /><br />Create a Tv/Entertainment Page<br /><br /><input type="text" placeholder="Enter name" id="serials_txt" onblur="checkName(\'s\')"/><br /><br />
Choose your category:<br /><br />
<select id="serilas_optn">
<option value="blank">  </option>
  <option value="comedy">Comedy</option>
  <option value="action">Action</option>
  <option value="sci-fi">Sci-Fi</option>
  <option value="horror">Horror</option>
  <option value="romance">Romance</option>
  <option value="drama">Drama</option>
  <option value="thriller">Thriller</option>
</select>
<br /><br /><br />
 <input type="button" value="Create" onclick="createCelbs()"/></div> </center></a>

</div>
<div id="page_brands">
<a href="#" onclick="return false" onmousedown="showBrand()"><center> <img src="Images/brands.jpg"  id="brand" width="301" height="290"  /> <div id="brand_div" style="display:none;"><br /><br /><br />Create a Brands/Products<br /><br /><input type="text" placeholder="Enter name" id="brands_txt" onblur="checkName(\'serial\')"/><br /><br />
Choose your category:<br /><br />
<select id="brands_optn">
<option value="blank">  </option>
  <option value="app">App</option>
  <option value="bags">Bags</option>
  <option value="clothing">Clothing</option>
  <option value="cars">Cars</option>
  <option value="computers">Computers</option>
  <option value="food">Food/Beverages</option>
  <option value="games">Games</option>
  <option value="health">Health/Beauty</option>
  
</select>
<br /><br /><br />

 <input type="button" value="Create" onclick="createBrands()"/></div></center></a>

</div>



</div>
</body>
</html>