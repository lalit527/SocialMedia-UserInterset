<?php
echo 'got';
$failed = false;
$images = Array();
$upload_dir = "uploads/";

if (isset($_FILES['upload_files']) && $_FILES['upload_files']['error'] != 0) {    
    
        foreach($_FILES['upload_files']['tmp_name'] as $key=>$value) {

                $file = $_FILES['upload_files']['name'][$key];
                // allow only image upload
                if(preg_match('#image#',$_FILES['upload_files']['type'][$key])) {
                    if(!move_uploaded_file($value, $upload_dir.$file)) {
                        $failed = true;
                    } else {                    
                        $images[] = "uploads/".$file;                    
                    }    
                } else {
                    $images = array("error"=>"Sorry, only images are allowed to upload");
                }
        }

}
if($failed == true) {
	$images = array("error"=>"Server Error<br/>Reported to Admin");
}
?>

<html>
 <body>
  <script type="text/javascript">
  window.parent.Uploader.done('<?php echo json_encode($images); ?>');
  </script>
 </body>
</html>


