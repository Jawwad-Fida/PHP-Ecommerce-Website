<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<?php
//delete product based on report id 
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    $stmt = delete_product($product_id);
    redirect("products.php?success=product_delete");
}
?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "../includes/back/nav.php";  ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">

                <h1 style="text-align:center" class="page-header">
                    All Products
                </h1>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $stmt = get_products();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $product_id = $row['product_id'];
                            $product_title =  $row['product_title'];
                            $product_category_title =  $row['product_category_title'];
                            $product_price =  $row['product_price'];
                            $product_image =  $row['product_image'];
                            $product_quantity =  $row['product_quantity'];

                            $image_directory = change_image_directory();
                        ?>

                            <tr>
                                <td><?php echo $product_id; ?></td>
                                <td><?php echo $product_title; ?><br>
                                    <img width="100" src="../<?php echo $image_directory;?>/<?php echo $product_image;?>">
                                </td>
                                <td><?php echo $product_category_title; ?></td>
                                <td><?php echo $product_price; ?></td>
                                <td><?php echo $product_quantity; ?></td>
                                <td>
                                    <a class="btn btn-success" href="edit_product.php?edit=<?php echo $product_id; ?>">Edit</a>
                                    <a class="btn btn-danger" href="products.php?delete=<?php echo $product_id; ?>"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>

                        <?php  } ?>

                    </tbody>
                </table>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


</div>
<!-- /#wrapper -->

<!-- Footer -->
<?php include "../includes/back/footer.php";  ?>