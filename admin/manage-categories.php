<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kemo's restaurant - Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <?php include('components/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                
                <h1>Manage Categories</h1>
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

                <a href="<?php echo SITE_URL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res); //count rows

                        if($res == TRUE){
                            
                            $sn=1;
                            if($count > 0){

                                while($rows=mysqli_fetch_assoc($res)){
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $image_name = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];

                                    ?>

                                    <tr>
                                        <td> <?php echo $sn++; ?> </td>
                                        <td> <?php echo $title; ?> </td>
                                        <td> 
                                            <?php 
                                                if($image_name != ""){     
                                                    ?>

                                                    <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>" width="100px">

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
                                            <a href="<?php echo SITE_URL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITE_URL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-warning">Delete Category</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else{

                                ?>

                                <tr>
                                    <td colspan="6"><div class="error">No Categories Added</div></td>;
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