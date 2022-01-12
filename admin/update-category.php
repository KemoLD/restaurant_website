<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Kemo's restaurant- Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>

        <?php include('components/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">

                <h1> Update Category</h1>
                <br><br>

                <?php 

                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM tbl_category WHERE id=$id";
                        $res = mysqli_query($conn, $sql);

                        if($res == true){
                            $count = mysqli_num_rows($res);
                            if($count == 1){
                                $row = mysqli_fetch_assoc($res);
                                $title = $row['title'];
                                $current_image = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                            }
                            else{
                                $_SESSION['update'] = "<div class='error'>Category not found</div>";
                                header('location:'.SITE_URL.'admin/manage-category.php');
                            }
                        }
                    }else{
                        header('location:'.SITE_URL.'admin/manage-category.php');
                    }
                ?>
                <?php 
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>
                <br><br>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" value="<?php echo $title; ?>" placeholder="Enter Title" required></td>
                        </tr>

                        <tr>
                            <td>Current Image:</td>
                            <td>
                                <?php
                                if($current_image != ""){
                                    ?>

                                    <img src="<?php echo SITE_URL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                    <?php
                                }else{
                                    echo "<div class='error'>Image not Added<div>";
                                }
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>New Image:</td>
                            <td><input type="file" name="image"></td>
                        </tr>

                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input <?php if($featured == "Yes"){echo "checked"; }  ?> type="radio" name="featured" value="Yes">Yes
                                <input <?php if($featured == "No"){echo "checked"; }  ?> type="radio" name="featured" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td>Active:</td>
                            <td>
                                <input <?php if($active == "Yes"){echo "checked";}  ?> type="radio" name="active" value="Yes">Yes
                                <input <?php if($active == "No"){echo "checked";}  ?> type="radio" name="active" value="No">No
                            </td>
                        </tr>


                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="submit" name="submit" value="Save changes" class="btn-secondary">
                            </td>                          
                        </tr>

                    </table>
                </form>

            </div>  
        </div>

        <?php include('components/footer.php'); ?>

        <?php  //saves data into database

            if(isset($_POST['submit'])){ //button clicked
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $id = $_POST['id']; 

                if(isset($_FILES['image']['name']) ){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $ext = end(explode('.', $image_name));//rename files to stop overwriting of same name files
                        $image_name = "Food_Category_".$title.'_'.rand(000,999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload == false){
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header("location:".SITE_URL.'admin/update-category.php') ; //redirect page
                            die(); //stop the process from insertig data into database
                        }

                        if($current_image != ""){  //delete curent image
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            if($remove == false){
                                $_SESSION['delete'] = "<div class='error'>Failed to delete category image</div>";
                                header('location:'.SITE_URL.'admin/manage-categories.php');
                                die();
                            }
                        }

                    }else{
                        $image_name = $current_image;
                    }
                }else{
                    $image_name = $current_image;
                }
                
                //SQL query to save data
                $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //executes query and saves data into database
                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE){
                    $_SESSION['update'] = "<div class='success'>Category updated succesfully</div>";
                    header("location:".SITE_URL.'admin/manage-categories.php') ; //redirect page
                }else{
                    $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                    header("location:".SITE_URL.'admin/manage-categories.php');  //redirect page
                }
            }

        ?>

    </body>

</html>