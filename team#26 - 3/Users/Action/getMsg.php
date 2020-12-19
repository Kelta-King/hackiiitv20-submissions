<?php

session_start();

function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['room_id'])){
    
    require_once("../../Database/dbconnect_connect.php");
	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $name = $dts[2];
    
    $room_id = $_REQUEST['room_id'];
    
	$encryQry = "SELECT * FROM `keysencry` ";
	
	$key_id = "";
	$ciphiring = "";
	$iv = "";
	$enc_key = "";
	
	if($da = $conn->query($encryQry)){
		
		$rslt = $da->fetch_assoc();
		$key_id = $rslt['key_id'];
		$ciphiring = $rslt['ciphiring'];
		$iv = $rslt['iv'];
		$enc_key = $rslt['enc_key'];
		
	}
	else{
		die("Error happen");
	}
	$options = 0; 
	
    $query = "SELECT chat_msg, time, sender_id FROM chats WHERE room_id = $room_id ORDER BY time";
    
    if($data = $conn->query($query)){
        
        if($data->num_rows == 0){
            //This user dosen't actually exist in this club
            die("<div class='w3-center'>-</div>");
        }
        
        while($result = $data->fetch_assoc()){
            
			$msg = $result['chat_msg'];
			$msg = openssl_decrypt($msg, $ciphiring, $enc_key, $options, $iv); 
            $time = $result['time'];
            $u_msg_id = $result['sender_id'];
            
            $qry = "SELECT real_name FROM users WHERE u_id = $u_msg_id";
            $u_name = "Someone";
            if($d = $conn->query($qry)){
                
                $rslt = $d->fetch_assoc();
                $u_name = $rslt['real_name'];
                
            }
            
            if($result['sender_id'] == $id){
                
                $message = "<div class='w3-bar'>";
                $message .= "<div class='w3-bar-item w3-border w3-round w3-margin-top w3-margin-left w3-blue w3-right' style='max-width:80%;'>";
                $message .= $msg;
                $message .= "<div class='w3-small'>$time</div>";
                $message .= "</div></div>";
                
                echo $message;
                
            } 
            else{
                
                $message = "<div class='w3-bar'>";
                $message .= "<div class='w3-bar-item w3-border w3-round w3-margin-top w3-margin-left w3-white w3-left' style='max-width:80%;'>";
                $message .= $msg;
                $message .= "<div class='w3-small'>$u_name $time</div>";
                $message .= "</div></div>";
                
                echo $message;
                
            }
            
        
        }
    }
    else{
        die("not2");
    }
    
    
}
else if(isset($_SESSION['login_user_connect'])){
    echo "Please, login first";
}
else{
    header("Location:../../logout");   
}
    
?>