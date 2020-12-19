<?php
session_start();

if(isset($_SESSION['login_user_connect'])){
    
    $dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
    
    require_once("../Database/dbconnect_connect.php");

	include("Needs/uploadImg.php");
	
	if($uploadOk == 0){
		
		die("Error occured");
		
	}
	else{
		
		$c_name = $_POST['Name'];
		$c_disc = $_POST['Disc'];
		$c_tags = addslashes($_POST['Tags']);
		
		$str = addslashes("Uploads/".$name);
		
		$id = $dts[0];
		$email = $dts[1];
		$name = $dts[2];
		
		define("TITLE", "Making community");
		include("../Commen/header.php");
		
		$query = "INSERT INTO community (c_name, c_disc, c_admin_id, c_image, tags, count) VALUES ('$c_name', '$c_disc', $id, '$str', '$c_tags', 1)";
			
		if($data = $conn->query($query)){
				
			echo "Community created";
			$last_id = $conn->insert_id;
			
			$c_id = $last_id;
			
			$qry1 = "INSERT INTO chat_room (admin_id) VALUES ($id)";
			
			if($conn->query($qry1)){
				
				$room_id = $conn->insert_id;
				$qry2 = "INSERT INTO room_commu VALUES($room_id, $c_id)";
				
				if($conn->query($qry2)){
					
				}
				else{
					echo "Something went wrong ";
				}
				
			}
			else{
				echo "Something went wrong";
			}
			
			$url = base64_encode($c_name."&".$last_id);
			
			$qry = "INSERT INTO community_user VALUES ($last_id, $id)";
			
			if($data = $conn->query($qry)){
				header("Location:community.php?name=".$url);
			}
			else{
				echo "Something went wrong";
			}
			
		}
		else{
			echo "Something went wrong.";
			
		}
		$conn->close();
		
	}
	
}
else{
    header("Location:../logout.php"); 
}
?>