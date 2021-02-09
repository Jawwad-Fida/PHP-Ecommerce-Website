<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "../includes/back/nav.php";  ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="col-md-12">

                    <div class="row">
                        <h1 class="page-header">
                            Add Product
                        </h1>
                    </div>

                    <form action="" method="post" enctype="multipart/form-data">

                        <!-- add_product (publish) using function (function has to be inside form) -->
                        <?php add_product(); ?>

                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="product-title">Product Title </label>
                                <input type="text" name="product_title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="product-title">Product Description</label>
                                <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="product-title">Product Short Description</label>
                                <textarea name="product_short_description" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="form-group row">

                                <div class="col-xs-3">
                                    <label for="product-price">Product Price (BDT)</label>
                                    <input type="number" name="product_price" class="form-control" size="60">
                                </div>
                            </div>

                        </div>
                        <!--Main Content-->

                        <!-- SIDEBAR-->

                        <aside id="admin_sidebar" class="col-md-4">

                            <!-- Two submit buttons doing two different operations -->

                            <div class="form-group">
                                <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                                <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
                            </div>
                            <hr>

                            <!-- Product Categories-->

                            <div class="form-group">
                                <label for="category title">Post Category title</label>
                                <select name="product_category" id="post_category" class="form-control">

                                    <?php
                                    $stmt = get_categories();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $cat_title = $row['cat_title'];
                                        echo "<option value='{$cat_title}'>{$cat_title}</option>";
                                    }
                                    ?>

                                </select>
                            </div>

                            <!-- Product Quantity -->

                            <div class="form-group">
                                <label for="product-title">Product Quantity</label>
                                <input type="text" name="product_quantity" class="form-control">
                            </div>

                            <!-- Product Tags -->

                            <div class="form-group">
                                <label for="product-title">Product Keywords</label>
                                <input type="text" name="product_tags" class="form-control">
                            </div>

                            <!-- Product Image -->
                            <div class="form-group">
                                <label for="product-title">Product Image</label>
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
        <?php include "../includes/back/footer.php";  ?>