<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Top Navigation -->


<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>


<?php
//Attaching a PRODUCT ID to a session - TESTING
//echo $_SESSION['product_1'];
//echo $_SESSION['item_total'];
?>


<!-- Page Content -->
<div class="container">

    <!-- /.row -->

    <div class="row">

        <h1>Cart</h1>

        <form action="example_hosted.php" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>

                    </tr>
                </thead>
                <tbody>
                    <?php cart_system(); ?>
                </tbody>
            </table>

            <!-- If cart is empty, then we dont want user to proceeed to checkout. Hide the button -->
            <?php
            if (isset($_SESSION['item_total'])) {
                if ($_SESSION['item_total'] == '0') {
                    echo "<p style='color:red;font-size:25px'>Cart is Empty!<p>";
                } else {
                    echo "<input class='btn btn-primary' type='submit' name='checkout_submit' value='Checkout'>";
                }
            }
            ?>
        </form>

        <!--  ***********CART TOTALS*************-->

        <div class="col-xs-4 pull-right ">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">

                <tr class="cart-subtotal">
                    <th>Items:</th>
                    <td><span class="amount">
                            <?php
                            //get total no.of items of cart - stored in a session
                            echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";
                            ?>
                        </span></td>
                </tr>
                <tr class="shipping">
                    <th>Shipping and Handling</th>
                    <td>Free Shipping</td>
                </tr>
                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount">
                                <?php
                                //get total amount of cart - stored in a session
                                echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";
                                ?> TK
                            </span></strong> </td>
                </tr>

                </tbody>

            </table>

        </div><!-- CART TOTALS-->


    </div>
    <!--Main Content-->
</div>
<!-- /.container -->

<!-- Footer -->
<?php include "includes/front/footer.php";  ?>