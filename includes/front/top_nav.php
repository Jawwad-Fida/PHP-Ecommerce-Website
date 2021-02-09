<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home Page</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li>
                    <a href="shop.php">Shop</a>
                </li>

                <?php if (is_logged_in() == true) : ?>
                    <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="contact.php">Contact</a>
                </li>

                <li>
                    <a href="search.php">Search</a>
                </li>

                <?php if (is_logged_in() == false) : ?>
                    <li>
                        <a href="registration.php">Registration</a>
                    </li>
                <?php endif; ?>

                <?php if (is_admin()) : ?>
                    <li>
                        <a href="admin/index.php">Admin</a>
                    </li>
                <?php endif; ?>

                <?php if (is_logged_in() == false) : ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                <?php endif; ?>

                <?php if (is_logged_in() == true) : ?>
                    <li>
                        <a href="includes/logout.php">Logout</a>
                    </li>
                <?php endif; ?>

            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>