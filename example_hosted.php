<?php
session_start();
include(__DIR__ . "/includes/functions.php");
include(__DIR__ . "/includes/functions2.php");
//session_expire_function();
?>

<?php
if (isset($_SESSION['item_total'])) {
    $total_amount = $_SESSION['item_total'];
}

if (isset($_SESSION['item_quantity'])) {
    $total_items = $_SESSION['item_quantity'];
}
?>

<?php
if (isset($_SESSION)) {
    foreach ($_SESSION as $value) {
        if (strpos($value, 'item_name_') === 0) {
            $item_name = $_SESSION[$value];
            echo $item_name;
        }
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Example - Hosted Checkout | SSLCommerz</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>


<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Hosted (Checkout) Payment - SSLCommerz</h2>
            <p class="lead">No refunds on payment. Certain products have warranty valid in Bangladesh. VAT of 500 BDT is fixed on Total Price of Goods</p>
        </div>

        <!---------------------------- CART ON CHECKOUT PAGE --------------------------->

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill"><?php echo $total_items; ?> items</span>
                </h4>


                <?php
                if (isset($_POST['checkout_submit'])) {

                    foreach (array_keys($_POST) as $value) {
                        if (strpos($value, 'item_name_') === 0) {
                            $item_name = $_POST[$value];
                ?>
                            <!-- USE PHP here to retrive items -->
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0"><?php echo $item_name; ?></h6>
                                    </div>
                                <?php  } ?>

                                <?php if (strpos($value, 'quantity_') === 0) {
                                    $item_quantity = $_POST[$value];
                                ?>
                                    <span class="text-muted">Quantity = x<?php echo $item_quantity; ?></span>
                                <?php } ?>

                                <?php if (strpos($value, 'amount_') === 0) {
                                    $item_amount = $_POST[$value];
                                ?>
                                    <span class="text-muted"><?php echo $item_amount; ?> TK</span>
                                </li>
                            <?php } ?>

                    <?php
                    }
                }
                    ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong><?php echo $total_amount; ?> TK</strong> <!-- store this amount in a variable to be used in a form -->
                    </li>
                            </ul>
            </div>

            <!---------------------------------------------------------------------------->


            <!-------------------------- Form to insert customer billing information --------------------->

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>

                <form action="checkout_hosted.php" method="POST" class="needs-validation">
                    <div class="row">
                        <div class="col-md-12 mb-3">

                            <!-- customer_name -->

                            <label for="firstName">Full name</label>
                            <input type="text" name="customer_name" class="form-control" id="customer_name" value="<?php echo $_SESSION['cus_name']; ?>" required>

                            <div class="invalid-feedback">
                                Valid customer name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">

                        <label for="mobile">Mobile</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+88</span> <!-- Country code -->
                            </div>

                            <!-- customer_mobile -->
                            <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile: - 017xxxxx" required>

                            <div class="invalid-feedback" style="width: 100%;">
                                Your Mobile number is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">

                        <label for="email">Email <span class="text-muted">(Optional)</span></label>

                        <!-- customer_email -->
                        <input type="email" name="customer_email" class="form-control" id="email" value="<?php echo $_SESSION['cus_email']; ?>" required>

                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">

                        <label for="address">Address</label>

                        <!-- customer_address -->
                        <input type="text" name="customer_address" class="form-control" id="address" placeholder="Dhanmondi Road no. 7A" required>

                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <!-- 
                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" name="customer_address2" class="form-control" id="address2" placeholder="Apartment or suite">

                </div> -->


                    <div class="row">

                        <div class="col-md-5 mb-3">

                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <!-- <option value="">Choose...</option> -->
                                <option value="Bangladesh">Bangladesh</option>
                            </select>

                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>

                            <label for="state">City</label>
                            <!-- customer_state-->
                            <select name="customer_state" class="custom-select d-block w-100" id="state" required>
                                <option value="">Choose...</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Barisal">Barisal</option>
                                <option value="Chittagong">Chittagong</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Sylhet">Sylhet</option>
                                <option value="Rangpur">Rangpur</option>
                            </select>

                            <!-- fetch the sub-districts using php or google country-city-state example-->
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>


                        </div>

                        <div class="col-md-3 mb-3">

                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip_code" placeholder="xxxx" required>

                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>

                    </div>

                    

                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">

                        <input type="hidden" value="<?php echo $total_items; ?>" name="items" required />
                        <!-- amount (total amount => put the variable in value) -->
                        <input type="hidden" value="<?php echo $total_amount; ?>" name="amount" id="total_amount" required />
                        <!-- -->
                        <input type="hidden" value="<?php echo $ship_date = date("Y-m-d H:i:s"); ?>" name="ship_date" id="total_amount" required />
                      
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

                </form>

            </div>
        </div>


        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; Jawwadul Islam Fida's Ecommerce Website, <?php echo date("Y"); //dynamic date ?></p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>