<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemo's restaurant - Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../images/kemo-logo.png"/>
</head>
<body>

    <?php include('components/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">

            <h1> Update Order</h1>
            <br><br>

            <?php 

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_order WHERE id=$id";
                    $res = mysqli_query($conn, $sql);

                    if($res == true){
                        $count = mysqli_num_rows($res);
                        if($count == 1){
                            $rows = mysqli_fetch_assoc($res);
                            $id = $rows['id'];
                            $food = $rows['food'];
                            $price = $rows['price'];
                            $qty = $rows['qty'];
                            $total = $rows['total'];
                            $status = $rows['status'];
                            $customer_name = $rows['customer_name'];
                            $customer_contact = $rows['customer_contact'];
                            $customer_email = $rows['customer_email'];
                            $customer_address = $rows['customer_address'];

                        }
                        else{
                            $_SESSION['update'] = "<div class='error'>Order not found</div>";
                            header('location:'.SITE_URL.'admin/manage-order.php');
                        }
                    }
                }else{
                    header('location:'.SITE_URL.'admin/manage-order.php');
                }
            ?>
            <br><br>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Food Name:</td>
                        <td><input type="text" name="food" value="<?php echo $food; ?>" placeholder="Enter Customer Name" required></td>
                    </tr>

                    <tr>
                        <td>Quantity:</td>
                        <td><input type="number" name="qty" value="<?php echo $qty; ?>" required></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>" required></td>
                    </tr>

                    <tr>
                        <td>Status:</td>
                        <td>
                            <select name="status" value="<?php echo $status; ?>" >
                                <option value="Ordered">Ordered</option>
                                <option value="Canceled">Canceled</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Out For delivery">Out for delivery</option>
                                <option value="Delivered">Delivered</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>" placeholder="Enter Customer Name" required></td>
                    </tr>

                    <tr>
                        <td>Contact:</td>
                        <td><input type="text" name="contact" value="<?php echo $customer_contact; ?>" placeholder="Enter Contact" required></td>
                    </tr>

                    <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email" value="<?php echo $customer_email; ?>" placeholder="Enter Email" required></td>
                    </tr>

                    <tr>
                        <td>Address:</td>
                        <td><textarea type="text" name="address" cols="30" rows="5" placeholder="Enter Address" required><?php echo $customer_address; ?></textarea></td>
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
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            //SQL query to save data
            $sql2 = "UPDATE tbl_order SET 
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id='$id'
            ";

            //executes query and saves data into database
            $res2 = mysqli_query($conn, $sql2);

            if($res2==TRUE){
                $_SESSION['update'] = "<div class='success'>Order updated succesfully</div>";
                header("location:".SITE_URL.'admin/manage-orders.php') ; //redirect page
            }else{
                $_SESSION['update'] = "<div class='error'>Order to update admin</div>";
                header("location:".SITE_URL.'admin/manage-orders.php');  //redirect page
            }
        }

    ?>
        
</body>
</html>