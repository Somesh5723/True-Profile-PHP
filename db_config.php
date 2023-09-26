<?php
// Replace with your actual database credentials
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'true_profile';

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
