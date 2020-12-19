<?php

session_start();

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['id'])){

	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	$url = base64_encode($id."&".$name);

	$receiver_id = $_REQUEST['id'];
	
	require_once("../../Database/dbconnect_connect.php");
	
	$qry = "SELECT * FROM friendrequest WHERE sender_id = $id AND receiver_id = $receiver_id";
	
	if($data = $conn->query($qry)){
		
		if($data->num_rows >= 1){
			die();
		}
		
	}
	
	$qry = "INSERT INTO friendrequest(sender_id, receiver_id, status_request) VALUES($id, $receiver_id, 'pending')";
	
	if($conn->query($qry)){
		
		
		
	}
	else{
		echo "Something went wrong.";
	}
	
	$conn->close();

}
else{
	header("Location:../../logout.php");
}
?>