<?php
include 'dbconfig.php'; // Adjust this to your database config file

$message = $_POST['message'];
$name = $_POST['name'];
$sub = $_POST['sub'];
$surname = $_POST['surname'];

// Server-side validation
if (strlen($name) > 50 || strlen($surname) > 50 || strlen($sub) > 100 || strlen($message) > 1500) {
    // Handle validation error
    echo "ZADUŻO!.";
    exit;
}
if (strlen($name) ==0  || strlen($surname) == 0 || strlen($sub) == 0 || strlen($message) == 0) {
    // Handle validation error
    echo "Wpisz coś, proszę cie";
    exit;
}

// Inserting data into the database
$query = "INSERT INTO form_submissions (name, surname, sub, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $name, $surname, $sub, $message);
$stmt->execute();

$stmt->close();
$conn->close();

echo "success"; // Indicate success
?>
