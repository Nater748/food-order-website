<?php
include "partials/menu.php";
?>

<div class="main-container">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_POST['id'])){
            $id = $_GET['id'];
        }
        ?>



        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="Current_password" placeholder="enter your current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="enter your new password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>


<?php

if(isset($_POST['submit'])){
    $id = $_GET['id'];
    $current_password = md5($_POST['Current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        $count = mysqli_num_rows($res);
        if($count == 1){
            if($new_password == $confirm_password){
                $sql2 = "UPDATE admin SET password='$new_password' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE){
                    $_SESSION['update'] = "<div class='success'>Password updated successfully.</div>";
                    header("location:".$siteurl."admin/manage-admin.php");
                    exit();
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to update password.</div>";
                    header("location:".$siteurl."admin/manage-admin.php");
                    exit();
                }
            } else {
                $_SESSION['update'] = "<div class='error'>Passwords do not match.</div>";
                header("location:".$siteurl."admin/manage-admin.php");
                exit();
            }
        }else{
            $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
            header("location:".$siteurl."admin/manage-admin.php");
            exit();
        }
    }
}

?>


<?php
include "partials/footer.php";
?>