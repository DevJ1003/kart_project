<?php require_once("../../resources/config.php");

include "../../resources/templates/back/header.php";

?>

</div>

<div id="page-wrapper">

  <h1 class="page-header">
    Home Page Slides...!!
  </h1>
  <h4 class="text-center bg-success"><?php display_message(); ?></h4>

  <div class="row">

    <div class="col-xs-3">

      <form action="" method="post" enctype="multipart/form-data">
        <?php add_slides(); ?>

        <div class="form-group">
          <label for="title">Slide Title</label>
          <input type="text" name="slide_title" class="form-control">
        </div>

        <div class="form-group">
          <input type="file" name="file">
        </div>

        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="add_slide" value="Submit">
        </div>

      </form>
    </div>

    <div class="col-xs-8">
      <?php get_current_slide_in_admin(); ?>
    </div>

  </div><!-- ROW-->

  <hr>

  <h1>Slides Available :</h1>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Slide_Id</th>
        <th>Title</th>
        <th>Image</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php display_slide();
      ?>

    </tbody>
  </table>
  <!--End of Table-->

</div>
<!-- /#page-wrapper -->

<?php include "../../resources/templates/back/footer.php"; ?>