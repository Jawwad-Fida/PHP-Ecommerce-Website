<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
include(__DIR__ . "/vendor/autoload.php");
?>

<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>


<!-- Mail Section -->
<?php
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load(); //works here

//Mailtrap Credentials
$SMTP_HOST = getenv('SMTP_HOST');
$SMTP_PORT = getenv('SMTP_PORT');
$SMTP_USER = getenv('SMTP_USER');
$SMTP_PASSWORD = getenv('SMTP_PASSWORD');
$mail = new PHPMailer(true);
 //echo get_class($mail); //find out if class is available
$SMTP_ENCRYPTION = PHPMailer::ENCRYPTION_STARTTLS;
?>


<div class="container">

    <div class="form-gap"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" action="" role="form" autocomplete="off" class="form" method="post">

                                <?php forgot_password($SMTP_HOST,$SMTP_PORT,$SMTP_USER,$SMTP_PASSWORD,$mail,$SMTP_ENCRYPTION);  ?>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="Enter your E-mail Address" class="form-control" type="email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="forgot_submit" class="form-control btn btn-primary">Send Reset Email</button>
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


</div>

</div>

<!-- /.container -->

<!-- Footer -->
<?php include "includes/front/footer.php";  ?>