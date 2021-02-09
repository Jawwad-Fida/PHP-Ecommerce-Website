<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<?php
//delete order based on report id 
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    $stmt = delete_order($order_id);
    redirect("orders.php?success=order_delete");
}
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "../includes/back/nav.php";  ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="col-md-12">

                <div class="row">
                    <h1 style='text-align:center' class="page-header">
                        Products Bought (From an Order)
                    </h1>
                </div>
                
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product ID</th>
                                <th>Product Title</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Receipt No.</th>
                                <th>Trans. ID</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $stmt = display_orders(); //from product_report table
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $report_id = $row['report_id'];
                                $product_id = $row['product_id'];
                                $product_title = $row['product_title'];
                                $product_price = $row['product_price'];
                                $product_quantity = $row['product_quantity'];
                                $receipt_number = $row['receipt_number'];
                                $transaction_id = $row['transaction_id'];
                                $order_date = $row['order_date'];
                            ?>

                                <tr>
                                    <td><?php echo $report_id; ?></td>
                                    <td><?php echo $product_id; ?></td>
                                    <td><?php echo $product_title; ?></td>
                                    <td><?php echo $product_price; ?></td>
                                    <td><?php echo $product_quantity; ?></td>
                                    <td><?php echo $receipt_number; ?></td>
                                    <td><?php echo $transaction_id; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><a href="orders.php?delete=<?php echo $report_id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                                </tr>

                            <?php } ?>

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