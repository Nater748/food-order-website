<?php
include "partials/menu.php";
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM admin WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if($result == TRUE){
            $count = mysqli_num_rows($result);
            if($count == 1){
                $row = mysqli_fetch_assoc($result);
                $fullname = $row['fullname'];
                $username = $row['username'];
            } else {
                $_SESSION['no-admin-found'] = "<div class='error'>Admin not found.</div>";
                header('Location:' .$siteurl. 'admin/manage-admin.php');
                exit();
            }
        } else {
            $_SESSION['no-admin-found'] = "<div class='error'>Failed to retrieve admin data.</div>";
            header('Location:' .$siteurl. 'admin/manage-admin.php');
            exit();
        }
        ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td> <input type="text" name="full_name" value="<?php echo $fullname;?>"> </td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td> <input type="text" name="user_name" value="<?php echo $username;?>"> </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"> 
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        //echo "button clicked";
        $id = $_POST['id'];
        $fullname = $_POST['full_name'];
        $username = $_POST['user_name'];

        $sql = "UPDATE admin SET 
        fullname = '$fullname' ,
        username = '$username' 
        WHERE id = '$id'
        ";

        $result = mysqli_query($conn, $sql);

        if($result == TRUE){
            //echo "Admin updated successfully";
            $_SESSION['update'] = " <div class = 'success'> Admin updated successfully. </div>";
            header('Location:'. $siteurl. 'admin/manage-admin.php');
        }else{
            //echo "Failed to update Admin";
            $_SESSION['update'] = "<div class = 'error'>Failed to update Amin.</div>";
            header('Location:'. $siteurl .'admin/manage-admin.php');
        }
    }
?>

<?php
include "partials/footer.php";
?>