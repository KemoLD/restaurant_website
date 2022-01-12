<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Kemo's restaurant</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <?php include("components-frontend/menu.php"); ?>
        
        <section class="food-search text-center">
            <div class="container">

                <form action="<?php echo SITE_URL?>food-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search for Menu Item..." required>
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                </form>

            </div>
        </section> 

        <section class="food-menu">
            <div class="container">

                <h2 class="text-center">Menu Items</h2>

                <?php
                    $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' ORDER BY title ASC";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2); //count rows

                    if($count2 > 0){

                        while($rows2=mysqli_fetch_assoc($res2)){
                            $id = $rows2['id'];
                            $title = $rows2['title'];
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
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail"><?php echo $description; ?></p>
                                    <br>
                
                                    <a href="<?php echo SITE_URL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                            <?php
                        }
                    }else{
                        echo "<div class='error'>There are no featured food items</div>";
                    }

                ?>

                <div class="clearfix"></div>

            </div>
        </section>

        <?php include("components-frontend/footer.php"); ?>
    </body>
</html>