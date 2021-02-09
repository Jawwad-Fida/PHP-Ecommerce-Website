<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<div class="container">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form action="" id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <?php reset_password(); ?>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Enter new password" class="form-control" type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="password_repeat" placeholder="Repeat new password" class="form-control" type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="reset_submit" class="form-control btn btn-primary">Reset Password</button>
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

</div> <!-- /.container -->

<!-- Footer -->
<?php include "includes/front/footer.php";  ?>