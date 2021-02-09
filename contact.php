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

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>


<!-- Contact Section -->
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
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-heading">Contact Us</h2>
            <h3 class="section-subheading text-muted"></h3>
        </div>
    </div>

    <section id="login">
        <div class="container">

            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">

                    <div class="form-wrap">

                        <form role="form" action="" method="post" autocomplete="off">

                        <?php contact_support($SMTP_HOST,$SMTP_PORT,$SMTP_USER,$SMTP_PASSWORD,$mail,$SMTP_ENCRYPTION);  ?>

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your E-mail">
                            </div>

                            <div class="form-group">
                                <label for="email" class="sr-only">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Enter your Subject">
                            </div>

                            <div class="form-group">
                                <label for="email" class="sr-only">Message</label>
                                <textarea class="form_control" name="body" cols="74" rows="10" placeholder="Enter your message"></textarea>
                            </div>

                            <input type="submit" name="contact_submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">

                        </form>

                    </div>

                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->

        </div> <!-- /.container -->


    </section>


</div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include "includes/front/footer.php";  ?>