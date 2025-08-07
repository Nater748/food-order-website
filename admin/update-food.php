<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM food WHERE id=$id";
            $res = mysqli_query($conn, $sql2        );
            if($res == TRUE){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row2 = mysqli_fetch_assoc($res);
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $category_id = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                } else {
                $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
                header('Location:'. $siteurl . 'admin/manage-food.php');
            }
        }
    } else {
        header('location:'. $siteurl . 'admin/manage-food.php');
    }
?>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image != ""){
                            ?>
                            <img src="<?php echo $siteurl;?>images/food/<?php echo $current_image;?>" width="60px">
                            <?php
                         } else {
                            echo '<div class="error">No image uploaded</div>';
                        }
                    ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql = "SELECT * FROM category WHERE featured='Yes' AND active='Yes'";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($result);
                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $category_id = $row['id'];
                                        $category_title = $row['title'];
                                        ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                            <!-- <option value="0">Test Category</option> -->
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>  
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if($featured == "No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($active == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if($active == "No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];
                $title = $_POST['title'];
                $price = $_POST['price'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                    $image_name = $current_image;
                if ($_FILES['image']['name'] != '') {
                    $image_name = $_FILES['image']['name'];
                    
                        $parts = explode('.', $image_name);
                        $ext = end($parts);
                        $image_name = "food_".rand(0000, 9999).".".$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload == FALSE){
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                            header('location:'. $siteurl . 'admin/manage-food.php');
                            die();
                        }

                        if($current_image != ""){
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
                            if($remove == FALSE){
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:'. $siteurl . 'admin/manage-food.php');
                                die();
                            }
                    } else {
                        $image_name = $current_image; 
                    }
                } else {
                    $image_name = $current_image; 
                }
                    

                $sql3 = "UPDATE food SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id";

                $res2 = mysqli_query($conn, $sql3);
                if($res2 == TRUE){
                    $_SESSION['finally'] = "<div class='success'>Food updated successfully.</div>";
                    header('location:'. $siteurl . 'admin/manage-food.php');
                } else {
                    $_SESSION['finally'] = "<div class='error'>Failed to update food.</div>";
                    header('location:'. $siteurl . 'admin/manage-food.php');
                }
            }
        ?>

    </div>
</div>

<?php include 'partials/footer.php'; ?>