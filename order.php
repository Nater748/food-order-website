<?php include "partials-front/menu.php";?>

    <?php
        if(isset($_GET['food_id'])){
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM food WHERE id=$food_id";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if($count ==1){
                $row = mysqli_fetch_assoc($result);
            }else{
                header('Location' . $siteurl);
            }
        }else{
            header('Location' . $siteurl);
        }
    ?>



    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="post">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php
                            if($row['image_name'] ==""){
                                //image not available
                                echo "<div class ='error'>Image not Available</div>";
                            }else{
                                //image available
                                ?>
                                <img src="<?php echo $siteurl; ?>images/food/<?php echo $row['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?> 
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $row['title']?></h3>
                        <input type="hidden" name="food" value="<?php echo $row['title'];?>">
                        <p class="food-price">$<?php echo $row['price']?></p>
                        <input type="hidden" name="price" value="<?php echo $row['price'];?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Nater Ahenjir" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0815xxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. nater@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                if(isset($_POST['submit'])){
                    $food = $_POST['food'];
                    $price = (float)$_POST['price'];
                    $qty   = (int)$_POST['qty'];    
                    $total = $price * $qty;
                    $order_date = date('y-m-d');
                    $status = "ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql2 = "INSERT into `order` (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES('$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
                    $result2 = mysqli_query($conn, $sql2);

                    if($result2){
                        $_SESSION['order'] = "<div class = 'success'>Order Placed</div>";
                        header('Location:' . $siteurl);
                    }else{
                        $_SESSION['order'] = "<div class = 'error'>Order Failed</div>";
                        header('Location'.$siteurl.'order.php');
                    }
                }
            ?>

        </div>
    </section>



 <?php include "partials-front/footer.php";?>