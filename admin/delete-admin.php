<?php

    include('../config/constants.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_admin WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['delete'] = "<div class='success'>Admin deleted succesfully</div>";
            header('location:'.SITE_URL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
            header('location:'.SITE_URL.'admin/manage-admin.php');
        }
    }else{
        header('location:'.SITE_URL.'admin/manage-admin.php');
    }


?>