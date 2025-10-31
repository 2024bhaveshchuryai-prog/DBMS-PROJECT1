<?php
// db.php - Connect to MySQL
$conn = new mysqli("localhost", "root", "", "bank_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
