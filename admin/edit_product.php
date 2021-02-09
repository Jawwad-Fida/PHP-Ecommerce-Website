<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<?php
//Get product data based on id

if (isset($_GET['edit'])) {

    $product_id = $_GET['edit'];
    $stmt = get_single_product($product_id);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $product_id = $row['product_id'];
        $product_title =  $row['product_title'];
        $product_category_title =  $row['product_category_title'];
        $product_price =  $row['product_price'];
        $product_image =  $row['product_image'];
        $product_quantity =  $row['product_quantity'];
        $product_description = $row['product_description'];
        $product_keywords = $row['product_keywords'];
        $product_short_description = $row['product_short_description'];

        $image_directory = change_image_directory();
    }
}
?>



<div id="wrapper">

    <!-- Navigation -->
    <?php include "../includes/back/nav.php";  ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="col-md-12">

                <div class="row">
                    <h1 class="page-header">
                        Edit Product
                    </h1>
                </div>

                <form action="#" method="post" enctype="multipart/form-data">

                    <!-- edit_product using function (function has to be inside form) -->
                    <?php edit_product($product_id); ?>

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
                            <textarea name="product_short_description" id="" cols="30" rows="3" class="form-control"><?php echo $product_short_description; ?></textarea>
                        </div>

                        <div class="form-group row">

                            <div class="col-xs-3">
                                <label for="product-price">Product Price (BDT)</label>
                                <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
                            </div>
                        </div>

                    </div>
                    <!--Main Content-->

                    <!-- SIDEBAR-->

                    <aside id="admin_sidebar" class="col-md-4">


                        <div class="form-group">
                            <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                            <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Update">
                        </div>
                        <hr>

                        <!-- Product Categories-->

                        <div class="form-group">
                            <label for="category title">Product Category</label>
                            <select name="product_category" id="" class="form-control">
                                <!-- If any option is not selected, default is chosen-->
                                <?php
                                //Display all categories from the database

                                //using categories table (cat_title) to relate with product table (product_category_title) (LINK = relation table)

                                $stmt = get_categories();

                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $cat_title = $row['cat_title'];

                                    if ($cat_title == $product_category_title) {
                                        //selected attribute -  specifies that an option should be pre-selected when the page loads.
                                        //The pre-selected option will be displayed first in the drop-down list.
                                        echo "<option selected value='$cat_title'>{$cat_title}</option>";
                                    } else {
                                        echo "<option value='$cat_title'>{$cat_title}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Product Quantity -->

                        <div class="form-group">
                            <label for="product-title">Product Quantity</label>
                            <input type="text" name="product_quantity" value="<?php echo $product_quantity; ?>" class="form-control">
                        </div>

                        <!-- Product Tags -->

                        <div class="form-group">
                            <label for="product-title">Product Keywords</label>
                            <input type="text" name="product_tags" value="<?php echo $product_keywords; ?>" class="form-control">
                        </div>

                        <!-- Product Image -->
                        <div class="form-group">
                            <label for="product-title">Product Image</label>
                            <img width="100" src="../<?php echo $image_directory; ?>/<?php echo $product_image; ?>">
                            <input type="file" name="product_image">
                        </div>

                    </aside>
                    <!--SIDEBAR-->

                </form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Footer -->
    <?php include "../includes/back/footer.php"; ?>