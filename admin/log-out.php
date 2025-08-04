<?php
include '../config/config.php';                 
session_destroy();

header("Location:". $siteurl. 'admin/login.php');
?>