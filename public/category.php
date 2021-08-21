<?php require_once("../resources/config.php");

include "../resources/templates/front/header.php";

?>


<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1>A Warm Welcome!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
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