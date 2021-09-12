<?php require_once("../resources/config.php");

include "../resources/templates/front/header.php";

?>

<!-- Page Content -->
<div class="container">

    <header>
        <h1 class="text-center">REGISTRATION <span class="glyphicon glyphicon-user"></span></h1>
        <h4 class="text-center bg-warning"><?php display_message(); ?></h4>
        <div class="col-sm-4 col-sm-offset-5">
            <form class="form" action="" method="post" enctype="multipart/form-data">

                <?php register_user(); ?>

                <hr>

                <div class="form-group"><label for="">
                        Username <span class="glyphicon glyphicon-user"></span><input type="text" name="username" class="form-control"></label>
                </div>
                <div class="form-group"><label for="">
                        Firstname <span class="glyphicon glyphicon-lock"></span><input type="text" name="firstname" class="form-control"></label>
                </div>
                <div class="form-group"><label for="">
                        Lastname <span class="glyphicon glyphicon-lock"></span><input type="text" name="lastname" class="form-control"></label>
                </div>
                <div class="form-group"><label for="">
                        Email <span class="glyphicon glyphicon-envelope"></span><input type="text" name="email" class="form-control"></label>
                </div>
                <div class="form-group"><label for="password">
                        Password <span class="glyphicon glyphicon-eye-close"></span><input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                    <button name="register" type="submit" class="btn btn-info">Register <span class="glyphicon glyphicon-log-in"></span></button>
                </div>
            </form>
        </div>
    </header>
</div>

<?php include "../resources/templates/front/footer.php"; ?>