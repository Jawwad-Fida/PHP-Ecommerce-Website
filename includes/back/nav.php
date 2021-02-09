<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Admin Panel</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

        <li><a href="../index.php">Home Page</a></li>
        <!-- Click to go back to Home page-->

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['user_name'] ?><b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">

            <li>
                <a href="orders.php"><i class="fa fa-fw fa-dashboard"></i> Orders</a>
            </li>

            <li>
                <a href="products.php"><i class="fa fa-fw fa-bar-chart-o"></i> View Products</a>
            </li>

            <li>
                <a href="add_product.php"><i class="fa fa-fw fa-table"></i> Add Product</a>
            </li>

            <li>
                <a href="categories.php"><i class="fa fa-fw fa-desktop"></i> Categories</a>
            </li>

            <li>
                <a href="users.php"><i class="fa fa-fw fa-wrench"></i>Users</a>
            </li>

            <li>
                <a href="slides.php"><i class="fa fa-fw fa-wrench"></i>Slides</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>