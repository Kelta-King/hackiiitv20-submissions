<!DOCTYPE html>
<html>
<head>
<title>Give details</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css2?family=Literata&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="CSS/kel.css">
<style>
</style>
<script>
function myFunction() {
      var x = document.getElementById("Demo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else { 
        x.className = x.className.replace(" w3-show", "");
      }
    }
</script>
</head>

<body>

<header class="w3-bar w3-<?php echo "blue" ?> w3-padding">
<div class="w3-bar-item w3-xlarge w3-hide-small" style="margin-right:40px;">HealthCare</div>

<button class="w3-bar-item w3-right w3-border kel-hover-2 " title="My Account" style="margin-top:7px;margin-bottom:7px" >
    <i class="fa fa-lock"></i> <?php echo "name" ?>
</button>

<div class="w3-dropdown-click w3-bar-item w3-right w3-<?php echo "blue" ?> w3-hover-<?php echo "blue" ?>">
<button class="kel-hover-2 w3-button w3-<?php echo "blue" ?> w3-hover-<?php echo "blue" ?>" onclick="myFunction()" title="Options" >
    <i class="fa fa-caret-down"></i>
</button>
    <div id="Demo" class="w3-dropdown-content w3-bar-block w3-border">
      <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i> LogOut</a>
    </div>
</div>

</header>
