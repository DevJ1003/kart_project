<?php require_once("../../resources/config.php");

include "../../resources/templates/back/header.php";


if (!isset($_SESSION['username'])) {

    redirect("../../public");
}


?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard <small>Statistics Overview</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->


        <?php

        if ($_SERVER['REQUEST_URI'] == "/Kart/public/admin/" || $_SERVER['REQUEST_URI'] == "/Kart/public/admin/index.php") {

            include "../../resources/templates/back/admin_content.php";
        }

        if (isset($_GET['orders'])) {

            include "../../resources/templates/back/orders.php";
        }

        if (isset($_GET['products'])) {

            include "../../resources/templates/back/products.php";
        }


        if (isset($_GET['add_product'])) {

            include "../../resources/templates/back/add_product.php";
        }


        if (isset($_GET['categories'])) {

            include "../../resources/templates/back/categories.php";
        }


        if (isset($_GET['users'])) {

            include "../../resources/templates/back/users.php";
        }

        ?>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "../../resources/templates/back/footer.php"; ?>