<?php
include('../config/config.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login- Food Order System</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br> <br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>

        <form action="" method="POST">
        Username: 
        <input type="text" name="username" placeholder="Enter Username" required> <br> <br>

        Password: 
        <input type="password" name="password" placeholder="Enter Password" required> <br><br>

        <input type="submit" name="submit" value="login" class="btn-primary"></input> <br>
        <p class="text-center">Created by - <a href="www.naterahenjir.com">Nater Ahenjir</a></p>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username;
            header('location:'.$siteurl.'admin/');
        } else {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.$siteurl.'admin/login.php');
        }
    }
}