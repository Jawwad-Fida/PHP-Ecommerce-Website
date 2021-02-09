<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>


<div class="form-gap"></div>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">

                        <h3><i class="fa fa-user fa-4x"></i></h3>
                        <h2 class="text-center">Login</h2>
                        <div class="panel-body">


                            <form id="login-form" action="" role="form" autocomplete="off" class="form" method="post">

                                <!-- login in user using function (function has to be inside form) -->
                                <?php login_user(); ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                        <input name="username" type="text" class="form-control" placeholder="Enter your Username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                        <input name="password" type="password" class="form-control" placeholder="Enter your Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="login_submit" class="form-control btn btn-primary">LOG IN</button>
                                </div>

                                <div class="form-group">
                                    <!-- Pass a random link - makes it look better--> <!-- Forgotten Password System (make it later) -->
                                    <a class="btn btn-danger" href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a>
                                </div>

                            </form>

                        </div><!-- Body-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include "includes/front/footer.php";  ?>