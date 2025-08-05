<?php
include "../config/config.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $sql_get = "SELECT image_name FROM category WHERE id='$id'";
    $res_get = mysqli_query($conn, $sql_get);

    if ($res_get && mysqli_num_rows($res_get) > 0) {
        $row = mysqli_fetch_assoc($res_get);
        $image_name = $row['image_name'];

        if (!empty($image_name)) {
            $path = "../images/category/" . $image_name;

            if (file_exists($path)) {
                unlink($path); 
            }
        }
    }
    
    $sql = "DELETE FROM category WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result === TRUE) {
        $_SESSION['remove'] = "<div class='success'>Category Deleted Successfully.</div>";
    } else {
        $_SESSION['remove'] = "<div class='error'>Failed to Delete Category.</div>";
    }
    header("Location: " . $siteurl . 'admin/manage-category.php');
    exit;
} else {
    $_SESSION['remove'] = "<div class='error'>Unauthorized Access.</div>";
    header("Location: " . $siteurl . 'admin/manage-category.php');
    exit;
}
?>
