
<?php
include 'db.php';

$acc = $_POST['account_no'];
$type = $_POST['loan_type'];
$amount = $_POST['amount'];

// Check account exists
$res = $conn->query("SELECT * FROM accounts WHERE account_no='$acc'");
if($res->num_rows==0){
    echo "<script>alert('Account not found');window.location='index.html';</script>";
    exit;
}

$sql = "INSERT INTO loans (account_no,loan_type,amount) VALUES ('$acc','$type',$amount)";
if($conn->query($sql)){
    echo "<script>alert('Loan Applied Successfully');window.location='index.html';</script>";
}else{
    echo "Error: ".$conn->error;
}
$conn->close();
?>