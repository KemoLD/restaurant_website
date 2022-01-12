<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Kemo's restaurant- Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="<?php echo SITE_URL; ?>images/kemo-logo.png"/>
    </head>
    
    <body>

    <?php include('components/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">

                <h1>Dashboard</h1>
                <br>

                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center">
                    <?php
                        $sql = "SELECT * FROM tbl_category";  //query to fetch all admin data
                        $res = mysqli_query($conn, $sql);
                        if($res == TRUE){
                            $count = mysqli_num_rows($res); //count rows
                        }
                        else{
                            $count = "";
                        }
                    ?>
                    <h1><?php echo $count ?></h1>
                    <br/>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql2 = "SELECT * FROM tbl_food";  //query to fetch all admin data
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2 == TRUE){
                            $count2 = mysqli_num_rows($res2); //count rows
                        }
                        else{
                            $count2 = "";
                        }
                    ?>
                    <h1><?php echo $count2 ?></h1>
                    <br/>
                    Food Item
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql3 = "SELECT * FROM tbl_order";  //query to fetch all admin data
                        $res3 = mysqli_query($conn, $sql3);
                        if($res3 == TRUE){
                            $count3 = mysqli_num_rows($res3); //count rows
                        }
                        else{
                            $count3 = "";
                        }
                    ?>
                    <h1><?php echo $count3 ?></h1>
                    <br/>
                    Total orders
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";  //query to fetch all admin data
                        $res4 = mysqli_query($conn, $sql4);
                        if($res == TRUE){
                            $row = mysqli_fetch_assoc($res4); //count rows
                            $count4 = $row['Total'];
                        }
                        else{
                            $count4 = "";
                        }
                    ?>
                    <h1>$<?php echo $count4 ?></h1>
                    <br/>
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>

        <?php include('components/footer.php'); ?>

    </body>

</html>