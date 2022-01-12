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

                <h1>Manage admin</h1>
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
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-change'])){
                        echo $_SESSION['pwd-change'];
                        unset($_SESSION['pwd-change']);
                    }
                ?>
                <br><br>

                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>Serial Number</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_admin";  //query to fetch all admin data
                        $res = mysqli_query($conn, $sql);

                        if($res == TRUE){
                            $count = mysqli_num_rows($res); //count rows
                            $sn=1;
                            if($count > 0){

                                while($rows=mysqli_fetch_assoc($res)){
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    ?>

                                    <tr>
                                        <td>  <?php echo $sn++; ?> </td>
                                        <td> <?php echo $full_name; ?> </td>
                                        <td>  <?php echo $username; ?> </td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITE_URL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITE_URL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-warning">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php

                                }

                            }else{

                                ?>

                                <tr>
                                    <td colspan="4"><div class="error">No Admins Added</div></td>;
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