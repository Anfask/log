<?php
$servername = "ubuntu@ec2-3-95-230-147.compute-1.amazonaws.com";
$username = "root";
$password = "admin123";
$dbname = "windows";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
?>
