<?php
if(!isset($_SESSION['user'])){
    $_SESSION['no-login-message'] = '<div class = "error">Please Login to access Admin Panel</div>';
    header('Location:'. $siteurl. 'admin/login.php'); 
}
?>