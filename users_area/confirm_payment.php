<!--Connect file -->
<?php
include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    //echo $order_id;
    $select_data="Select * from user_orders where order_id=$order_id";
    $result=mysqli_query($con,$select_data);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];
}

if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into user_payments (order_id,invoice_number,amount,payment_mode)
    values($order_id,$invoice_number,$amount,'$payment_mode')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo"<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo"<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update user_orders set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon-Payment Page</title>
    <!--bootstrap css link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" id="invoice"  value="<?php echo $invoice_number?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto text-light">
                <label for="">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" id="amount" value="<?php echo $amount_due?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>Cash on Delivery</option>
                    <option>Pay Offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto text-light">
                <input type="submit" class="btn btn-info py-2 px-3 border-0" value="Confirm" name="confirm_payment" onclick="pay_now()">
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            function pay_now(){
                var invoice=jQuery('#invoice').val();
                var amount=jQuery('#amount').val();

                jQuery.ajax({
                    type: 'post',
                    url: 'payment_process.php',
                    data: "amount="+amount+"&invoice"+invoice,

                    success: function(result){
                        var options = {
                            "key":"rzp_test_LQbcEQY9LatdC0",
                            "amount":<?= $amount_due ?>*100,
                            "currency": "INR",
                            "name":"Ecommerce Website",
                            "description": "Test Transaction",
                            "image": "https://getbest.co.in/ECOMMERCES/assests/alogo.png",

                            "handler": function(response){
                                jQuery.ajax({
                                    type: 'post',
                                    url: 'payment_process.php',
                                    data: "amount="+amount+"&invoice"+invoice,

                                    success: function(result){
                                        window.location.href="thank_you.php";

                                    }
                                });

                            }

                        }
                    }
                    



                });
                var rzp1 = new Razorpay(options);
                rzp1.open();

            }
        </script>

    </div>
       
    
 
</body>
</html>