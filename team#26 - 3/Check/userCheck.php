<?php

session_start();

if(isset($_SESSION['signup_login'])){
    
    $name = $_REQUEST['Name'];
    $email = $_REQUEST['Email'];
    $password = $_REQUEST['Pass'];
    $gender = $_REQUEST['Gender'];
    
    require_once("../Database/dbconnect_connect.php");
    
    $query = "SELECT real_name FROM users WHERE email = '$email'";
    
    if($data = $conn->query($query)){
        
        if($data->num_rows > 0){
            
            echo "This email address is already registered";
            
        }
        else if($data->num_rows == 0){
            
            //unique email address
            //color theme by default
            $opt = [
              'cost' => 12,  
            ];
            
            $password = password_hash($password, PASSWORD_BCRYPT, $opt);
			
            $query1 = "INSERT INTO users (real_name, email, u_password, gender) VALUES('$name', '$email', '$password','$gender')";
            
            if($conn->query($query1)){
                
				$_SESSION['signup_r'] = "yes";
               
            }
            else{
                echo "Something went wrong"; 
            }
            
        }
        else{
            echo "This email address is already registered";
        }
        
    }
    else{
        echo "Something went wrong";
    }
    
    $conn->close();

}
else{
    echo "Signup first";
}

?>