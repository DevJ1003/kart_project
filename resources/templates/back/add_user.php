<?php require_once("../../resources/config.php");

include "../../resources/templates/back/header.php";

?>

</div>

<div id="page-wrapper">


    <h1 class="page-header">
        Add User
    </h1>

    <div class="col-md-6 user_image_box">
        <span id="user_admin" class='fa fa-user fa-4x'></span>
    </div>


    <form action="" method="post" enctype="multipart/form-data">

        <?php add_user(); ?>

        <div class="col-md-6">

            <div class="form-group">
                <input type="file" name="file">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="form-group">
                <label for="firstname">FirstName</label>
                <input type="text" name="firstname" class="form-control">
            </div>

            <div class="form-group">
                <label for="lastname">LastName</label>
                <input type="text" name="lastname" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" name="add_user" class="btn btn-primary pull-right" value="Add User">
            </div>

        </div>
    </form>

</div>
<!-- /#page-wrapper -->

<?php include "../../resources/templates/back/footer.php"; ?>