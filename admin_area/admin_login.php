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
    <title>Amazon-Admin Login</title>
    <!--Bootsrtap Link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--Font Awesome Link-->
    <script src="https://kit.fontawesome.com/c987eccfed.js" crossorigin="anonymous"></script>
    <style>
        body{
            overflow:hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../assests/login.avif" alt="Admin Registartion" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your Username" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" required="required"
                        class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't you have an account?<a href="admin_registration.php" class="text-danger"> Register</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>




    <!--Bootstrap Js Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if(isset($_POST['admin_login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    
    $select_query="Select * from admin_table where admin_name='$username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);

    if($row_count>0){
        $_SESSION['username']=$username;
        if(password_verify($password,$row_data['admin_password'])){
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }else{
            echo "<script>alert('Invalid Credentials')</script>";
        }


    }else{
        echo "<script>alert('Invalid Credentials')</script>";

    }



}
?>