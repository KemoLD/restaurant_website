<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kemo's restaurant - Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/kemo-logo.png"/>
    </head>

    <body>

        <?php include('components/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">

                <h1>Manage Food</h1>
                <br><br>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>
                <br><br>

                <a href="<?php echo SITE_URL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>Serial Number</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_food";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res); //count rows

                        if($res == TRUE){
                            
                            $sn=1;
                            if($count > 0){

                                while($rows=mysqli_fetch_assoc($res)){
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $price = $rows['price'];
                                    $image_name = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];

                                    ?>

                                    <tr>
                                        <td> <?php echo $sn++; ?> </td>
                                        <td> <?php echo $title; ?> </td>
                                        <td> <?php echo $price; ?> </td>
                                        <td> 
                                            <?php 
                                                if($image_name != ""){     
                                                    ?>

                                                    <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                                                    <?php
                                                }
                                                else{
                                                    echo "<div class='error'>Image not added</div>";
                                                }
                                            ?> 
                                        </td>
                                        <td> <?php echo $featured; ?> </td>
                                        <td> <?php echo $active; ?> </td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITE_URL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-warning">Delete Food</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else{

                                ?>

                                <tr>
                                    <td colspan="7"><div class="error">No Food Added</div></td>;
                                </tr>

                                <?php
                            }
                        }


                    ?>

                </table>

            </div>
        </div>

        <?php include('components/footer.php'); ?>
        
    </body>
</html>