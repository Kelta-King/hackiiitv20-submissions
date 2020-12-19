<?php

session_start();
	
	$_SESSION['signup_login'] = "yes";
	
	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	require_once("Database/dbconnect_connect.php");
	
?>

<!DOCTYPE html>
<html>
	<head>
	    <title>Care Connect | Connect and to discuss your problems</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" async>
		<link rel="stylesheet" href="CSS/kel.css">
		<link href="https://fonts.googleapis.com/css2?family=Literata&display=swap" rel="stylesheet"> 
		
		<style>
		
		</style>
	</head>
	<body class="w3-content w3-blue" style="max-width:700px">

<!-- First Grid: Logo & About -->
	
	<div class="w3-row w3-center kel-heading" style="">
		Care Connect
	</div>
	<div class="w3-row" style="margin-top:50px;">
	
		<!-- For LogIn-->
		<div id="layer1">
		<div class="w3-half w3-light-gray w3-container w3-center w3-animate-right" style="height:500px;z-index:2;" id="left1">
			<div class="w3-padding-64">
			
			<form class="w3-container w3-center w3-margin" id="login">
			<center>
			<div class="w3-text-red" id="loginerror"></div>
			<div class="loader" id="loginloader" style="display:none"></div>
			</center>
			<img src="https://www.w3schools.com/w3images/avatar3.png" class="w3-margin w3-circle" alt="Person" style="width:50%">
			<div class="w3-section">
			  <input class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" placeholder="email" style="width:100%;" type="text" id="eu" name="Email" required>
			</div>
			<div class="w3-section">
			  <input type="password" class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" placeholder="password" style="width:100%;" id="password" name="Password" required>
			</div>
			<div class="w3-section">
				<button type="button" onclick="loginCheck()" class="kel-button w3-black w3-round w3-padding w3-border-black w3-black">LogIn</button>
			</div>
			</form>

			</div>
		</div>
	
	
	
		<div class="w3-half w3-green w3-container w3-animate-left" style="height:500px" id="right1">
			<div class="w3-padding-64 w3-left w3-margin-left">
			  <h1>New one?</h1>
			  <h4>Nice to see you...</h4>
			  <p>Care Connect is a simple and easy community environment for mental support. We are glad to see you here. Click the below button to register for free.</p>
			   <div class="w3-center w3-padding-large">
				<button class="kel-button w3-margin-top w3-green w3-round w3-large w3-padding" onclick = "OpenSignIn()">
					Free registration
				</button>
				</div>
			</div>
		  </div>
	
		</div>
	
	
	<!--Signup link-->
	
	<div id="layer2" style="display:none;">
	
		<div class="w3-half w3-green w3-container w3-animate-right" style="height:500px;" id="left2">
		<div class="w3-padding-64 w3-left w3-margin-left">
			<h1>Already registered?</h1>
			<h4>Welcome back...</h4>
			<p>We hope that Care Connect is helping you in your life. Click the below button to login.</p>
			<div class="w3-center w3-padding-large">
			<button class="kel-button w3-margin-top w3-green w3-round w3-large w3-padding" onclick="OpenLogIn()">
				LogIn
			</button>
			</div>
		</div>
		</div>
	  
	  <!--signin-->
	  
		<div class="w3-half w3-light-gray w3-container w3-center w3-animate-left" style="height:500px;" id="right2">
			<div class="w3-padding">
			<div class="w3-xlarge w3-bold w3-margin-top">Fill the below form</div>
			<form class="w3-container w3-center w3-margin" id="signup">
			<center>
			<div class="w3-text-red" id="SignUpError"></div>
			<div class="loader" id="loaderSignUp" style="display:none"></div>
			</center>
			<div class="w3-section">
				<input value="" class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" placeholder="name" style="width:100%;" type="text" id="name" required>
			</div>
			<div class="w3-section">
				<input value=  "" class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" placeholder="name@example.com" style="width:100%;" type="email" id="email" required>
			</div>
			<div class="w3-section">
				<input value="" class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" placeholder="password" style="width:100%;" type="password" id="password1" required>
			</div>
			<div class="w3-section">
				<input value="" class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" placeholder="again password" style="width:100%;" type="password" id="password2" required>
			</div>
			
			<div class="w3-section">
				<select class="w3-select w3-round-xxlarge w3-border" id="gender" style="padding-left:5px" required>
					<span class="w3-animate-top">
					<option value="" class="w3-text-gray" disabled required>Select gender</option>
					<option value="Male" class="w3-text-black" selected>Male</option>
					<option value="Female" class="w3-text-black">Female</option>
					<option value="Other" class="w3-text-black">Other</option>
					</span>
				</select>
			</div>
			<div class="w3-section">
				<button type="button" class="kel-button w3-black w3-round w3-padding w3-border-black w3-black" onclick="SignUpCheck()">Free registeration</button>
			</div>
			</form>

			</div>
		</div>
	  
	  </div>
	</div>
	<script src="Js/check.js"></script>
	<script src="Js/index.js"></script>
	</body>
</html>