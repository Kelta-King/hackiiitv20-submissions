<?php

session_start();

if(isset($_SESSION['signup_r']) && isset($_SESSION['signup_login'])){

    unset($_SESSION['signup_login']);
    unset($_SESSION['signup_r']);
    
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    
    require_once("Database/dbconnect_connect.php");
    
    $query = "SELECT `u_id`, `u_password`, `real_name` FROM `users` WHERE email = '$email'";
    
    if($data = $conn->query($query)){
        
        if($data->num_rows == 1){
            
			$result = $data->fetch_assoc();
            $id = $result['u_id'];
            $name = $result['real_name'];
            $url = base64_encode($id."&".$name);
            
            $url1 = base64_encode($id."&".$email."&".$name);
            $_SESSION['login_user_connect'] = $url1;
            header("Location:Users/profile.php?name=".$url);
            
            
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