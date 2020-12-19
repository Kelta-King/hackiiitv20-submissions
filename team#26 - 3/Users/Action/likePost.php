<?php

session_start();

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['p_id'])){

	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	$url = base64_encode($id."&".$name);

	$p_id = $_REQUEST['p_id'];
	
	require_once("../../Database/dbconnect_connect.php");
	
	$qry1 = "SELECT u_id FROM post_user_like WHERE p_id = $p_id";
	
	if($data = $conn->query($qry1)){
		
		if($data->num_rows >= 1){
			die();
		}
		
	}
	
	$qry = "SELECT likes FROM post WHERE p_id = $p_id";
	
	if($data = $conn->query($qry)){
		
		$result = $data->fetch_assoc();
		$likes = $result['likes'];
		$likes++;
		
		$qry = "UPDATE post SET likes = $likes WHERE p_id = $p_id";
		
		if($conn->query($qry)){
			
			$qry2 = "INSERT INTO post_user_like VALUES($p_id, $id)";
			
			if($conn->query($qry2)){
				echo $likes;
			}
			else{
				echo "Something";
			}
		}
		else{
			echo "Like didn't go up";
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