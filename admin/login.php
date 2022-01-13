<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="../css/admin.css">
        <title>Kemo's Restaurant- Admin/Login</title>
        <link rel="icon" href="../images/kemo-logo.png"/>
    </head>
    <body>

        <?php include('../config/constants.php') ?>

        <div class="login">

            <h1 class="text-center">Login</h1>
            <br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['not-loged-in'])){
                    echo $_SESSION['not-loged-in'];
                    unset($_SESSION['not-loged-in']);
                }
            ?>
            <br>

            <form action="" method="POST" class="text-center">

                Username:
                <br>
                <input type="text" name="username" placeholder="Enter Username" required>
                <br><br>

                Password:
                <br>
                <input type="password" name="password" placeholder="Enter Password" required>
                <br><br>

                <input type="submit" name="submit" value="Login" class="btn-secondary">
                <br><br>

                <p class="text-center">Created by - <a href="https://www.linkedin.com/in/kemo-sonko/">Kemo Sonko </a></p>
                
            </form>
        </div>

        <?php
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $password = md5($_POST['password']);

                $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                
                if($count == 1){
                    $_SESSION['login'] = "<div class='success'>Login succesful</div>";
                    $_SESSION['user'] = $username;
                    header("location:".SITE_URL.'admin/') ; //redirect page
                }else{
                    $_SESSION['login'] = "<div class='error text-center'>username or password is not valid</div>";
                    header("location:".SITE_URL.'admin/login.php') ; //redirect page
                }

            }
        ?>
        
    </body>
</html>