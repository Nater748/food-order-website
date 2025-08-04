<?php include "partials/menu.php"; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/> <br/> 

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="enter your full name"></td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="user_name" placeholder="enter your user name"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password" placeholder="enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include "partials/footer.php"; ?>

<?php
if(isset($_POST['submit'])){
    $fullname = $_POST['full_name'];
    $username = $_POST['user_name'];
    $password = md5($_POST['password']);

    if(empty($fullname) || empty($username) || empty($password)){
        $_SESSION['add'] = 'All fields are required';
        header('Location:' .$siteurl. 'admin/add-admin.php');
        exit();
    }

    $sql = "INSERT INTO admin (fullname, username, password) 
            VALUES ('$fullname', '$username', '$password')";
    
    
    $result = mysqli_query($conn, $sql);
    if($result){
        $_SESSION['add'] = '<div class = "success"> Admin added successfully. </div>';
        header('Location:' .$siteurl. 'admin/manage-admin.php');
    }else {
        $_SESSION['add'] = 'Failed to add Admin';
        header('Location:' .$siteurl. 'admin/add-admin.php');
    }
    
}
?>