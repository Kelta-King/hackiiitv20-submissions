<?php
//upload.php
if($_FILES["file"]["name"] != ''){
	
	$test = explode('.', $_FILES["file"]["name"]);
	$ext = end($test);
	$name = rand(100, 999) . '.' . $ext;
	
	$location = '../Users/Uploads/'.$name;  
	move_uploaded_file($_FILES["file"]["tmp_name"], $location);
	
	echo "Uploads/".$name;
	
}
?>