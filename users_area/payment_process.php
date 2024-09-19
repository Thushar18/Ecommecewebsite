<?php
include('../includes/connect.php');
session_start();

if(isset($_POST['amount']) && isset($_POST['invoice'])){
    $amount=$_POST['amount'];
    $invoice=$_POST['invoice'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');

    mysqli_query($con, "insert into payment (invoice,amount,payment_status,added_on)
    values('$invoice','$amount','$payment_status','$added_on')");

    $_SESSION['OID'] = mysqli_insert_id($con);
}
if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id = $_POST['payment_id'];

    mysqli_query($con, "update payment set 
    payment_status='complete', payment_id='$payment_id' where 
    id = '". $_SESSION['OID']."'")
}

?>