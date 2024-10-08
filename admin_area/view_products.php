<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-View Products</title>
    <style>
        .product_img{
            width:100px;
            object-fit:contain;
        }
    </style>
</head>
<body>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-bordered mt-5 text-center">
        <thead class="bg-info">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

        </thead>
        <tbody class="bg-secondary">
            <?php
            $get_products="Select * from products";
            $result=mysqli_query($con,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                $status=$row['status'];
                $number++;
                ?>
                <tr>
                        <td><?php echo $number;?></td>
                        <td><?php echo $product_title;?></td>
                        <td><img src='./product_images/<?php echo $product_image1;?>' class='product_img'/></td>
                        <td><?php echo $product_price;?>/-</td>
                        <td><?php 
                        $get_count="Select * from orders_pending where product_id=$product_id";
                        $result_count=mysqli_query($con,$get_count);
                        $rows_count=mysqli_num_rows($result_count);
                        echo $rows_count;
                        ?></td>
                        <td><?php echo $status;?></td>
                        <td><a href='index.php?edit_products=<?php echo $product_id?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a href='index.php?delete_products=<?php echo $product_id?>' type="button" class=" text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
                    </tr>
                <?php

            }

            ?>
          

        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="index.php?view_products" 
                    class="text-light text-decoration-none">No</a></button>
                    <button type="button" class="btn btn-primary"><a href='index.php?delete_products=<?php echo $product_id ?>' class=" text-light text-decoration-none">Yes</a></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>