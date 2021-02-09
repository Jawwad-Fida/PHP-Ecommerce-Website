<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>


<?php
//delete slide based on slide id 
if (isset($_GET['delete'])) {
    $slide_id = $_GET['delete'];
    $stmt = delete_slide($slide_id);
    redirect("slides.php?success=slide_delete");
}
?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include "../includes/back/nav.php";  ?>

  <div id="page-wrapper">

    <div class="container-fluid">

    <h1>Thumbnails Available</h1>

    <?php
    $stmt = get_slide_thumbnail();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $slide_id = $row["slide_id"];
      $slide_image =  $row['slide_image'];
      $image_directory = change_image_directory();

    ?>

      <!-- Creating thumbnails using boostrap CSS-->
      <div class="col-xs-6 col-md-3">

        <a href="slides.php?delete=<?php echo $slide_id; ?>">
          <img class="img-responsive slide_image" src="../<?php echo $image_directory; ?>/<?php echo $slide_image; ?>" alt="200x100">
        </a>

      </div>

      <?php } ?>

      <div class="col-lg-12">

        <div class="col-md-12">

          <div class="row">

          <p>(Delete thumbnails by clicking on them)</p>

            <h3 class="bg-success"></h3>

            <div class="col-xs-3">

              <!---------  Form ------->

              <form action="" method="post" enctype="multipart/form-data">

                <!-- add_slide using function (function has to be inside form) -->
                <?php add_slide(); ?>

                <div class="form-group">
                  <input type="file" name="slide_image">
                </div>

                <div class="form-group">
                  <label for="title">Slide Title</label>
                  <input type="text" name="slide_title" class="form-control">
                </div>

                <div class="form-group">
                  <input type="submit" name="slide_submit">
                </div>

              </form>

            </div>

          </div>

        </div>

      </div>
      <!-- /.container-fluid -->

      <?php
      // get latest slide
      $stmt = get_current_slide_in_admin();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $slide_image =  $row['slide_image'];
        $image_directory = change_image_directory();
      ?>

        <div class="col-xs-8">
          <img class="img-responsive" src="../<?php echo $image_directory; ?>/<?php echo $slide_image; ?>" alt="800x300">
        </div>

      <?php } ?>

    </div>
    <!-- /#page-wrapper -->

  </div>

</div>
<!-- /#wrapper -->

<!-- Footer -->
<?php include "../includes/back/footer.php";  ?>

</div><!-- ROW-->

<hr>