<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Kemo's restaurant- Admin </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/kemo-logo.png"/>
    </head>
    
    <body>

        <?php include('components/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">

                <h1> Add Category</h1>
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
                            <td>Title:</td>
                            <td><input type="text" name="title" placeholder="Enter Category Title" required></td>
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
                                <input type="submit" name="submit" value="Add category" class="btn-secondary">
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


                if(isset($_FILES['image']['name']) ){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $ext = end(explode('.', $image_name));//rename files to stop overwriting of same name files
                        $image_name = "Food_Category_".$title.'_'.rand(000,999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
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
                 
                $sql = "INSERT INTO tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==TRUE){
                    $_SESSION['add'] = "<div class='success'>New category added succesfully</div>";
                    header("location:".SITE_URL.'admin/manage-categories.php') ; //redirect page
                }else{
                    $_SESSION['add'] = "<div class='error'>Failed to add new category</div>";
                    header("location:".SITE_URL.'admin/add-category.php');  //redirect page
                }

            }
        ?>

    </body>

</html>
