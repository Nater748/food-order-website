<?php include "partials/menu.php";?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM `order` WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if($count ==1){
                    $row= mysqli_fetch_assoc($result);
                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['qty'];
                    $status = $row['status'];
                }else{
                    header('Location:'.$siteurl. 'admin/manage-order.php');
                }
            }else{
                header('Location:'.$siteurl. 'admin/manage-order.php');
            }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><?php echo $food;?></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>$<?php echo $price;?></td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td>
                      <input type="number" name="quantity" value="<?php echo $quantity;?>">
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="update order" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total = $price * $quantity;
                $status = $_POST['status'];

                $sql2 = "UPDATE `order` SET
                qty = $quantity,
                total = $total,
                status = '$status'
                WHERE id = $id
                ";
                $res2 = mysqli_query($conn, $sql2);

                if($res2 ==true){
                    $_SESSION['update'] = "<div class = 'success'>Order Updated Successfully</div>";
                    header('Location:' .$siteurl. "admin/manage-order.php");
                }else{
                    $_SESSION['update'] = "<div class = 'error'>Order Update Failed</div>";
                    header('Location:' .$siteurl. "admin/manage-order.php");
                }
            }
        ?>


    </div>
</div>
<?php include "partials/footer.php";?>