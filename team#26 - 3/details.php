<?php

session_start();

if(isset($_SESSION['signup_r']) && isset($_SESSION['signup_login'])){

    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $password = $_POST['Pass1'];

    require_once("Database/dbconnect_connect.php");
    
    $query = "SELECT `u_id`, `u_password`, `real_name` FROM `users` WHERE email = '$email'";
    
    if($data = $conn->query($query)){
        
        if($data->num_rows <= 0){
            echo "Incorrect email";
        }
        else if($data->num_rows == 1){
            
            $result = $data->fetch_assoc();
            $dbpass = $result['u_password'];
            
            if(password_verify($password, $dbpass)){
                
                $id = $result['u_id'];
                $name = $result['real_name'];
                $url = base64_encode($id."&".$name);
                
                $url1 = base64_encode($id."&".$email."&".$name);
                $_SESSION['login_user_connect'] = $url1;
                //header("Location:Users/profile.php?name=".$url);
				
				include("Commen/headerDetails.php");
?>

<div class="w3-content w3-light-gray" style="max-width:400px">
<div class="w3-center w3-xlarge w3-padding-16">
Your details
</div>
<center>
	<div class="w3-text-red" id="details-error"></div>
	<div class="loader" id="loader-details" style="display:none"></div>
</center>
<form id="data">
<div class="w3-section w3-margin w3-padding">
Name:
	<input class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" placeholder="name" style="width:100%;cursor:no-drop" type="text" id="name" name="Name" value = "<?php echo $name ?>" readonly required>
</div>
<div class="w3-section w3-margin w3-padding">
Email:
	<input class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" style="cursor:no-drop" placeholder="email" style="width:100%;" type="email" id="email" name="Email" value = "<?php echo $email ?>" readonly required>
</div>
<div class="w3-section w3-margin w3-padding">
Are you Doctor or patient?
	<select class="w3-select w3-round-xxlarge w3-border" id="role" style="padding-left:5px" required>
		<option value="" class="w3-text-gray" disabled required>Select role</option>
		<option value="patient" class="w3-text-black" selected>Patient/Relative of patient</option>
		<option value="doctor" class="w3-text-black">Doctor</option>
		<option value="other" class="w3-text-black">Other</option>
	</select>
</div>
<center>
<div class="w3-section w3-padding">
<label for="file" class="w3-blue w3-padding" style="display:inline-block;cursor:pointer;">
	<i class="fa fa-image"></i> Upload Profile Picture
</label>
<input id="file" type="file" accept="image/x-png,image/gif,image/jpeg" style="display:none;"/>
</div>
</center>
<div id="status" class="w3-center">
</div>
<div class="w3-section w3-margin w3-padding">
DOB
	<input type="date" id="dob" class="w3-input w3-round-xxlarge w3-border w3-hover-border-black" required>
</div>
<div class="w3-section w3-margin w3-padding">
About Me
	<textarea id="aboutMe" rows="5" class="w3-input w3-round-xxlarge w3-border w3-hover-border-black"></textarea>
</div>
<div class="w3-section w3-center w3-padding-16">
	<button type="button" class="kel-button w3-black w3-round w3-padding w3-border-black w3-blue w3-hover-green" onclick="join('<?php echo $email ?>')">Join</button>
</div>
</form>
</div>
<script src="Js/jquery.min.js"></script>
<script src="Js/check.js"></script>
<script src="Js/details.js">
</script>
</body>
</html>
<?php
               
            }
            else{
                echo "Incorrect password";
            }
            
        }
        else{
            echo "Incorrect details";
        }
        
    }
    else{
        echo "Something went wrong";
        
    }
    
    $conn->close();
}
else{
    echo "<script>alert('Login first')</script>";
    header("Location:logout.php");
}

?>