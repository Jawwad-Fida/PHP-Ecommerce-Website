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

            <!-- FIRST ROW WITH PANELS -->

            <!-- /.row -->
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>

                                <?php
                                $stmt = display_report();
                                $number_of_orders = count_records($stmt);
                                ?>

                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $number_of_orders; ?></div>
                                    <div>Orders!</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>


                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>

                                <?php
                                $stmt = get_products();
                                $number_of_products = count_records($stmt);
                                ?>

                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $number_of_products; ?></div>
                                    <div>Products!</div>
                                </div>
                            </div>
                        </div>

                        <a href="products.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>

                                <?php
                                $stmt = get_categories();
                                $number_of_categories = count_records($stmt);
                                ?>

                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $number_of_categories; ?></div>
                                    <div>Categories!</div>
                                </div>
                            </div>
                        </div>

                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>

                    </div>
                </div>

            </div>

            <!-- /.row -->


            <!-- SECOND ROW WITH TABLES-->

            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 style='text-align:center' class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                        </div>

                        <div class="panel-body">
                            <div class="table table-responsive">
                                <table class="table table-bordered table-hover table-striped ">

                                    <thead>
                                        <tr>
                                            <th>Order No.</th>
                                            <th>Customer Name</th>
                                            <th>Phone No.</th>
                                            <th>City</th>
                                            <th>Trans. Status</th>
                                            <th>Trans. Id</th>
                                            <th>Total Items</th>
                                            <th>Order Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                         $stmt = display_report();
                                         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                             $order_id = $row['id'];
                                             $name =  $row['name'];
                                             $phone =  $row['phone'];
                                             $city =  $row['city'];
                                             $status =  $row['status'];
                                             $transaction_id =  $row['transaction_id'];
                                             $total_items =  $row['total_items'];
                                             $order_date =  $row['order_date'];

                                        ?>

                                        <tr>
                                            <td><?php echo $order_id; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $phone; ?></td>
                                            <td><?php echo $city; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $transaction_id; ?></td>
                                            <td><?php echo $total_items; ?></td>
                                            <td><?php echo $order_date; ?></td>
                                        </tr>

                                         <?php } ?>

                                    </tbody>

                                </table>
                            </div>
                            <!--
                            <div class="text-right">
                                <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                           -->

                        </div>

                    </div>
                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Footer -->
    <?php include "../includes/back/footer.php";  ?>