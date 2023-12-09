<?php
$servername="localhost";
$username="root";
$password="";
$database="test";


try {
    $conn = new
    PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //echo "connected successfuly"; 
    
} catch (PDOException $e) {
    echo "Connection failed" .$e->getMessage();
}
?>

