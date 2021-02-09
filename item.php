<!-- Header -->
<?php include "includes/front/header.php";  ?>


<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>


<!-- Page Content -->
<div class="container">

    <!-- Side Navigation -->
    <?php include "includes/front/side_nav.php";  ?>

    <?php

    if (isset($_GET['id'])) {
        $the_product_id = $_GET['id'];

        $stmt = get_single_product($the_product_id);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_title =  $row['product_title'];
            $product_price =  $row['product_price'];
            $product_image =  $row['product_image'];
            $product_reviews =  $row['product_reviews'];
            $product_description = $row['product_description'];
            $product_short_description = $row['product_short_description'];

            $image_directory = change_image_directory();
        }
    }
    ?>


    <div class="col-md-9">

        <!--Row For Image and Short Description-->

        <div class="row">

            <!-- IMAGE OF ITEM -->
            <div class="col-md-7">
                <!-- Since the image is responsive, it will adjust itself -->
                <img class="img-responsive" src="<?php echo $image_directory; ?>/<?php echo $product_image; ?>" alt="700x600">
            </div>

            <!-- LEFT DESCRIPTION WITH ADD TO CART OPTION -->
            <div class="col-md-5">
                <div class="thumbnail">
                    <div class="caption-full">

                        <h4 style='font-weight:bold;color:darkslategrey;font-size:20px'><?php echo $product_title; ?></h4>
                        <hr>
                        <h4 class="">Price = <?php echo $product_price; ?> TK</h4>

                        <p><?php echo $product_short_description; ?></p>

                        <?php if (is_logged_in() == true) : ?>
                            <a class="btn btn-primary" target="_blank" href="checkout.php?add=<?php echo $the_product_id; ?>">Add to Cart</a>
                        <?php endif; ?>

                        <?php if (is_logged_in() == false) : ?>
                            <p style='color:red;font-size:20px;font-weight:bold'>Login to add item to cart!
                            <p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <!--Row For Image and Short Description-->

        <hr>

        <!--Row for Tab Panel-->

        <div class="row">

            <div role="tabpanel">

                <!-- Nav tabs to switch between description and Reviews -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="home">
                        <p></p>
                        <p><?php echo $product_description; ?></p>
                        <p><?php echo $product_description; ?></p>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="col-md-6">

                            <h3><?php echo $product_reviews; ?> reviews From</h3>
                            <hr>

                            <?php
                            //$stmt = get_products(); //get all products
                            $stmt = get_comments($the_product_id);

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $comment_content = $row['comment_content'];
                                $comment_author =  $row['comment_author'];
                                $comment_date =  $row['comment_date'];    
                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <strong><?php echo $comment_author; ?></strong>
                                    <span class="pull-right"><?php echo $comment_date; ?></span>
                                    <p><?php echo $comment_content; ?></p>
                                </div>
                            </div>

                            <?php } ?>

                            <hr>
                        </div>

                        <div class="col-md-6">
                            <h3>Add A review</h3>

                            <?php if (is_logged_in() == true) : ?>

                            <form action="" class="form-inline" method="post">

                                <?php insert_comment($the_product_id, $product_title); ?>

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="comment_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="comment_email" class="form-control">
                                </div>

                                <br>
                                <br>

                                <div class="form-group">
                                    <textarea name="comment_content" id="" cols="60" rows="10" class="form-control"></textarea>
                                </div>

                                <br>
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary" value="submit">
                                </div>
                            </form>

                            <?php endif; ?>

                            <?php if (is_logged_in() == false) : ?>
                            <p style='color:red;font-size:20px;font-weight:bold'>Please Login to Comment!
                            <p>
                        <?php endif; ?>

                        </div>

                    </div>
                </div>

            </div>


        </div>
        <!--Row for Tab Panel-->


    </div>

</div>
<!-- /.container -->


<!-- Footer -->
<?php include "includes/front/footer.php"; ?>