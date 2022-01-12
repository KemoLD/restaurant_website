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

        <?php
            if(isset($_GET['category_id'])){
                $category_id = $_GET['category_id'];
                $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
                $res = mysqli_query($conn, $sql);
                $rows=mysqli_fetch_assoc($res);
                $title = $rows['title'];
            }else{
                header('location:'.SITE_URL);
            }

        ?>

        <section class="food-search text-center">
            <div class="container">
                
                <h2><a href="#" class="text-white">"<?php echo $title;?>"</a></h2>
    
            </div>
        </section> 

        <section class="food-menu">
            <div class="container">

                <h2 class="text-center">Menu Items</h2>
                
                <?php 
                    $sql2 = "SELECT * FROM tbl_food WHERE category_id='$category_id' ORDER BY title ASC";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2); //count rows

                    if($count2 > 0){

                        while($rows2=mysqli_fetch_assoc($res2)){
                            $id = $rows2['id'];
                            $f_title = $rows2['title'];
                            $description = $rows2['description'];
                            $price = $rows2['price'];
                            $image_name = $rows2['image_name'];
                            ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == ""){
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else{
                                            ?>
                                            <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name ?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>
                
                                <div class="food-menu-desc">
                                    <h4><?php echo $f_title; ?></h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail"><?php echo $description; ?></p>
                                    <br>
                
                                    <a href="<?php echo SITE_URL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                            <?php
                        }
                    }else{
                        echo "<div class='error'>No items match your search</div>";
                    }

                ?>
    
                <div class="clearfix"></div>

            </div>
        </section> 

        <?php include("components-frontend/footer.php"); ?>

    </body>
</html>