<?php 

session_start();

if(isset($_SESSION['signup_login'])){

    $email = $_REQUEST['Email'];
    $pass = $_REQUEST['Pass'];
    
    require_once("../Database/dbconnect_connect.php");
    
    $query = "SELECT `u_id`, `u_password`, `real_name` FROM `users` WHERE email = '$email'";
    
    if($data = $conn->query($query)){
        
        if($data->num_rows <= 0){
            echo "Incorrect email";
        }
        else if($data->num_rows == 1){
            
            $result = $data->fetch_assoc();
            $dbpass = $result['u_password'];
            
            if(password_verify($pass, $dbpass)){
                
                $opt = [
                    'cost' => 12,  
                ];
                
                $id = $result['u_id'];
                $name = $result['real_name'];
                
                $url1 = base64_encode($id."&".$email."&".$name);
                $_SESSION['login_user_connect'] = $url1;
                
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