<!DOCTYPE html>
<html>
<head>
<title><?php echo TITLE ?></title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css2?family=Literata&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../CSS/kel.css">
<style>
</style>
</head>

<body>
<header class="w3-bar w3-<?php echo "blue" ?> w3-padding">
<div class="w3-bar-item w3-xlarge w3-hide-small" style="margin-right:40px;">Health Care</div>
<div class="w3-bar-item w3-large kel-hover-2" title="Home screen" style="margin-top:7px;margin-bottom:7px;">
    <a href="profile.php?name=<?php echo $url ?>" style="text-decoration:none">
    <i class="fa fa-home"></i> Lobby
    </a>
</div>

<button class="w3-bar-item w3-right w3-border kel-hover-2 " title="My Account" style="margin-top:7px;margin-bottom:7px" onclick="document.getElementById('editun').style.display='block'">
    <i class="fa fa-lock"></i> <?php echo $name ?>
</button>

<div class="w3-dropdown-click w3-bar-item w3-right w3-<?php echo "blue" ?> w3-hover-<?php echo "blue" ?>">
<button class="kel-hover-2 w3-button w3-blue w3-hover-blue" onclick="myFunction()" title="" >
    <i class="fa fa-caret-down"></i>
</button>

    <div id="yo" class="w3-dropdown-content w3-bar-block w3-border">
      <a onclick="document.getElementById('editun').style.display='block'" class="w3-bar-item w3-button"><i class="fa fa-pencil"></i> Edit</a>
      <a href="../logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i> LogOut</a>
    </div>
</div>

<button class="kel-hover-2 w3-right w3-xlarge w3-button w3-hover-blue" 
onclick="window.open('friendRequests.php?name=<?php echo $url ?>', '_self')" title="friend requests" >
<?php
$y = false;
$qry = "SELECT * FROM `friendrequest` WHERE receiver_id = $id AND status_request = 'pending'";
if($d = $conn->query($qry)){
	if($d->num_rows >= 1){
		$y = true;
	}
}
?>
    <i class="fa fa-user-o <?php if($y){echo 'w3-text-black';}?>"></i>
</button>

<button class="kel-hover-2 w3-right w3-xlarge w3-button w3-hover-blue" 
onclick="window.open('chats.php?name=<?php echo $url ?>', '_self')" title="chats" >
    <i class="fa fa-envelope"></i>
</button>

</header>
<?php
	include("Needs/editModal.php");
?>
<script>
function myFunction() {

	let x = document.getElementById("yo");

	if (x.className.indexOf("w3-show") == -1) {
		x.className += " w3-show";
	} 
	else { 
		x.className = x.className.replace(" w3-show", "");
	}

}
</script>
