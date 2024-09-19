<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .user_img{
            width:100px;
            object-fit:contain;
        }
    </style>
</head>
<body>
<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5 text-center">
    <thead>
        <?php
        $get_payments="Select * from user_table";
        $result=mysqli_query($con,$get_payments);
        $row_count=mysqli_num_rows($result);
        
    if($row_count==0){
        echo "<h2 class='text-danger text-center mt-5'>No Users yet</h2>";
    }else{
        echo "  <tr>
                    <th>Sl no</th>
                    <th>Username</th>
                    <th>User email</th>
                    <th>User Image</th>
                    <th>User address</th>
                    <th>User mobile</th>
                    <th>Delete</th>
                </tr>
    </thead>
    <tbody>";
        $number=0;
        while($row_data=mysqli_fetch_assoc($result)){
            $user_id=$row_data['user_id'];
            $username=$row_data['username'];
            $user_email=$row_data['user_email'];
            $user_image=$row_data['user_image'];
            $user_address=$row_data['user_address'];
            $user_mobile=$row_data['user_mobile'];
            $number++;
            ?>
            <tr>
            <td><?php echo $number;?></td>
            <td><?php echo $username;?></td>
            <td><?php echo $user_email;?></td>
            <td><img src="../users_area/user_images/<?php echo $user_image;?>" alt="$username" class="user_img"></td>
            <td><?php echo $user_address;?></td>
            <td><?php echo $user_mobile;?></td>
            <td><a href='index.php?delete_users=<?php echo $user_id ?>' type="button" class=" text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
        </tr>
        <?php

        }
    }

        ?>
        
       
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="index.php?list_users" 
        class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_users=<?php echo $user_id ?>' class=" text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>
    
</body>
</html>
