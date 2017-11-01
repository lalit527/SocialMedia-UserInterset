<?php
include_once('../Connection/check_logged_user.php');
include_once ('../Test/test_file.php');
if(isset($_POST['action']) && $_POST['action'] == 'post'){
	$action = preg_replace("#[^a-z]#i","",$_POST['action']);
	$album = $_POST['albm'];
	$type = preg_replace("#[^a-c]#","",$_POST['type']);
	$loctn = $_POST['loctn'];
	$info = $_POST['info'];
	$fl = $_SESSION['folder'];
	$dir    = $_SESSION['insert'];
	if($album == ""){
		$album = 'Untitled Album';
	}
	$sql = "INSERT INTO albums (username,album,album_id,date,location,info,type) VALUES ('$log_username','$album','$fl',now(),'$loctn','$info','$type')";
	$query = mysqli_query($con,$sql);
	$fl1 = trim($fl);
    $sql = "INSERT INTO status(account_name, author, type, data, result, postdate) VALUES ('$log_username','$log_username','d','$fl','$fl1',now())";
	$query = mysqli_query($con, $sql);
	$id = mysqli_insert_id($con);
	$sql = "UPDATE status SET osid='$id' WHERE id='$id' LIMIT 1";
	$query = mysqli_query($con, $sql);
	$dir1 = substr($dir,3);
$files1 = scandir($dir);
$arrlength=count($files1);

for($x=2;$x<$arrlength;$x++) {
  //echo $files1[$x]."|";
  $file2 = get_rand_id(10).'.jpg';
 
	rename($dir.'/'.$files1[$x],$dir.'/'.$file2);
		$in = trim($dir1.'/'.$file2);
		$sql = "INSERT INTO photos (user, gallery, filename, src, uploaddate) VALUES ('$log_username','$fl1','$file2','$in',now())";
		$query = mysqli_query($con,$sql);
		
				
  //echo "<br>";
}
unset($_SESSION['folder']);
unset($_SESSION['insert']);
//unset($_SESSION['folder']);

echo 'done';
exit();
}
?>

<?php
include_once ('../Test/test_file.php');
//echo 'got';
$failed = false;
$images = Array();
$upload_dir = "../Users/$log_username/album/";

if (isset($_FILES['upload_files']) && $_FILES['upload_files']['error'] != 0) {    
            if(!isset($_SESSION['folder'])){
			$_SESSION['folder'] = get_rand_id(12);
			 
			
			}
			$folder_name = $_SESSION['folder'];
			if(!file_exists("$upload_dir/$folder_name")){
			mkdir("$upload_dir/$folder_name", 0755, TRUE);
			}
						$upload_dir2 = "$upload_dir/$folder_name/";
						$_SESSION['insert'] = "$upload_dir/$folder_name";
        foreach($_FILES['upload_files']['tmp_name'] as $key=>$value) {
                 
                $file = $_FILES['upload_files']['name'];
				//$file2 = get_rand_id(16).'jpg';
				//rename('$file','$file2');
				$file = $file [$key];
                // allow only image upload
                if(preg_match('#image#',$_FILES['upload_files']['type'][$key])) {
                    if(!move_uploaded_file($value, $upload_dir2.$file)) {
                        $failed = true;
                    } else {                    
                        $images[] = "$upload_dir2/".$file;                    
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


