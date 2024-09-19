<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--bootstrap css link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--Font Awesome Link-->
    <script src="https://kit.fontawesome.com/c987eccfed.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Hedvig+Letters+Serif:opsz@12..24&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Mukta:wght@200;300;400;500;600;700;800&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Protest+Riot&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- style tag-->
    <style>
        .admin_image{
            width:100px;
            object-fit:contain;
        }
        body{
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            font-style: normal;
            overflow-x:hidden;
        }
        .footer{
            position:absolute;
            bottom:0;
        }
        
    </style>
</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <img src="../assests/alogo.png" width="60" height="60">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                    <?php
                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link text-white' href='#'>Welcome Guest</a></li>";
                    }else{
                        echo "<li class='nav-item'>
                        <a class='nav-link text-white' href='#'>Welcome ".$_SESSION['username']."</a></li>";
                    }
                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link text-white' href='admin_login.php'>Login</a></li>";
                         
                    }else{
                        echo "<li class='nav-item'>
                        <a class='nav-link text-white' href='logout.php'>Logout</a></li>";
                    }
                    ?>
                    </ul>
                </nav>
            </div>
        </nav>
        <!--second child-->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!--third child-->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <?php
                    $username = $_SESSION['username'];
                    $admin_image_query = "SELECT * FROM admin_table WHERE admin_name = '$username'";
                    $admin_image_result = mysqli_query($con, $admin_image_query);
                    
                    if ($admin_image_result && mysqli_num_rows($admin_image_result) > 0) {
                        $row_image = mysqli_fetch_assoc($admin_image_result);
                        $admin_image = $row_image['admin_image'];
                        echo "<a href='#'><img src='./product_images/$admin_image' alt='' class='admin_image'></a>";
                        echo "<p class='text-light text-center'>" . $row_image['admin_name'] . "</p>";
                    } else {
                        echo "Admin not found.";
                    }
                    

                    ?>
                </div>
                <div class="button text-center me-2">
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-dark my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-dark my-1">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-dark my-1">Insert Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light bg-dark my-1">View Categories</a></button>
                    <button><a href="index.php?insert_brand" class="nav-link text-light bg-dark my-1">Insert Brands</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light bg-dark my-1">View Brands</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-dark my-1">All Orders</a></button>
                    <button><a href="index.php?list_payments" class="nav-link text-light bg-dark my-1">All Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-dark my-1">List Users</a></button>
                    <button><a href="index.php?logout" class="nav-link text-light bg-dark my-1">Logout</a></button>
                </div>
            </div>
        </div>
        <!--fourth child-->
        <div class="container my-3">
            <?php 
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if(isset($_GET['delete_products'])){
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])){
                include('view_brands.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['edit_brands'])){
                include('edit_brands.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['delete_brands'])){
                include('delete_brands.php');
            }
            if(isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if(isset($_GET['delete_orders'])){
                include('delete_orders.php');
            }
            if(isset($_GET['list_payments'])){
                include('list_payments.php');
            }
            if(isset($_GET['delete_payments'])){
                include('delete_payments.php');
            }
            if(isset($_GET['list_users'])){
                include('list_users.php');
            }
            if(isset($_GET['delete_users'])){
                include('delete_users.php');
            }
            if(isset($_GET['logout'])){
                include('logout.php');
            }
            ?>
        </div>

        <!--<div class="bg-dark p-3 text-center text-white footer">
            <p>Copyright ©2024 All Rights Reserved - Designed by Thushar</p> 
        </div>-->
        <?php include("../includes/footer.php"); ?>
    </div>



    <!--bootstrap js link--> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>