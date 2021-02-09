<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>


<section id="login">
    <div class="container">

        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">

                <div class="form-wrap">

                    <h1 style='text-align:center'>Registration for New Customer</h1>
                    <br>

                    <form role="form" action="" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">

                        <!-- register user using function (function has to be inside form) -->
                        <?php register_user(); ?>

                        <div class="form-group">
                            <!-- Upload Image  -->
                            <img style='display:block;margin-left:auto;margin-right:auto' src="http://placehold.it/200x200" alt="320x150">
                            <label for="post_image">User Image</label>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Customer Name</label>
                            <input type="text" name="customer_name" id="username" class="form-control" placeholder="Enter your name">
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your E-mail">
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Enter your password">
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Repeat Password</label>
                            <input type="password" name="password_repeat" id="key" class="form-control" placeholder="Repeat the password">
                        </div>

                        <input type="submit" name="register_submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">

                    </form>

                </div>

            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->

    </div> <!-- /.container -->
</section>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include "includes/front/footer.php";  ?>