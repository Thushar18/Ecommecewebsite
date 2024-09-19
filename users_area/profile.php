<!--Connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon-Welcome <?php echo $_SESSION['username']?></title>
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
        .navbar-nav .nav-item .nav-link:hover{
            color: #f54c40;
        }
        .profile_img{
            width:90%;
            margin:auto;
            display:block;
            object-fit:contain;
            
        }
        .edit_image{
            width:100px;
            height:100px;
            object-fit:contain;

        }
    </style>

</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../assests/alogo.png" alt="Amazon" width="60" height="60">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon bg-white"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:<?php total_cart_price();?>/-</a>
                        </li>

                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
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
        <!--fourth child-->
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary" style="height:100vh;">
                    <li class="nav-item bg-dark text-center">
                        <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
                    </li>
                    <?php
                    $username=$_SESSION['username'];
                    $user_image="Select * from user_table where username='$username'";
                    $user_image=mysqli_query($con,$user_image);
                    $row_image=mysqli_fetch_array($user_image);
                    $user_image=$row_image['user_image'];
                    echo "<li class='nav-item'>
                    <img src='./user_images/$user_image' class='profile_img my-4' alt=''>
                </li>";

                    ?>
                    <li class="nav-item bg-secondary text-center">
                        <a class="nav-link text-light" href="profile.php">Pending Orders</a>
                    </li>
                    <li class="nav-item bg-secondary text-center">
                        <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
                    </li>
                    <li class="nav-item bg-secondary text-center">
                        <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
                    </li>
                    <li class="nav-item bg-secondary text-center">
                        <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
                    </li>
                    <li class="nav-item bg-secondary text-center">
                        <a class="nav-link text-light" href="logout.php">Logout</a>
                    </li>

                    
                </ul>

            </div>
            <div class="col-md-10 text-center">
                <?php
                get_user_order_details();
                if(isset($_GET['edit_account'])){
                    include('edit_account.php');
                }
                if(isset($_GET['my_orders'])){
                    include('user_orders.php');
                }
                if(isset($_GET['delete_account'])){
                    include('delete_account.php');
                }
                ?>

            </div>
        </div>

    
    <!--footer-->
    <?php include("../includes/footer.php"); ?>
    </div>
    

    <!--Bootstrap Js Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>