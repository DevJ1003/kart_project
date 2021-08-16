<?php require_once("../../resources/config.php");

include "../../resources/templates/back/header.php";

?>

</div>

<div id="page-wrapper">

    <h1 class="page-header">
        All Orders
    </h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Transaction</th>
                <th>Currency</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php display_orders(); ?>
        </tbody>
    </table>

</div>
<!-- /#page-wrapper -->

<?php include "../../resources/templates/back/footer.php"; ?>