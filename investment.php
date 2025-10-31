
<<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_db_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$sql = "SELECT * FROM investments";
$result = $conn->query($sql);

$investments = array();
while($row = $result->fetch_assoc()) {
    $investments[] = $row;
}

echo json_encode($investments);
$conn->close();
?>