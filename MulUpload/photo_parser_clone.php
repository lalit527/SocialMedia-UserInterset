<?php
if(isset($_FILES['file'])){
	echo 'hello';
    $name_array = $_FILES['file']['name'];
    $tmp_name_array = $_FILES['file']['tmp_name'];
    $type_array = $_FILES['file']['type'];
    $size_array = $_FILES['file']['size'];
    $error_array = $_FILES['file']['error'];
         echo '<img src="'.$tmp_name_array.'">';
        if(move_uploaded_file($tmp_name_array, "uploads/".$name_array)){
            echo $name_array." upload is complete<br>";
			//echo jason_encode($tmp_name_array);
        } else {
            echo "move_uploaded_file function failed for ".$name_array[$i]."<br>";
        }
    
}else {
	echo 'fuck';
}
?>
