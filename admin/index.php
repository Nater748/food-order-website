<?php
include "partials/menu.php";
?>


    <!-- Main section begins-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br> <br>
<?php
if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
?>

            <br> <br>

            <div class="col-4">
                <h1>5</h1>
                <br>
                categories
            </div>

            <div class="col-4">
                <h1>5</h1>
                <br>
                categories
            </div>

            <div class="col-4">
                <h1>5</h1>
                <br>
                categories
            </div>

            <div class="col-4">
                <h1>5</h1>
                <br>
                categories
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Menu section ends-->

    <?php
    include "partials/footer.php";
    ?>