<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Kemo's restaurant- Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/kemo-logo.png"/>
    </head>
    
    <body>

        <?php include('components/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">

                <h1> Update Admin</h1>
                <br><br>

                <?php 

                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
                        $res = mysqli_query($conn, $sql);

                        if($res == true){
                            $count = mysqli_num_rows($res);
                            if($count == 1){
                                $row = mysqli_fetch_assoc($res);
                                $full_name = $row['full_name'];
                                $username = $row['username'];

                            }
                            else{
                                $_SESSION['update'] = "<div class='error'>Admin not found</div>";
                                header('location:'.SITE_URL.'admin/manage-admin.php');
                            }
                        }
                    }else{
                        header('location:'.SITE_URL.'admin/manage-admin.php');
                    }
                ?>
                <br><br>

                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name:</td>
                            <td><input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="Enter Name" required></td>
                        </tr>

                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter Username" required></td>
                        </tr>


                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];
                $id = $_POST['id']; 

                //SQL query to save data
                $sql = "UPDATE tbl_admin SET 
                    full_name = '$full_name',
                    username = '$username'
                    WHERE id='$id'
                ";

                //executes query and saves data into database
                $res = mysqli_query($conn, $sql);

                if($res==TRUE){
                    $_SESSION['update'] = "<div class='success'>Admin updated succesfully</div>";
                    header("location:".SITE_URL.'admin/manage-admin.php') ; //redirect page
                }else{
                    $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
                    header("location:".SITE_URL.'admin/manage-admin.php');  //redirect page
                }
            }

        ?>

    </body>

</html>