<?php
include "../config/config.php";
$id = $_GET['id'] ?? null;

$sql = "DELETE FROM admin WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if($result == TRUE){
    //echo "Admin deleted";
    $_SESSION['delete'] = "<div class = 'success'> Admin Deleted Successfully. </div>";
    header("Location:" .$siteurl . 'admin/manage-admin.php');
}else{
    //echo "Failed to delete Admin";
    $_SESSION['delete'] = "<div class = 'error'> Failed to Delete Admin. </div>";
}
?>