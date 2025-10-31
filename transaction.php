
<?php
include 'db.php';

$acc = $_POST['account_no'];
$amount = $_POST['amount'];
$type = $_POST['type'];
$to_acc = $_POST['to_account'];

// Check account exists
$result = $conn->query("SELECT balance FROM accounts WHERE account_no='$acc'");
if($result->num_rows == 0){
    echo "<script>alert('Account not found');window.location='index.html';</script>";
    exit;
}
$row = $result->fetch_assoc();
$balance = $row['balance'];

if($type=="Withdraw"){
    if($balance < $amount){
        echo "<script>alert('Insufficient Balance');window.location='index.html';</script>";
        exit;
    }
    $conn->query("UPDATE accounts SET balance=balance-$amount WHERE account_no='$acc'");
    $conn->query("INSERT INTO transactions (account_no,type,amount) VALUES ('$acc','$type',$amount)");
    echo "<script>alert('Withdraw Successful');window.location='index.html';</script>";
}
elseif($type=="Deposit"){
    $conn->query("UPDATE accounts SET balance=balance+$amount WHERE account_no='$acc'");
    $conn->query("INSERT INTO transactions (account_no,type,amount) VALUES ('$acc','$type',$amount)");
    echo "<script>alert('Deposit Successful');window.location='index.html';</script>";
}
elseif($type=="Transfer"){
    if($balance < $amount){
        echo "<script>alert('Insufficient Balance');window.location='index.html';</script>";
        exit;
    }
    // Check receiver account
    $res = $conn->query("SELECT balance FROM accounts WHERE account_no='$to_acc'");
    if($res->num_rows==0){
        echo "<script>alert('Receiver Account not found');window.location='index.html';</script>";
        exit;
    }
    $conn->query("UPDATE accounts SET balance=balance-$amount WHERE account_no='$acc'");
    $conn->query("UPDATE accounts SET balance=balance+$amount WHERE account_no='$to_acc'");
    $conn->query("INSERT INTO transactions (account_no,type,amount) VALUES ('$acc','Transfer Sent',$amount)");
    $conn->query("INSERT INTO transactions (account_no,type,amount) VALUES ('$to_acc','Transfer Received',$amount)");
    echo "<script>alert('Transfer Successful');window.location='index.html';</script>";
}
$conn->close();
?>
