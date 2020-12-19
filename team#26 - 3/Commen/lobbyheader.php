<script>
	function myFunction() {
		var x = document.getElementById("Demo");
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} 
		else { 
			x.className = x.className.replace(" w3-show", "");
		}
	}
	
	function myFunction2(val = false) {
		
		if(val){
			
		}
		else{
			
			var x = document.getElementById("Demo2");
			if (x.className.indexOf("w3-show") == -1) {
				x.className += " w3-show";
			} 
			else { 
				x.className = x.className.replace(" w3-show", "");
			}
			
		}
		
	}
</script>

<body>

<header class="w3-bar w3-<?php echo "blue" ?> w3-padding">
<div class="w3-bar-item w3-xlarge w3-hide-small" style="margin-right:40px;">Health Care</div>
<?php $url = base64_encode($id."&".$name); ?>
<button class="w3-bar-item w3-right w3-border kel-hover-2 " title="My Account" style="margin-top:7px;margin-bottom:7px;cursor:pointer" onclick="window.open('userProfile.php?name=<?php echo $url ?>', '_self')">
    <i class="fa fa-lock"></i> <?php echo $name ?>
</button>

<div class="w3-dropdown-click w3-blue w3-bar-item">
	<input id="search_val" class="w3-input w3-light-gray" style="width:600px" placeholder="search community..." onclick="myFunction2()">
	<div id="Demo2" style="width:700px" class="w3-dropdown-content w3-bar-block w3-border">
	<div id="search_answers">
		<!--<div class="w3-button w3-padding w3-border-bottom w3-hover-light-gray" href="" style="text-decoration:none;width:100%;text-align:left">Cancer
		<button class="w3-button w3-right w3-blue w3-hover-green kel-hover">Join</button>
		</div>-->
		<div class="w3-button w3-padding w3-border-bottom w3-hover-light-gray" style="text-decoration:none;width:100%;">
		---
		</div>
	</div>
		<a class="w3-button w3-padding w3-light-gray" onclick="document.getElementById('createCommunity').style.display='block'" style="text-decoration:none;width:100%" class="w3-center">Create a Community</a>
    </div>
</div>
<div class="w3-bar-item">
<button class="w3-button w3-white w3-hover-white" onclick="search()"><i class="fa fa-search"></i> Search</button>
</div>
<div class="w3-dropdown-click w3-bar-item w3-right w3-<?php echo "blue" ?> w3-hover-<?php echo "blue" ?>">
<button class="kel-hover-2 w3-button w3-blue w3-hover-blue" onclick="myFunction()" title="Options" >
    <i class="fa fa-caret-down"></i>
</button>

    <div id="Demo" class="w3-dropdown-content w3-bar-block w3-border">
      <a onclick="document.getElementById('editun').style.display='block'" class="w3-bar-item w3-button"><i class="fa fa-pencil"></i> Edit</a>
      <a href="" class="w3-bar-item w3-button"><i class="fa fa-group"></i> Communities</a>
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
