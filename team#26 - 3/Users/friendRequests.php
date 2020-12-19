<?php
session_start();

 if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['name'])){

    $dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	
	require_once("../Database/dbconnect_connect.php");
?>

<!DOCTYPE html>
<html>
<title><?php echo $name." | Profile" ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../Community.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Open Sans", sans-serif
    }
</style>
<?php
	$url = base64_encode($id."&".$name);
	include("../Commen/generalHeader.php");
?>

<div class="w3-content w3-padding-32">
<div class="w3-xxlarge w3-center w3-padding-16">
Friend Requests
</div>
<hr>
<?php
$query = "SELECT * FROM `friendrequest` WHERE receiver_id = $id AND status_request = 'pending' ORDER BY time";

if($data = $conn->query($query)){
	
	if($data->num_rows <= 0){
?>
<div class="w3-center">No friend requests</div>
<?php
	}
	else{
	while($result = $data->fetch_assoc()){
		
		$name = "Unknown";
		$u_id = $result['sender_id'];
		$q = "SELECT real_name FROM users WHERE u_id = $u_id";
		if($d = $conn->query($q)){
			$r = $d->fetch_assoc();
			$name = $r['real_name'];
		}
		else{
			$name = "Unknown";
		}
?>
<div class="w3-padding w3-light-gray w3-bar w3-border w3-round">
	<div class="w3-left w3-bar-item">
	<button class="w3-button w3-hover-light-gray" style="cursor:default"><?php echo $name ?></button>
	</div>
	
	<div class="w3-right w3-bar-item">
	<button class="w3-button w3-blue w3-hover-green" onclick="accept(<?php echo $u_id?>)"><i class="fa fa-check"></i> Accept</button>
	</div>
	<div class="w3-right w3-bar-item">
	<button class="w3-button w3-red w3-hover-red" onclick="cancle(<?php echo $u_id?>)"><i class="fa fa-times"></i> Cancel</button>
	</div>
</div>
<?php
	}
	}
}
?>
</div>
<script src="Js/friendRequests.js"></script>
</body>
<?php
	$conn->close();
}
else{
   header("Location:../logout.php");
}

?>