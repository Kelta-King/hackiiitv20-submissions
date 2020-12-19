<?php

session_start();

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['c_id'])){

	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	$url = base64_encode($id."&".$name);

	$c_id = $_REQUEST['c_id'];
	$data = htmlspecialchars($_REQUEST['data']);

    require_once("../../Database/dbconnect_connect.php");
	
	$qry = "INSERT INTO post(p_data, p_hashtags, c_id, u_id) VALUES ('$data', 'not', $c_id, $id)";
	
	if($conn->query($qry)){
		
	}
	else{
		echo "Something went wrong";
	}
	
	$conn->close();

}
else{
	header("Location:../logout.php");
}
?>