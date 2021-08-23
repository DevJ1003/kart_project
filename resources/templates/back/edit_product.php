<?php require_once("../../resources/config.php");

include "header.php";


if (isset($_GET['id'])) {

    $query = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['id']));
    confirm($query);

    while ($row = fetch_array($query)) {
        $product_title       = escape_string($row['product_title']);
        $product_category_id = escape_string($row['product_category_id']);
        $product_price       = escape_string($row['product_price']);
        $product_description = escape_string($row['product_description']);
        $short_desc          = escape_string($row['short_desc']);
        $product_quantity    = escape_string($row['product_quantity']);
        $product_image       = escape_string($row['product_image']);

        $product_image = display_image($row['product_image']);
    }

    // var_dump($_POST);
    // die();
    update_products();
}


?>

</div>

<div id="page-wrapper">

    <h1 class="page-header">
        Edit Product
    </h1>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="col-md-8">
            <div class="form-group">
                <label for="product-title">Product Title </label>
                <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
            </div>

            <div class="form-group">
                <label for="product-title">Product Description</label>
                <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo $product_description; ?></textarea>
            </div>

            <div class="form-group">
                <label for="product-title">Product Short Description</label>
                <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"><?php echo $short_desc; ?></textarea>
            </div>

        </div>
        <!--Main Content-->

        <!-- SIDEBAR-->
        <aside id="admin_sidebar" class="col-md-4">


            <!-- Product Categories-->
            <div class="form-group">
                <label for="product-title">Product Category</label>
                <select name="product_category_id" id="" class="form-control">
                    <option value="<?php echo $product_category_id; ?>"><?php echo show_product_category_title($product_category_id);
                                                                        ?></option>
                    <?php get_categories_add_product_page();
                    ?>
                </select>
            </div>


            <!-- Product Brands-->
            <div class="form-group">
                <label for="product-title">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control" value="<?php echo $product_quantity; ?>"></input>
            </div>


            <!-- Product Price-->
            <div class="form-group">
                <label for="product-title">Product Price</label>
                <input type="text" name="product_price" class="form-control" value="<?php echo $product_price; ?>"></input>
            </div>


            <!-- Product Tags -->
            <!-- <div class="form-group">
                <label for="product-title">Product Keywords</label>
                <input type="text" name="product_tags" class="form-control">
            </div> -->

            <!-- Product Image -->
            <div class="form-group">
                <label for="product-title">Product Image</label>
                <input type="file" name="file"><br>
                <img width="200" src="../../resources/<?php echo $product_image; ?>" alt="">
            </div>

            <div class="form-group">
                <button name="update" type="submit" class="btn btn-primary">Update <span class="glyphicon glyphicon-ok"></span></button>
            </div>


        </aside>
        <!--SIDEBAR-->

    </form>

</div>
<!-- /#page-wrapper -->

<?php include "../../resources/templates/back/footer.php"; ?>