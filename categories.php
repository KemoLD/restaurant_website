<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="<?php echo SITE_URL; ?>images/kemo-logo.png"/>
    </head>
    <body>
        
        <?php include("components-frontend/menu.php"); ?> 

        <section class="categories">
            <div class="container">

                <h2 class="text-center">Explore Categories</h2>

                <?php

                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' ORDER BY title ASC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res); //count rows
                    
                    if($count > 0 ){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            ?>

                            <a href="<?php echo SITE_URL ?>category-food.php?category_id=<?php echo $id ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name == ""){
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else{
                                            ?>
                                            <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name ?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                    
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>

                            <?php
                        }

                    }else{
                        echo "<div class='error'>There are no categories</div>";
                    }

                ?>

                <div class="clearfix"></div>

            </div>
        </section> 

        <?php include("components-frontend/footer.php"); ?>

    </body>
</html>