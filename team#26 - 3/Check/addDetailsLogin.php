<?php

session_start();

if(isset($_SESSION['signup_login']) && isset($_SESSION['login_user_connect'])){
    
    $role = $_REQUEST['role'];
    $dob = $_REQUEST['dob'];
	$email = $_REQUEST['email'];
    $about = $_REQUEST['about'];
	$img = $_REQUEST['img'];
    
    require_once("../Database/dbconnect_connect.php");
    
    $query = "UPDATE users SET role = '$role', dob = '$dob', description = '$about', u_dp = '$img' WHERE email = '$email'";
    
    if($data = $conn->query($query)){
        
		if($conn->query($query)){
        
        }
        else{
            echo "Something went wrong"; 
        }
            
    }
    else{
        echo "Something went wrong.";
    }

$conn->close();
}
else{
    echo "Signup first";
}

?>