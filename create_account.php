
<?php
include 'db.php';

$name = $_POST['name'];
$acc = $_POST['account_no'];

$sql = "INSERT INTO accounts (name, account_no, balance) VALUES ('$name','$acc',0)";
if($conn->query($sql)){
    echo "<script>alert('Account Created!');window.location='index.html';</script>";
} else {
    echo "Error: ".$conn->error;
}
$conn->close();
?>
