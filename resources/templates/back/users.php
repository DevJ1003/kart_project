<?php require_once("../../resources/config.php");

include "../../resources/templates/back/header.php";

?>

</div>

<div id="page-wrapper">
    <div class="container-fluid">

        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-fw fa-user"></i>
                All Users...!!
            </h1>
            <h4 class="text-center bg-success"><?php display_message(); ?></h4>

            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Email-Id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php display_user(); ?>

                    </tbody>
                </table>
                <!--End of Table-->
            </div>

        </div>
        <!-- /#page-wrapper -->
        <a href="index.php?add_user" class="btn btn-primary">Add User <span class="glyphicon glyphicon-check"></span></a>

        <?php include "../../resources/templates/back/footer.php"; ?>