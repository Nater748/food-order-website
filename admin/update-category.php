<?php include'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM category WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    } else {
                        $_SESSION['no-category-found'] = "<div class = 'error'>Category doesn't exist.</div>";
                        header('Location'. $siteurl . 'admin/manage-category,php');
                    }
                }
            }else{
                header('location:'. $siteurl . 'admin/manage-category.php');
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        if($current_image != ""){
                            ?>
                            <img src="<?php echo $siteurl;?>images/category/<?php echo $current_image;?>" width="60px" >
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
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $ext = end(explode('.', $image_name));
                        $image_name = "Category_".rand(0000, 9999).".".$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload == FALSE){
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                            header('location:'. $siteurl . 'admin/manage-category.php');
                            die();
                        }

                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            if($remove == FALSE){
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:'. $siteurl . 'admin/manage-category.php');
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image; 
                    }
                } else {
                    $image_name = $current_image; 
                }

                $sql2 = "UPDATE category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);
                if($res2 == TRUE){
                    $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                    header('location:'. $siteurl . 'admin/manage-category.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                    header('location:'. $siteurl . 'admin/manage-category.php');
                }
            }
            ?>
    </div>
</div>




<?php include 'partials/footer.php'; ?>