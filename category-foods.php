<?php include "partials-front/menu.php";?>



    <section class="food-search text-center">
        <div class="container">
            <?php
            $id = $_GET['id'];
            $sql = "SELECT title FROM category WHERE id = $id";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            ?>
            <h2>Foods on <a href="#" class="text-white"><?php echo $row['title']?></a></h2>

        </div>
    </section>





    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $sql2 = "SELECT * FROM food WHERE category_id = $id AND active='Yes' AND featured='Yes' ";
            $result2 = mysqli_query($conn, $sql2);
            ?>
            <?php while($row2 = mysqli_fetch_assoc($result2)){?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?php echo $siteurl; ?>images/food/<?php echo $row2['image_name']; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row2['title'];?></h4>
                    <p class="food-price">$<?php echo $row2['price']?></p>
                    <p class="food-detail">
                        <?php echo $row2['description']?>
                    </p>
                    <br>

                    <a href="<?php echo $siteurl?>order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php } ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>



<?php include "partials-front/footer.php";?>    