<?php

session_start();

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['val'])){

	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	$url = base64_encode($id."&".$name);

	$val = $_REQUEST['val'];
	
	require_once("../../Database/dbconnect_connect.php");
	
	$qry = "SELECT * FROM community WHERE LOWER(c_name) LIKE '%$val%' ORDER BY count LIMIT 5";
	
	if($data = $conn->query($qry)){
		
		if($data->num_rows <= 0){
			echo "No communities";
		}
		else{
		
			while($result = $data->fetch_assoc()){
			
?>
<div class="w3-button w3-padding w3-border-bottom w3-hover-light-gray" href="" style="text-decoration:none;width:100%;text-align:left">
<?php echo $result['c_name'] ?>
	<button class="w3-button w3-right w3-blue w3-hover-green kel-hover" onclick="join(<?php echo $result['c_id'] ?>)">Join</button>
</div>
<?php
			
			}
		
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