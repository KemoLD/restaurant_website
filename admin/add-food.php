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

                <h1> Add Food</h1>
                <br><br>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>
                <br>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">

                        <tr>
                            <td>Name:</td>
                            <td><input type="text" name="title" placeholder="Enter Food Name" required></td>
                        </tr>

                        <tr>
                            <td>Description:</td>
                            <td><textarea name="description" placeholder="Enter Description" cols="30" rows="5"></textarea></td>
                        </tr>

                        <tr>
                            <td>Price:</td>
                            <td><input type="number" step=".01" name="price" required></td>
                        </tr>

                        <tr>
                            <td>Category:</td>
                            <td>
                                <select name="category">
                                    <?php
                                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                        $res = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($res);
                                        if($count > 0){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $id = $row['id'];
                                                $title = $row['title'];
                                                
                                                echo "<option value='$id'>$title</option>";
                                                
                                            }
                                        }
                                        else{
                                        
                                            echo "<option value='0'>No active categories found</option>";                      

                                        }
                                    ?>
                                </select> 
                            </td>
                        </tr>

                        <tr>
                            <td>Image:</td>
                            <td><input type="file" name="image"></td>
                        </tr>

                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input type="radio" name="featured" value="Yes">Yes
                                <input type="radio" name="featured" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td>Active:</td>
                            <td>
                                <input type="radio" name="active" value="Yes">Yes
                                <input type="radio" name="active" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add food" class="btn-secondary">
                            </td>                          
                        </tr>

                    </table>
                </form>

            </div>  
        </div>

        <?php include('components/footer.php'); ?>

        <?php 

            if(isset($_POST['submit'])){ //button clicked
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];


                if(isset($_FILES['image']['name']) ){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $tmp = explode('.', $image_name);//rename files to stop overwriting of same name files
                        $ext = end($tmp);
                        $image_name = "Food_Item_".$title.'_'.rand(0000,9999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload == false){
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header("location:".SITE_URL.'admin/add-category.php') ; //redirect page
                            die(); //stop the process from insertig data into database
                        }
                    }
                }else{
                    $image_name = "";
                }


                if(isset($_POST['featured']) ){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No";
                }

                if(isset($_POST['active']) ){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }
                 
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE){
                    $_SESSION['add'] = "<div class='success'>New food added succesfully</div>";
                    header("location:".SITE_URL.'admin/manage-food.php');
                }else{
                    $_SESSION['add'] = "<div class='error'>Failed to add new food</div>";
                    header("location:".SITE_URL.'admin/add-food.php');  //redirect page
                }

            }
        ?>

    </body>

</html>