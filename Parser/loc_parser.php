<?php

class loc{
	
function geoCheckIP($ip){
	
		       $response = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			   
			   $country = $response->country;
			   $city = $response->city;
			   $detail = $city."(".$country.")";
			   //return $city;
			  // $sql = "UPDATE useroptions SET lastlog='$detail' WHERE username='$u' LIMIT 1";
	          //  $query = mysqli_query($con,$sql);
				return $detail;		          
		}
		
	
}

?>
<?php
if(isset($_POST['ip'])){
	
$ip = "".$_POST['ip'];
$ip2 = trim($ip);
$ip3 = "202.145.75.25";
$chat = new loc();
$gr = $chat->geoCheckIP($ip2);
echo $gr;
}

?>
<!doctype html>
<html>
<head>
<script type="text/javascript" src="http://l2.io/ip.js?var=myip"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $.post("loc_parser.php",
    {
      ip: myip
    },
    function(data,status){
      alert("Data: " + data);
    });
  });
});
</script>
</head>
<body>
<button >click</button>
</body>
</html>