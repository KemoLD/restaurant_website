<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Kemo's restaurant- Admin </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>

        <?php include('components/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">

                <h1>Change Password</h1>
                <br><br>

                <?php 
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sql3 = "SELECT * FROM tbl_admin WHERE id=$id";
                        $res3 = mysqli_query($conn, $sql3);

                        if($res3 == true){
                            $count3 = mysqli_num_rows($res3);
                            if($count3 != 1){
                                $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                                header('location:'.SITE_URL.'admin/manage-admin.php');
                            }
                        }

                    }
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['wrong-pwd'])){
                        echo $_SESSION['wrong-pwd'];
                        unset($_SESSION['wrong-pwd']);
                    }
                ?>
                <br>

                <form action="" method="POST">

                    <table class="tbl-30">
                        <tr>
                            <td>Current Password:</td>
                            <td><input type="password" name="current_password" placeholder="Current Password" required></td>
                        </tr>
                        <tr>
                            <td>New Password:</td>
                            <td><input type="password" name="new_password" placeholder="New Password" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password:</td>
                            <td><input type="password" name="confirm_password" placeholder="Confirm Password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Save Changes" class="btn-secondary">
                            </td>                          
                        </tr>

                    </table>    

                </form>

                
            </div>
        </div>

        <?php include('components/footer.php'); ?>

        <?php  //saves data into database

            if(isset($_POST['submit'])){ //button clicked
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']); //encrypts password with MD5
                $new_password = md5($_POST['new_password']); //encrypts password with MD5
                $confirm_password = md5($_POST['confirm_password']); //encrypts password with MD5

                //SQL query to save data
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //executes query and saves data into database
                $res = mysqli_query($conn, $sql);

                if($res==TRUE){
                    
                    $count = mysqli_num_rows($res);
                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);

                        if($new_password == $confirm_password){

                            $sql2 = "UPDATE tbl_admin SET
                                password = '$new_password'
                                WHERE id=$id
                            ";  
                            $res2 = mysqli_query($conn, $sql2);

                            if($res2 == TRUE){
                                $_SESSION['pwd-change'] = "<div class='success'>Password changed succesfully</div>";
                                header("location:".SITE_URL.'admin/manage-admin.php') ; //redirect page
                            }
                            else{
                                $_SESSION['pwd-change'] = "<div class='error'>Failed changing password</div>";
                                header("location:".SITE_URL.'admin/manage-admin.php') ; //redirect page
                            }

                        }else{
                            $_SESSION['pwd-not-match'] = "<div class='error'>New passwords do not match</div>";
                            header("location:".SITE_URL.'admin/update-password.php') ; //redirect page
                        }             

                    }
                    else{
                        $_SESSION['wrong-pwd'] = "<div class='error'>Current password is incorrect</div>";
                        header("location:".SITE_URL.'admin/update-password.php');  //redirect page
                    }

                }
            }

        ?>

    </body>

</html>