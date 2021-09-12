<?php require_once("../resources/config.php");

include "../resources/templates/front/header.php";

?>

<!-- Page Content -->
<div class="container">
    <!-- Jumbotron Header -->
    <header>
        <h1><span class="glyphicon glyphicon-shopping-cart" style="font-size: 80px"></span> Shop newly available products...!!</h1>
    </header>
    <hr>
    <!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">
        <?php get_products_in_shop_page(); ?>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<?php include "../resources/templates/front/footer.php"; ?>