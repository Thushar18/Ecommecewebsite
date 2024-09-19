<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon-Admin Registration</title>
    <!--Bootsrtap Link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--Font Awesome Link-->
    <script src="https://kit.fontawesome.com/c987eccfed.js" crossorigin="anonymous"></script>
    <style>
        
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../assests/registration.jpg" alt="Admin Registartion" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your Username" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your Email" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="admin_image" class="form-label">Admin Image</label>
                        <input type="file" id="user_image" class="form-control"required="required" name="admin_image">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your Password" required="required"
                        class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_register" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Do you have an account?<a href="admin_login.php" class="text-danger"> Login</a></p>
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
if(isset($_POST['admin_register'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $admin_image=$_FILES['admin_image']['name'];
    $admin_image_tmp=$_FILES['admin_image']['tmp_name'];
    $password=$_POST['password'];
    $hash_password=password_hash($password,PASSWORD_DEFAULT);
    $confirm_password=$_POST['confirm_password'];
    
    

    //select query
    $select_query="Select * from admin_table where admin_name='$username' or admin_email='$email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo"<script>alert('Username and Email are already exists')</script>";
    }elseif($password!=$confirm_password){
        echo"<script>alert('Passwords do not match')</script>";
    }
    else{
        //insert query
        move_uploaded_file($admin_image_tmp,"./product_images/$admin_image");
        $insert_query="insert into admin_table (admin_name,admin_email,admin_image,admin_password) 
        values('$username','$email','$admin_image','$hash_password')";
        $result_query=mysqli_query($con,$insert_query);
    }
}
?>