<!--Connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon-Cart Details</title>
    <!--Bootstrap CSS Link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--Font Awesome Link-->
    <script src="https://kit.fontawesome.com/c987eccfed.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Hedvig+Letters+Serif:opsz@12..24&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Mukta:wght@200;300;400;500;600;700;800&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Protest+Riot&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!--style tag-->
    <style>
        *{
            padding:0;
            margin:0;
            box-sizing:border-box; 
        }
        body{
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            font-style: normal;
            overflow-x:hidden;
        }
        .card-img-top{
            width:100%;
            height:200px;
            object-fit: contain;
        }
        .nav-link,.active{
            color:white;
        }
        .cart_img{
            width:80px;
            height:80px;
            object-fit:contain;
        }
        .navbar-nav .nav-item .nav-link:hover{
            color: #f54c40;
        }
        .container{
            margin-bottom:200px;
        }
    </style>

</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="assests/alogo.png" alt="Amazon" width="60" height="60">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon bg-white"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!--calling cart function-->
        <?php
        cart();
        ?>
        <!--Second Child-->
        <nav class="navbar navbar-expand-lg bg-secondary">
            <ul class="navbar-nav me-auto text-white">
                <?php
                if(!isset($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a></li>";
                     
                }else{
                    echo "<li class='nav-item'>
                    <a class='nav-link text-white' href='#'>Welcome ".$_SESSION['username']."</a></li>";
                }
                if(!isset($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link text-white' href='./users_area/user_login.php'>Login</a></li>";
                     
                }else{
                    echo "<li class='nav-item'>
                    <a class='nav-link text-white' href='./users_area/logout.php'>Logout</a></li>";
                }
                ?>

            </ul>

        </nav>
        <!--third child -->
        <div class="bg-light">
            <h3 class="text-center">Amazon</h3>
            <p class="text-center">From A to Z, Everything You Need</p>
        </div>
        <!--fourth child table-->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                <table class="table table-bordered text-center">
                    
                        <!-- php code to display dynamic data -->
                        <?php
                            $get_ip_add = getIPAddress();
                            $total_price=0;
                            $cart_query = "Select * from cart_details where ip_address='$get_ip_add'";
                            $result = mysqli_query($con,$cart_query);
                            $result_count=mysqli_num_rows($result);
                            if($result_count>0){
                                echo" <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'>Operations</th>
                                </tr>
                            </thead>
                            <tbody>";

                            while($row=mysqli_fetch_array($result)){
                                $product_id=$row['product_id'];
                                $select_products="Select * from products where product_id='$product_id'";
                                $result_products = mysqli_query($con,$select_products);
                                while($row_product_price=mysqli_fetch_array($result_products)){
                                    $product_price=array($row_product_price['product_price']);
                                    $price_table=$row_product_price['product_price'];
                                    $product_title=$row_product_price['product_title'];
                                    $product_image1=$row_product_price['product_image1'];
                                    $product_values=array_sum($product_price);
                                    $total_price+=$product_values;
                        
                        

                        ?>
                        <tr>
                            <td><?php echo $product_title ?></td>
                            <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" class="cart_img" alt=""></td>
                            <td><input type="text" name="qty" class="form-input w-50"></td>
                            <?php
                            $get_ip_add = getIPAddress();
                            if(isset($_POST['update_cart'])){
                                $quantities=$_POST['qty'];
                                $update_cart="update cart_details set quantity=$quantities where ip_address='$get_ip_add'";
                                $result_products_quantity = mysqli_query($con,$update_cart);
                                $total_price=$total_price*$quantities;
                            }


                            ?>
                            <td><?php echo $price_table ?>/-</td>
                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                            <td>
                                <!--<button class="bg-info px-3 py-2 border-0 mx-3">Update</button>-->
                                <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                                <!--<button class="bg-info px-3 py-2 border-0 mx-3">Remove</button>-->
                                <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">

                            </td>

                        </tr>
                        <?php
                        }
                    }
                    }else{
                        echo"<h2 class='text-center text-danger'>Cart is empty</h2>";
                    }
                    ?>
                    </tbody>
                </table>
                <!--subtotal-->
                <div class="d-flex mb-5">
                    <?php
                    $get_ip_add = getIPAddress();
                    $cart_query = "Select * from cart_details where ip_address='$get_ip_add'";
                    $result = mysqli_query($con,$cart_query);
                    $result_count=mysqli_num_rows($result);
                    if($result_count>0){
                        echo"<h4 class='px-3'>Subtotal:<strong class='text-success'> $total_price/-</strong></h4>
                        <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                        <button class='bg-secondary px-3 py-2 border-0 '><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
                    }else{
                        echo"<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
                    }
                    if(isset($_POST['continue_shopping'])){
                        echo "<script>window.open('index.php','_self')</script>";
                    }


                    ?>
                    

                </div>
            </div>
        </div>
        </form>
        <!--function to remove item -->
        <?php
        function remove_cart_item(){
            global $con;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['removeitem'] as $remove_id){
                    echo $remove_id;
                    $delete_query="Delete from cart_details where product_id=$remove_id";
                    $run_delete=mysqli_query($con,$delete_query);
                    if($run_delete){
                        echo"<script>window.open('cart.php','_self')</script>";
                    }

                }
            }
        }
        echo $remove_item=remove_cart_item();

        ?>
        
        <!--footer-->
        <?php include("./includes/footer.php"); ?>
    
       
    </div>
    

    <!--Bootstrap Js Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>