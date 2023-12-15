<?php
$host = 'localhost'; // Host name
$username = 'root'; // Mysql username
$password = ''; // Mysql password (default is empty for XAMPP)
$db_name = 'web-site'; // Database name

// Create a MySQL connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
