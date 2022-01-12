<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kemo's Retaurant</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="<?php echo SITE_URL; ?>images/kemo-logo.png"/>
</head>

<body>

    <?php include("components-frontend/menu.php"); ?>

    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITE_URL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Menu Item..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <?php
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <section class="categories">
        <div class="container">

            <h2 class="text-center">Featured Categories</h2>

            <?php
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ORDER BY title ASC LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res); //count rows

            if ($count > 0) {

                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
            ?>

                    <a href="<?php echo SITE_URL ?>category-food.php?category_id=<?php echo $id ?>">
                        <div class="box-3 float-container">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not available</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                            }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

            <?php
                }
            } else {
                echo "<div class='error'>There are no featured categories</div>";
            }

            ?>

            <div class="clearfix"></div>

        </div>
    </section>

    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Featured Menu Items</h2>

            <?php
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' ORDER BY title ASC LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2); //count rows

            if ($count2 > 0) {

                while ($rows2 = mysqli_fetch_assoc($res2)) {
                    $id = $rows2['id'];
                    $title = $rows2['title'];
                    $description = $rows2['description'];
                    $price = $rows2['price'];
                    $image_name = $rows2['image_name'];
            ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not available</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
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
            } else {
                echo "<div class='error'>There are no featured food items</div>";
            }

            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITE_URL; ?>food.php">See All Items</a>
        </p>
    </section>

    <?php include("components-frontend/footer.php"); ?>

</body>

</html>