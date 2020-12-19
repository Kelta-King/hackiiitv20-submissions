<?php

session_start();

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['c_id'])){

	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	$url = base64_encode($id."&".$name);

	$c_id = $_REQUEST['c_id'];
	
	require_once("../../Database/dbconnect_connect.php");
	
	$qry = "SELECT c_id FROM community_user WHERE c_id = $c_id AND u_id = $id";
	
	if($data = $conn->query($qry)){
		if($data->num_rows >= 1){
			die("You are already in the community");
		}
	}
	else{
		die("Something went wrong");
	}
	
	$qry = "INSERT INTO community_user VALUES($c_id, $id)";
	
	if($conn->query($qry)){
		
		$qy = "SELECT c_name FROM community WHERE c_id = $c_id";
		
		if($data = $conn->query($qy)){
			
			$result = $data->fetch_assoc();
			$c_name = $result['c_name'];
			$url = base64_encode($c_name."&".$c_id);
			echo "community.php?name=".$url;
			
		}
		else{
			echo "Something went wrong";
		}
		
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