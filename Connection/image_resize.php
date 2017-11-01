<?php
function img_resize($target, $newcopy, $w, $h, $ext){
	  list($w_orgnl,$h_orgnl) = getimagesize($target);
	  $scale_ratio = $w_orgnl/$h_orgnl;
	  if($w/$h > $scale_ratio){
		  $w = $h * $scale_ratio;
	  }else{
		$h = $w / $scale_ratio;  
	  }
	  $img = "";
	  $ext = strtolower($ext);
	  if($ext == "gif"){
         $img = imagecreatefromgif($target);		  
	  }
	  else if($ext == "png"){
         $img = imagecreatefrompng($target);		  
	  }
	  else{
		  $img = imagecreatefromjpeg($target);
		  
	  }
	  $tc = imagecreatetruecolor($w, $h);
	  imagecopyresampled($tc, $img, 0, 0, 0, 0, $w, $h, $w_orgnl, $h_orgnl);
      imagejpeg($tc, $newcopy, 84);     
}
?>