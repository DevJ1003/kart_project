<?php require_once("../resources/config.php");

include "../resources/templates/front/header.php";

?>

<!-- Page Content -->
<div class="container">

    <header>
        <h1 class="text-center">LOGIN <span class="glyphicon glyphicon-user"></span></h1>
        <h4 class="text-center bg-warning"><?php display_message(); ?></h4>
        <div class="col-sm-4 col-sm-offset-5">
            <form class="" action="" method="post" enctype="multipart/form-data">

                <?php login_user(); ?>

                <hr>

                <div class="form-group"><label for="">
                        USERNAME <span class="glyphicon glyphicon-star"></span><input type="text" name="username" class="form-control"></label>
                </div>
                <div class="form-group"><label for="password">
                        PASSWORD <span class="glyphicon glyphicon-star"></span><input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </header>
</div>

<?php include "../resources/templates/front/footer.php"; ?>