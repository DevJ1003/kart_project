<?php require_once("../../resources/config.php");

include "../../resources/templates/back/header.php";

?>

</div>

<div id="page-wrapper">

    <h1 class="page-header"><i class="fa fa-fw fa-table"></i>
        Add New Product...!!
    </h1>

    <form action="" method="post" enctype="multipart/form-data">
        <?php add_products(); ?>
        <div class="col-md-8">
            <div class="form-group">
                <label for="product-title">Product Title </label>
                <input type="text" name="product_title" class="form-control">
            </div>

            <div class="form-group">
                <label for="product-title">Product Description</label>
                <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="product-title">Product Short Description</label>
                <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>

        </div>
        <!--Main Content-->

        <!-- SIDEBAR-->
        <aside id="admin_sidebar" class="col-md-4">


            <!-- Product Categories-->
            <div class="form-group">
                <label for="product-title">Product Category</label>
                <select name="product_category_id" id="" class="form-control">
                    <option value="">Select Category</option>
                    <?php get_categories_add_product_page(); ?>
                </select>
            </div>


            <!-- Product Brands-->
            <div class="form-group">
                <label for="product-title">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control"></input>
            </div>


            <!-- Product Price-->
            <div class="form-group">
                <label for="product-title">Product Price</label>
                <input type="text" name="product_price" class="form-control"></input>
            </div>

            <!-- Product Image -->
            <div class="form-group">
                <label for="product-title">Product Image</label>
                <input type="file" name="file">
            </div>

            <div class="form-group">
                <button name="publish" type="submit" class="btn btn-primary">Add New Product <span class="glyphicon glyphicon-ok"></span></button>
            </div>


        </aside>
        <!--SIDEBAR-->

    </form>

</div>
<!-- /#page-wrapper -->

<?php include "../../resources/templates/back/footer.php"; ?>