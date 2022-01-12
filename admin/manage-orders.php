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

                <h1>Manage Orders</h1>
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
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";  //latest at top
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res); //count rows

                        if($res == TRUE){
                            
                            $sn=1;
                            if($count > 0){

                                while($rows=mysqli_fetch_assoc($res)){
                                    $id = $rows['id'];
                                    $food = $rows['food'];
                                    $price = $rows['price'];
                                    $qty = $rows['qty'];
                                    $total = $rows['total'];
                                    $order_date = $rows['order_date'];
                                    $status = $rows['status'];
                                    $customer_name = $rows['customer_name'];
                                    $customer_contact = $rows['customer_contact'];
                                    $customer_email = $rows['customer_email'];
                                    $customer_address = $rows['customer_address'];

                                    ?>

                                    <tr>
                                        <td> <?php echo $sn++; ?> </td>
                                        <td> <?php echo $food; ?> </td>
                                        <td> <?php echo $price; ?> </td>
                                        <td> <?php echo $qty; ?> </td>
                                        <td> <?php echo $total; ?> </td>
                                        <td> <?php echo $order_date; ?> </td>
                                        <td> 
                                            <?php 
                                                if( $status == "Ordered"){echo "<label>$status</status>";}
                                                else if( $status == "Canceled"){echo "<label style='color: red;'>$status</label>";}
                                                else if( $status == "Confirmed"){echo "<label style='color: blue;'>$status</label>";} 
                                                else if( $status == "Out for delivery"){echo "<label style='orange: red;'>$status</label>";}
                                                else if( $status == "Delivered"){echo "<label style='color: green;'>$status</label>";}
                                            ?> 
                                        </td>
                                        <td> <?php echo $customer_name; ?> </td>
                                        <td> <?php echo $customer_contact; ?> </td>
                                        <td> <?php echo $customer_email; ?> </td>
                                        <td> <?php echo $customer_address; ?> </td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else{

                                ?>

                                <tr>
                                    <td colspan="12"><div class="error">No order yet</div></td>;
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