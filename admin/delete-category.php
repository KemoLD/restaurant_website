<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])){

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        if($image_name != ""){
            $path = "../images/category/".$image_name;
            $remove = unlink($path); //delete image
            if($remove == false){
                $_SESSION['delete'] = "<div class='error'>Failed to delete category image</div>";
                header('location:'.SITE_URL.'admin/manage-categories.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['delete'] = "<div class='success'>Category deleted succesfully</div>";
            header('location:'.SITE_URL.'admin/manage-categories.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
            header('location:'.SITE_URL.'admin/manage-categories.php');
        }
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to find category</div>";
        header('location:'.SITE_URL.'admin/manage-categories.php');
    }


?>