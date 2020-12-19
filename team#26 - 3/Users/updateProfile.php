<?php

    session_start();
	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['u_name']) && isset($_REQUEST['cur_pass']) && isset($_REQUEST['newPass']) && isset($_REQUEST['newAga'])){
		
		$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
        $id = $dts[0];
        $name = $dts[2];
        
		$u_name = test_input($_REQUEST['u_name']);
		$Pass = test_input($_REQUEST['cur_pass']);
		$new_pass = test_input($_REQUEST['newPass']);
		$new_pass_again = test_input($_REQUEST['newAga']);
		
		require_once("../Database/dbconnect_connect.php");
        
        $opt = [
			'cost' => 12
		];

       
		$query = "SELECT u_password FROM users WHERE u_id = $id";
		if($data = $conn->query($query)){
			
			if($data->num_rows<=0){
				echo "Password didn't match";
			}
			else{
				$result = $data->fetch_assoc();
					
				$dbpass = $result['u_password'];
				if(password_verify($Pass, $dbpass)){
					
					$pass = password_hash($new_pass, PASSWORD_BCRYPT, $opt);
					
					$query1 = "UPDATE users SET u_password = '$pass' WHERE u_id = $id";
					if($conn->query($query1)){
						
					}
					else{
						echo "Password didn't match";
					}
				}
				else{
					echo "Password didn't match";
				}
				
			}
			
		}
		else{
			echo "Something went wrong";
		}
		
	}
	else if(isset($_SESSION['login_user_connect'])){
		echo "Login first";
	}
	else{
		header('Location:../logout.php');
	}
	
?>