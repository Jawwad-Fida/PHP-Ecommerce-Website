<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--Side Navigation (Categories)  -->
        <?php include "includes/front/side_nav.php";  ?>

        <div class="col-md-9">

            <div class="row carousel-holder">
                <div class="col-md-12">

                    <!-- Slider -->
                    <?php include "includes/front/slide.php";  ?>

                </div>
            </div>


            <div class="row">

                <?php
                //$stmt = get_products(); //get all products
                $stmt_limit = paginate2_and_limit_products_per_page();

                while ($row = $stmt_limit->fetch(PDO::FETCH_ASSOC)) {
                    $product_id = $row['product_id'];
                    $product_title =  $row['product_title'];
                    $product_category_title =  $row['product_category_title'];
                    $product_price =  $row['product_price'];
                    $product_image =  $row['product_image'];
                    $product_reviews =  $row['product_reviews'];

                    //shrink some content
                    $product_short_description = substr($row['product_short_description'], 0, 100);
                    $image_directory = change_image_directory();

                    //close php tags
                ?>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">

                            <img class="img-responsive" src="<?php echo $image_directory; ?>/<?php echo $product_image; ?>" alt="320x150">

                            <div class="caption">
                                <h4 class="pull-right"><?php echo $product_price; ?> TK</h4>
                                <h4><a href="item.php?id=<?php echo $product_id; ?>" target="_blank"><?php echo $product_title; ?></a>
                                </h4>
                                <p><?php echo $product_short_description; ?></p>
                            </div>

                            <div class="ratings">
                                <p class="pull-right"><?php echo $product_reviews; ?> reviews</p>
                                <p>
                                    <a href="item.php?id=<?php echo $product_id; ?>" class="btn btn-primary" target="_blank">View Item</a>
                                </p>
                            </div>

                        </div>
                    </div>

                <?php      } ?>

            </div>

        </div>

        <?php paginate_1(); ?>

    </div>

</div>
<!-- /.container -->


<!-- Footer -->
<?php include "includes/front/footer.php";  ?>