<?php
include "partials/menu.php";
?>

    <!-- Main section begins-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
             <!-- Button to Add Admin -->
              <br/> <br/> 

                <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                ?>
                <br> <br> <br>
              <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br/> <br/> <br/>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM admin";
                    $result = mysqli_query($conn, $sql);

                    if($result){
                        $count = mysqli_num_rows($result);
                        $sn = 1; 
                        if($count > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['id'];
                                $fullname = $row['fullname'];
                                $username = $row['username'];
                                ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $fullname; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href='<?php echo $siteurl;?>admin/update-admin.php?id=<?php echo $id;?>' class='btn-secondary'>Update Admin</a>
                                        <a href='<?php echo $siteurl;?>admin/delete-admin.php?id=<?php echo $id;?>' class='btn-danger'>Delete Admin</a>
                                        <a href="<?php echo $siteurl;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-safety">Update Password</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='error'>No Admins Added Yet.</td></tr>";
                        }
                    }
                ?>
                
            </table>
            
        </div>
    </div>
    <!-- Menu section ends-->

<?php
include "partials/footer.php";
?>