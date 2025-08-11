<?php include "partials-front/menu.php";?>


    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo $siteurl;?>food-search.php" method="GET">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>





    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' ";
                $result2 = mysqli_query($conn, $sql2);
            ?>
            <?php while($row2 = mysqli_fetch_assoc($result2)){?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/food/<?php echo $row2['image_name']?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row2['title'];?></h4>
                    <p class="food-price">$<?php echo $row2['price'];?></p>
                    <p class="food-detail">
                        <?php echo $row2['description'];?>
                    </p>
                    <br>

                    <a href="<?php echo $siteurl?>order.php?food_id=<?php echo $row2['id'];?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php } ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>



<?php include "partials-front/footer.php";?>