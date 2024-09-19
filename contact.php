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
    <title>Amazon-Contact Us</title>
     <!--Bootstrap CSS Link-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--Font Awesome Link-->
    <script src="https://kit.fontawesome.com/c987eccfed.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Hedvig+Letters+Serif:opsz@12..24&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Mukta:wght@200;300;400;500;600;700;800&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Protest+Riot&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <style>
        .img-fluid{
            height:440px;
        }
        body{
            font-family: "Roboto", sans-serif;
            font-weight: 300;
            font-style: normal;
            overflow-x:hidden;
        }
        
    </style>
</head>
<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand mb-2" href="#">
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
                            <a class="nav-link text-white" href="display_all.php">Products</a>
                        </li>
                        <?php
                        if(isset($_SESSION['username'])){
                            echo "<li class='nav-item'>
                            <a class='nav-link text-white' href='./users_area/profile.php'>My Account</a></li>";
                        }
                        else{
                            echo "<li class='nav-item'>
                            <a class='nav-link' href='./users_area/user_registration.php'>Register</a></li>";

                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Total Price:<?php total_cart_price();?>/-</a>
                        </li>

                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
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
        <div class="container-fluid">
            <img src="assests/banner.gif" style="width: 100%;">
       </div>
       <!--third child -->
       <div class="container-fluid m-3">
        <h2 class="text-center mb-5 text-success">Contact Us</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="assests/contact.avif" alt="Admin Registartion" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your Name" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your Email" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" id="mobile" name="mobile" placeholder="Enter your Mobile Number" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="query" class="form-label">Query</label>
                        <textarea class="form-control" rows="5" id="comment" name="text" placeholder="Enter your Query"></textarea>
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" value="Submit">
                    </div>
                </form>
            </div>

        </div>
        
       </div>
       <?php include("./includes/footer.php"); ?>
    </div>


    
</body>
</html>