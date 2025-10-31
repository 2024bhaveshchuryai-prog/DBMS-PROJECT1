
<?php
include 'db.php';

$acc = $_POST['account_no'];
$goal = $_POST['goal_name'];
$target = $_POST['target_amount'];
$date = $_POST['target_date'];

// Check account exists
$res = $conn->query("SELECT * FROM accounts WHERE account_no='$acc'");
if($res->num_rows==0){
    echo "<script>alert('Account not found');window.location='index.html';</script>";
    exit;
}

$sql = "INSERT INTO goals (account_no,goal_name,target_amount,target_date) VALUES ('$acc','$goal',$target,'$date')";
if($conn->query($sql)){
    echo "<script>alert('Goal Set Successfully');window.location='index.html';</script>";
}else{
    echo "Error: ".$conn->error;
}
$conn->close();
?>