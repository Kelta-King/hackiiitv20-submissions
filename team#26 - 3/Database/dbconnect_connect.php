<?php

$servername = "localhost";
$password_db = "2001kushang"; // enter the database user's password
$username = "KeltaKing";
$database = "keltago4_chat";

$conn = new mysqli($servername, $username, $password_db, $database);

if($conn->connect_error)
{
    die("something went wrong:$conn->connect_error");
}


?>