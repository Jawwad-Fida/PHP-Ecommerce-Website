<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Page Content -->
<div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
        <h1 style='text-align:center'>Latest Features!</h1>
    </header>

    <hr>

    <!-- Page Features -->
    <div class="row text-center">

        <?php

        if (isset($_GET['title'])) {
            $the_category_title = $_GET['title'];

            $stmt = get_category_items($the_category_title);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product_id = $row['product_id'];
                $product_title =  $row['product_title'];
                $product_price =  $row['product_price'];
                $product_image =  $row['product_image'];

                //shrink some content
                $product_short_description = substr($row['product_short_description'], 0, 100);

                $image_directory = change_image_directory();
        ?>

                <div class="col-md-3 col-sm-6 hero-feature">
                    <div class="thumbnail">
                        <img class="img-responsive" src="<?php echo $image_directory;?>/<?php echo $product_image; ?>" alt="">
                        <div id="caption_category">
                            <h3><?php echo $product_title; ?></h3>
                            <p><?php echo $product_short_description; ?></p>
                            <p>
                                <?php if (is_logged_in() == true) : ?>
                                    <a class="btn btn-primary" target="_blank" href="checkout.php?add=<?php echo $product_id; ?>">Add to Cart</a>
                                <?php endif; ?>

                                <?php if (is_logged_in() == false) : ?>
                                    <small style='color:red;font-weight:bold;font-size:15px;'>Login to add item to cart!</small>
                                <?php endif; ?>

                                        <a target="_blank" href="item.php?id=<?php echo $product_id; ?>" class="btn btn-default">More Info</a>
                             </p>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/front/footer.php";  ?>