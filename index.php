<?php include('partials-front/menu.php');?>



    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo $siteurl;?>food-search.php" method="GET">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>



    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
        <?php
            $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $result = mysqli_query($conn, $sql);
        ?>
        <?php while($row = mysqli_fetch_assoc($result)){
            ?>

            <a href="category-foods.php?<?php echo "id=".$row['id'];?>">
            <div class="box-3 float-container">
                <img src="<?php echo $siteurl; ?>images/category/<?php echo $row['image_name']; ?>" alt="<?php $row['image_name'];?>" class="img-responsive img-curve">

                <h3 class="float-text text-white"><?php echo $row['title'];?></h3>
            </div>
            </a>
            <?php } ?>


            <div class="clearfix"></div>
        </div>
    </section>



    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $result2 = mysqli_query($conn, $sql2);
            ?>
            <?php while($row2 = mysqli_fetch_assoc($result2)){?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row2['title'];?></h4>
                    <p class="food-price">$<?php echo $row2['price'];?></p>
                    <p class="food-detail">
                        <?php echo $row2['description'];?>
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php } ?>



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo $siteurl;?>foods.php">See All Foods</a>
        </p>
    </section>



<?php include "partials-front/footer.php";?>    