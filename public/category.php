<?php require_once("../resources/config.php");

include "../resources/templates/front/header.php";

?>


<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1>Shop by Category !</h1>
        <p>With kArt , you can shop accordingly to your needs and product categories available .</p>
        <p><a href="shop.php" class="btn btn-primary btn-large">Find More Products <span class="glyphicon glyphicon-zoom-in"></span></a>
        </p>
    </header>

    <hr>

    <!-- Title -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Latest products related to this category!</h3>
        </div>
    </div>
    <!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">

        <?php get_products_in_cat_page(); ?>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php

include "../resources/templates/front/footer.php";

?>