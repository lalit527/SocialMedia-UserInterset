<?php
for($i=0;$i<count($_FILES['file']['size']);$i++){
	if(strstr($_FILES['file']['type'][$i], 'image')!==false){
		$file = 'uploads/'.time().' - '.$_FILES['file']['name'][$i];
		move_uploaded_file($_FILES['file']['tmp_name'][$i],$file);
		echo'<a href="'.$file.'"><img src="'.$file.'" style="max-height: 250px;max-width: 500px;" alt="Uploaded Image '.$i.'" /></a><br/>';
	}
}
?>