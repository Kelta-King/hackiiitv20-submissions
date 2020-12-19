<?php
session_start();

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['name'])){

    $dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $email = $dts[1];
    $name = $dts[2];
	$url1 = base64_encode($id."&".$name);

    require_once("../Database/dbconnect_connect.php");
	
	$url = $_REQUEST['name'];
	$dts_comm = explode("&",base64_decode($url));
	$room_id = $dts_comm[0];
	$c_id = $dts_comm[2];
	$c_name = $dts_comm[1];
	
	$query = "SELECT c_admin_id FROM community WHERE c_id = $c_id";
	$admin_id = 0;
	if($data = $conn->query($query)){
		
		$result = $data->fetch_assoc();
		$admin_id = $result['c_admin_id'];		
		
	}
	else{
		die("Something went wrong");
	}
	
define("TITLE", $c_name." ChatRoom | Chat with the members of community");
include("../Commen/header.php");
	
?>

<div class="w3-row w3-row-padding w3-margin-top">
<!-- members section -->
<div class="w3-col l3 m3 w3-hide-small w3-round">
<div class="w3-padding w3-center w3-xlarge w3-round w3-<?php echo "blue" ?>">Members</div>
<table class="w3-table w3-border">
<thead>
    <tr>
        <td class="w3-light-gray" colspan = "2">Names</td>
    </tr>
</thead>
<tbody>
<!-- Admin name -->
<?php
    $query1 = "SELECT real_name FROM users WHERE u_id = $admin_id";
    
    if($data1 = $conn->query($query1)){
        
        $result1 = $data1->fetch_assoc();
?>
<tr>
    <td><i class="fa fa-user-circle"></i> <?php echo $result1['real_name'] ?></td>
    <td class=""><span class="w3-<?php echo "blue" ?>">Admin</span></td>
</tr>
<?php
        
    }
    else{
        echo "something went wrong";
    }
?>
<!-- Other members name -->
<?php
    $query1 = "SELECT real_name FROM(users INNER JOIN community_user ON users.u_id = community_user.u_id) WHERE c_id = $c_id ORDER BY real_name";
    
    if($data1 = $conn->query($query1)){
        
        while($result1 = $data1->fetch_assoc()){
?>
<tr>
    <td><i class="fa fa-user"></i> <?php echo $result1['real_name'] ?></td>
    <td></td>
</tr>
<?php
        }   
    }
    else{
        echo "something went wrong";
    }
?>
</tbody>
</table>
</div>
<!-- chat section -->
<div class="w3-col l9 m9 w3-round">
<div class="w3-padding-large w3-border w3-round w3-xlarge w3-<?php echo "blue" ?> w3-bar">
    <div class="w3-bar-item">
        <i class="fa fa-users"></i> <?php echo $c_name ?>
    </div>
    
</div>

<div class="w3-border w3-round w3-round w3-xlarge w3-light-gray" >
<div id="chats" style="height:500px;overflow:scroll">
    
</div>
</div>

<div class="w3-row" style="margin-top:10px">
<div class="w3-col l11 m10 s10">
    
<input class="w3-input w3-border w3-round w3-large" id="sender" placeholder="your message...">
</div>
<button class="w3-col l1 m2 s2 w3-button w3-<?php echo "blue" ?> w3-round w3-large" type="submit" onclick="send(<?php echo $room_id ?>, <?php echo $id ?>)">Send</button>
</div>
</div>
</div>
<script>
let room_id = <?php echo $room_id ?>;
</script>
<script src="../Js/check.js"></script>
<script src="Js/varified.js"></script>
<script src="Js/refresh.js"></script>

<?php

   $conn->close();
}
else{
   header("Location:../logout.php");
} 

?>
