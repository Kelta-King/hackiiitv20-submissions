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
	$c_name = $dts_comm[0];
	$c_id = $dts_comm[1];
	
?>
<?php
define("TITLE", $c_name." Community | Discussion can happen here");
include("../Commen/header.php");
?>
<body class="w3-theme-l5">
<script src="../Js/jquery.min.js"></script>
  
  <!-- Page Container -->
<?php
	include("Needs/editModal.php");
?>
<div class="w3-center w3-margin-top w3-xxlarge">
Community: <b><?php echo $c_name ?></b>
</div>
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:20px">
    <!-- The Grid -->
    <div class="w3-row">

      <!-- Middle Column -->
      <div class="w3-col m10">

        <div class="w3-row-padding">
          <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
              <div class="w3-container w3-padding">
                <h6 class="w3-opacity">Write post?</h6>
				<center>
					<div class="w3-text-red" id="post-error"></div>
					<div class="loader" id="post-loader" style="display:none"></div>
				</center>
                <p contenteditable="true" id="post_data" class="w3-border w3-padding" >Start writing post...</p>
                <button type="button" class="w3-button w3-blue kel-hover w3-hover-green" onclick="addPost(<?php echo $c_id ?>)"><i class="fa fa-pencil"></i>  Post</button>
				
				<label for="file" class="w3-blue w3-padding w3-right" style="display:inline-block;cursor:pointer;">
					<i class="fa fa-image"></i> Upload Image
				</label>
				<input id="file" type="file" accept="image/x-png,image/gif,image/jpeg" style="display:none;"/>
              </div>
            </div>
          </div>
        </div>
<script src="Js/community.js"></script>

<?php

	$qry = "SELECT users.u_id, users.u_dp, users.real_name, post.p_id, post.p_data, post.likes, post.time FROM post INNER JOIN users ON post.u_id = users.u_id WHERE c_id = $c_id ORDER BY time DESC LIMIT 10";
	
	if($data = $conn->query($qry)){

		while($result = $data->fetch_assoc()){
			$img = $result['u_dp'];
?><?php
	$url = base64_encode($result['u_id']."&".$result['real_name']);
?>
        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
          <a href="otherProfile.php?name=<?php echo $url ?>" style="text-decoration:none;">
		  <img src="<?php echo $img ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px;height:60px">
          <span class="w3-right w3-opacity"></span>

          <h5><?php echo $result['real_name'] ?></h5><br>
		  </a>
          <hr class="w3-clear">
          <p>
		  <?php echo htmlspecialchars_decode($result['p_data']) ?>
		  </p>
<?php
	$p_id = $result['p_id'];
	$qry1 = "SELECT u_id FROM post_user_like WHERE p_id = $p_id AND u_id = $id";
	$x = false;
	if($data2 = $conn->query($qry1)){
		
		if($data2->num_rows >= 1){
			$x = true;
		}
		
	}
?>
          <button type="button" class="w3-button w3-blue w3-hover-green w3-margin-bottom <?php if($x){echo "w3-green";} ?>" id="<?php echo $result['p_id'] ?>_btn" onclick="like(<?php echo $result['p_id'] ?>)">
		  <span id="<?php echo $result['p_id'] ?>"><?php echo $result['likes'] ?></span> <i class="fa fa-thumbs-up"></i> Like<?php if($x){echo "d";} ?></button>
        </div>
<?php
		}
	}
	else{
		echo "Something went wrong";
	}
?>
            <!-- End Middle Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-col m2">
<?php
	//chat rroom's url
	$qury = "SELECT room_id FROM room_commu WHERE c_id = $c_id";
	if($data = $conn->query($qury)){
		
		$result = $data->fetch_assoc();
		$room_id = $result['room_id'];
		
		$url = base64_encode($room_id."&".$c_name."&".$c_id);
		
		$link = "chat_room.php?name=".$url;
?>

<div class="w3-card w3-round w3-xlarge w3-center w3-margin-bottom w3-padding-16 kel-hover w3-green"
 style="cursor:pointer;" onclick="window.open('<?php echo $link ?>', '_self')">
	<i class="fa fa-comments"></i> chatroom
</div>

<?php
	}
?>
				
			  
              <div class="w3-card w3-round w3-white w3-center">
                <div class="w3-container">
                  <h4><strong>Doctors</strong></h4>
<?php
$qry = "SELECT real_name, users.u_id FROM users INNER JOIN community_user ON users.u_id = community_user.u_id WHERE community_user.c_id = $c_id AND users.role = 'doctor'";

if($data = $conn->query($qry)){
	
	if($data->num_rows == 0){
		echo "<p>No doctors in this community</p>";
	}
	else{
		
		while($result = $data->fetch_assoc()){
			$u_id = $result['u_id'];
			$real_name = $result['real_name'];
			$url = base64_encode($u_id."&".$real_name);
?>
        <a href="otherProfile.php?name=<?php echo $url ?>"><p><?php echo "Dr. ".$result['real_name'] ?></p></a>
<?php
	}
		
	}
	
}
?>
                  <p><button class="w3-button w3-block w3-light-gray kel-hover">Show All</button></p>
                </div>
              </div>
              <br>

                <div class="w3-card w3-round w3-white w3-center">
                  <div class="w3-container">
                    <h4><strong>Members</strong></h4>
<?php
$qry = "SELECT real_name, users.u_id FROM users INNER JOIN community_user ON users.u_id = community_user.u_id WHERE community_user.c_id = $c_id AND users.role <> 'doctor'";

if($data = $conn->query($qry)){
	
	if($data->num_rows == 0){
		echo "<p>No users in this community</p>";
	}
	else{
		
		while($result = $data->fetch_assoc()){
			$u_id = $result['u_id'];
			$real_name = $result['real_name'];
			$url = base64_encode($u_id."&".$real_name);
?>
        <a href="otherProfile.php?name=<?php echo $url ?>"><p><?php echo $result['real_name'] ?></p></a>
<?php
	}
		
	}
	
}
?>
                    <p><button class="w3-button w3-block w3-light-gray kel-hover">Show All</button></p>
                  </div>
                </div>
                <br>

            <!-- End Right Column -->
            </div>

          <!-- End Grid -->
          </div>

        <!-- End Page Container -->
        </div>
        <br>

        <script>
               </script>
</body>
<?php

   $conn->close();
}
else{
   header("Location:../logout.php");
} 

?>
