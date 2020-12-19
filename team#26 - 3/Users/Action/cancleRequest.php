<?php

session_start();

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['id'])){

	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	$url = base64_encode($id."&".$name);

	$sender_id = $_REQUEST['id'];
	
	require_once("../../Database/dbconnect_connect.php");
	
	$qry = "DELETE FROM friendrequest WHERE sender_id = $sender_id AND receiver_id = $id";
	
	
	if($conn->query($qry)){
	
	}
	else{
		echo "Something went wrong";
	}
	
	$conn->close();

}
else{
	header("Location:../../logout.php");
}
?>