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

                <h1> Add admin</h1>
                <br><br>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                ?>
                <br>

                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name:</td>
                            <td><input type="text" name="full_name" placeholder="Enter Name" required></td>
                        </tr>

                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" placeholder="Enter Username" required></td>
                        </tr>

                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password" placeholder="Enter Password" required></td>
                        </tr>

                        <tr>
                            <td>Confirm Password:</td>
                            <td><input type="password" name="confirm_password" placeholder="Confirm Password" required></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add admin" class="btn-secondary">
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
                $password = md5($_POST['password']); //encrypts password with MD5
                $confirm_password = md5($_POST['confirm_password']); //encrypts password with MD5

                if($password == $confirm_password){

                    //SQL query to save data
                    $sql = "INSERT INTO tbl_admin SET 
                        full_name = '$full_name',
                        username = '$username',
                        password = '$password'
                    ";

                    //executes query and saves data into database
                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE){
                        $_SESSION['add'] = "<div class='success'>New admin added succesfully</div>";
                        header("location:".SITE_URL.'admin/manage-admin.php') ; //redirect page
                    }else{
                        $_SESSION['add'] = "<div class='error'>Failed to add new admin</div>";
                        header("location:".SITE_URL.'admin/add-admin.php');  //redirect page
                    }

                }else{

                    $_SESSION['pwd-not-match'] = "<div class='error'>Passwords do not match</div>";
                    header("location:".SITE_URL.'admin/add-admin.php') ; //redirect page

                }
            }

        ?>

    </body>

</html>

