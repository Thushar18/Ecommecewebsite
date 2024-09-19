<!--Connect file -->
<?php
include('../includes/connect.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon-Checkout Page</title>
    <!--Bootstrap CSS Link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--Font Awesome Link-->
    <script src="https://kit.fontawesome.com/c987eccfed.js" crossorigin="anonymous"></script>
    <!--style tag-->
    <style>
        *{
            padding:0;
            margin:0;
            box-sizing:border-box; 
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
    </style>

</head>
<body>
    <!--navbar-->
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../assests/alogo.png" alt="Amazon" width="60" height="60">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Contact</a>
                        </li>
                        

                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <!--calling cart function-->
        
        <!--Second Child-->
        <nav class="navbar navbar-expand-lg bg-secondary">
            <ul class="navbar-nav me-auto text-white">
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
            <h3 class="text-center p-2">Amazon</h3>
            <p class="text-center">From A to Z, Everything You Need</p>
        </div>
        <!--fourth child-->
        <div class="row px-1">
            <div class="col-md-12">
                <!--products-->
                <div class="row">
                    <?php
                    if(!isset($_SESSION['username'])){
                        include('user_login.php');

                    }
                    else{
                        include('payment.php');
                    }
                    ?>
                    <!--fetching products-->
                   
                    
                </div>
                <!--col end-->
            </div>
            
        </div>
        <!--footer-->
       <?php include("../includes/footer.php"); ?>
    </div>
    

    <!--Bootstrap Js Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>