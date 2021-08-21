<?php require_once("../../resources/config.php");

include "../../resources/templates/back/header.php";

?>

</div>

<div id="page-wrapper">

    <h1 class="page-header"><i class="fa fa-fw fa-line-chart"></i>
        Product Order Report...!!
    </h1>
    <h4 class="text-center bg-success"><?php display_message(); ?></h4>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Report_ID</th>
                <th>Product_ID</th>
                <th>Product</th>
                <th>order_ID</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php get_report();
            ?>
        </tbody>
    </table>

</div>
<!-- /#page-wrapper -->

<?php include "../../resources/templates/back/footer.php"; ?>