<?php require_once("../resources/config.php");

include "../resources/templates/front/header.php";

?>


<!-- Page Content -->
<div class="container">

    <!-- Side Navigation -->
    <?php include "../resources/templates/front/side_nav.php";

    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . "");
    confirm($query);
    while ($row = fetch_array($query)) :

    ?>


        <div class="col-md-9">
            <!--Row For Image and Short Description-->
            <div class="row">

                <div class="col-md-7">
                    <img class="img-responsive" src="../resources/<?php echo display_image($row['product_image']); ?>" alt="">
                </div>

                <div class="col-md-5">
                    <div class="thumbnail">
                        <div class="caption-full">
                            <h4><a href="#"><?php echo $row['product_title']; ?></a> </h4>
                            <hr>
                            <h4><?php echo "&#8377;" . $row['product_price']; ?></h4>
                            <p><?php echo $row['short_desc']; ?></p>
                            <form action="">
                                <div class="form-group">
                                    <a href="../resources/cart.php?add=<?php echo $row['product_id']; ?>" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!--Row For Image and Short Description-->

            <!-- Nav tabs -->
            <ul class="nav">
                <h2>Product Description...!!</h2>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <p><?php echo $row['product_description']; ?></p>
            </div>

        </div>
        <!--col-md-9 ends here-->

    <?php endwhile; ?>

</div>
<!-- /.container -->

<?php include "../resources/templates/front/footer.php"; ?>