<?php include "partials-front/menu.php";?>

    <section class="food-search text-center">
        <div class="container">
            <?php
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                } else {
                    $search = "";
                    header("Location: index.php");
                }
                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%' AND active='Yes' AND featured='Yes'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if($count == 0){
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search?></a></h2>

        </div>
    </section>




    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php while($row = mysqli_fetch_assoc($result)){?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?php echo $siteurl; ?>images/food/<?php echo $row['image_name']; ?>" alt="" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row['title']?></h4>
                    <p class="food-price">$<?php echo $row['price']?></p>
                    <p class="food-detail">
                        <?php echo $row['description']?>
                    </p>
                    <br>

                    <a href="<?php echo $siteurl;?>order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php } ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>



<?php include "partials-front/footer.php";?>