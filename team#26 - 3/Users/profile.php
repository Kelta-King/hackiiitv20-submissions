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
	<head>
	    <title>Profile | Connect us to discuss your problems</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" async>
		<link href="https://fonts.googleapis.com/css2?family=Literata&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../CSS/kel.css">
		<style>
		
		</style>
	</head>
<body>
<?php
	include("Needs/editModal.php");
?>
<div class="w3-modal" id="createCommunity">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="max-width:500px">
      <header class="w3-container"> 
        <span onclick="document.getElementById('createCommunity').style.display='none'" 
        class="w3-button w3-display-topright w3-xlarge w3-light-gray">&times;</span>
        <h2 class="">Create community</h2>
		<div>
		Make community and maintain it.
		</div>
		<center>
        	<div class="w3-text-red" id="makeError"></div>
        	<div class="loader" id="makeLoader" style="display:none"></div>
        </center>
		<form class="w3-container" id="mkCommunity" action="makeCommunity.php" enctype="multipart/form-data">
		<div class="w3-section w3-padding">
			<input class="w3-input w3-border" id="name" name="Name" placeholder="name of community" required>
		</div>
		<div class="w3-section w3-padding">
			<input type="file" name="fileToUpload" id="fileToUpload" accept="image/x-png,image/gif,image/jpeg" required>
		</div>
		<div class="w3-section w3-padding">
			<textarea class="w3-input w3-border" id="disc" rows="6" name="Disc" placeholder="Describe the community" required></textarea>
		</div>
		<div class="w3-section w3-padding">
		Add tags seperated with comma
			<textarea class="w3-input w3-border" id="tags" name="Tags" placeholder="Tags" required></textarea>
		</div>
		<div class="w3-center w3-section">
			<button class="w3-button w3-blue kel-button" onclick="makeCommunity()">Add</button>
		</div>
		</form>
      </header>
	</div>
</div>

<?php 
$url = "";
include("../Commen/lobbyheader.php")
?>
<center>
<div class="w3-padding-64">

<div class="w3-row w3-content w3-padding">

<div class='w3-padding w3-animate-zoom' style="width:30%">
    <a onclick="document.getElementById('createCommunity').style.display='block'" class="kel-hover-2" style="text-decoration:none">
    <div class='w3-light-gray w3-padding-32 w3-text-blue w3-xlarge'>
    <div><i class="fa fa-plus w3-jumbo"></i></div>
    <div>Create Community</div>
    </div>
    </a>
</div>
</div>
<hr style="border:1px solid gray">
<center>
<div class="" id="myCommunities">
<h2>
My Communities
</h2>
<?php
$qry = "SELECT DISTINCT c_name, c_disc, c_image, community.c_id FROM community INNER JOIN community_user WHERE community_user.u_id = $id";

if($data = $conn->query($qry)){
	
	if($data->num_rows == 0){
		
	}
	else{
		while($result = $data->fetch_assoc()){
?>
<div class='w3-padding w3-animate-zoom w3-light-gray w3-margin-top' style="display:inline-block; width:400px;">
<?php
$c_id = $result['c_id'];
$c_name = $result['c_name'];
$url = base64_encode($c_name."&".$c_id);
?>
	<a href="community.php?name=<?php echo $url ?>" style="text-decoration:none;cursor:pointer">
	<div class="w3-container w3-margin-bottom">
		<div style="background-image:url('<?php echo $result['c_image'] ?>');width:100%;cursor:pointer;padding-top:200px" alt="<?php echo $result['c_name'] ?>" class="">
		</div>
		<div class="w3-container w3-white">
			<p><b><?php echo $c_name ?></b></p>
			<p style="min-height:100px;max-height:100px;overflow:hidden"><?php echo $result['c_disc'] ?></p>
		</div>
	</div>
	</a>
	
</div>
<?php
		}
	}
}
?>
</div>
</center>
</div>
</center>
<script src="../Js/check.js"></script>
<script src="Js/search.js"></script>
<script src="Js/varified.js"></script>

</body>
</html>

<?php
    
    $conn->close();
}
else{
    header("Location:../logout.php"); 
}

?>