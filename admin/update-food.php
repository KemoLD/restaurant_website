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

            <h1> Update Food</h1>
            <br><br>

            <?php

            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_food WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $category_id = $row['category_id'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    $_SESSION['update'] = "<div class='error'>Food not found</div>";
                    header('location:' . SITE_URL . 'admin/manage-food.php');
                }
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>" placeholder="Enter Name" required></td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td><textarea name="description" placeholder="Enter Description" cols="30" rows="5"><?php echo $title; ?></textarea></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><input type="number" step=".01" name="price" value="<?php echo $price; ?>" required></td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                            if ($current_image != "") {
                            ?>

                                <img src="<?php echo SITE_URL; ?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="150px">
                            <?php
                            } else {
                                echo "<div class='error'>Image not Added<div>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image:</td>
                        <td><input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" value="<?php echo $category_id; ?>">
                                <?php
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                if ($count2 > 0) {
                                    while ($row2 = mysqli_fetch_assoc($res2)) {
                                        $id_cat = $row2['id'];
                                        $title_cat = $row2['title'];

                                        echo "<option value='$id_cat'>$title_cat</option>";
                                    }
                                } else {

                                    echo "<option value='0'>No active categories found</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if ($featured == "Yes") {
                                        echo "checked";
                                    }  ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if ($featured == "No") {
                                        echo "checked";
                                    }  ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if ($active == "Yes") {
                                        echo "checked";
                                    }  ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if ($active == "No") {
                                        echo "checked";
                                    }  ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Save changes" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

        </div>
    </div>

    <?php include('components/footer.php'); ?>

    <?php  //saves data into database

    if (isset($_POST['submit'])) { //button clicked
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $id = $_POST['id'];

        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            if ($image_name != "") {
                $tmp = explode('.', $image_name); //rename files to stop overwriting of same name files
                $ext = end($tmp);
                $image_name = "Food_Item_" . $title . '_' . rand(000, 999) . '.' . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload food image</div>";
                    header("location:" . SITE_URL . 'admin/update-food.php'); //redirect page
                    die(); //stop the process from insertig data into database
                }

                if ($current_image != "") {  //delete current image
                    $remove_path = "../images/food/" . $current_image;
                    $remove = unlink($remove_path);
                    if ($remove == false) {
                        $_SESSION['delete'] = "<div class='error'>Failed to delete food image</div>";
                        header('location:' . SITE_URL . 'admin/manage-food.php');
                        die();
                    }
                }
            } else {
                $image_name = $current_image;
            }
        } else {
            $image_name = $current_image;
        }

        //SQL query to save data
        $sql3 = "UPDATE tbl_food SET 
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id=$id
        ";

        //executes query and saves data into database
        $res3 = mysqli_query($conn, $sql3);

        if ($res3 == TRUE) {
            $_SESSION['update'] = "<div class='success'>Food updated succesfully</div>";
            header("location:" . SITE_URL . 'admin/manage-food.php'); //redirect page
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to update food</div>";
            header("location:" . SITE_URL . 'admin/manage-food.php');  //redirect page
        }
    }

    ?>

</body>

</html>