<?php

session_start();

function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_SESSION['login_user_connect']) && isset($_REQUEST['msg']) && isset($_REQUEST['room_id']) && isset($_REQUEST['u_id'])){
    
    require_once("../../Database/dbconnect_connect.php");
	$dts = explode("&",base64_decode($_SESSION['login_user_connect']));
    $id = $dts[0];
    $name = $dts[2];
        
    $room_id = $_REQUEST['room_id'];
    $msg = $_REQUEST['msg'];
    $u_id = $_REQUEST['u_id'];
    
    if($id != $u_id){
        die("Not done");
    }
    
    $msgd = $msg;
	
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
		
	$msg = openssl_encrypt($msg, $ciphiring, $enc_key, $options, $iv); 
	
    $time = date('d-m-y h:i:s');
    
    $query = "INSERT INTO chats (chat_msg, sender_id, room_id) VALUES ('$msg', $u_id, $room_id )";
    
    if($conn->query($query)){
        
        $message = "<div class='w3-bar'>";
        $message .= "<div class='w3-bar-item w3-border w3-round w3-margin-top w3-margin-left w3-blue w3-right' style='max-width:80%;'>";
        $message .= $msgd;
        $message .= "<div class='w3-small'>$time</div>";
        $message .= "</div></div>";
        
        echo $message;
        
    }
    else{
        echo "Something went wrong";
    }
    
}
else if(isset($_SESSION['login_user_connect'])){
    echo "Please, login first";
}
else{
    header("Location:../../logout");   
}
    
?>