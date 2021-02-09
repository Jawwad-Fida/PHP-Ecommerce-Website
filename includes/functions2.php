<?php
//---------2nd LIST OF FUNCTIONS -------
// 1) Contact Page, Forgotten Password, and Password Reset Functions
// 2) Cart Functions
// 3) Order Functions
// 4) User Functions (Admin Panel)
// 5) Dynamic Slides (on index.php)
// 6) Pagination
//--------------------------------


//======================================== Contact, Forgotten Password, Reset Password ============================================

//sending mail in contact page (contact.php)
function contact_support(string $SMTP_HOST, int $SMTP_PORT, string $SMTP_USER, string $SMTP_PASSWORD, $mail, $SMTP_ENCRYPTION)
{
    if (isset($_POST['contact_submit'])) {
        $email_to = "skyabyss13@gmail.com"; //our email address
        $email_from = validate($_POST['email']); //format the headers - email_from
        $subject = validate($_POST['subject']);
        $message_body = validate($_POST['body']);

        //Error message
        if (empty($email_from) || empty($subject) || empty($message_body)) {
            redirect("contact.php?error=emptyFields");
            exit();
        }

        $subject = wordwrap($subject, 70); // use wordwrap() if lines are longer than 70 characters

        //Setting up PHPMAILER

        try {
            //access class

            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                   
            $mail->isSMTP();
            $mail->Host = $SMTP_HOST;
            $mail->Username = $SMTP_USER;
            $mail->Password = $SMTP_PASSWORD;
            $mail->Port = $SMTP_PORT;
            $mail->SMTPSecure = $SMTP_ENCRYPTION;
            $mail->SMTPAuth = true;

            //Recipients
            $mail->setFrom($email_from, 'Admin');
            $mail->addAddress($email_to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message_body;

            $mail->send();

            redirect("contact.php?success=contact_sent");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

//initiate forgotten password request - in forgot.php
function forgot_password(string $SMTP_HOST, int $SMTP_PORT, string $SMTP_USER, string $SMTP_PASSWORD, $mail, $SMTP_ENCRYPTION)
{
    if (isset($_POST['forgot_submit'])) {
        $customer_email = validate($_POST['email']);

        //Error messages
        if (empty($customer_email)) {
            redirect("forgot.php?error=emptyFields");
            exit();
        }

        //check if email exists
        if (email_does_not_exist($customer_email) == 'true') {
            redirect("forgot.php?error=no_email");
            exit();
        }

        //Creating Tokens
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        //Updating database with token values
        $stmt = prepare_query("UPDATE users SET token=? WHERE user_email=?");
        $stmt->bindParam(1, $token, PDO::PARAM_STR);
        $stmt->bindParam(2, $customer_email, PDO::PARAM_STR);
        $stmt->execute();
        unset($stmt); //close off prepare statement

        //Setting up PHPMAILER

        try {
            //access class

            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                   
            $mail->isSMTP();
            $mail->Host = $SMTP_HOST;
            $mail->Username = $SMTP_USER;
            $mail->Password = $SMTP_PASSWORD;
            $mail->Port = $SMTP_PORT;
            $mail->SMTPSecure = $SMTP_ENCRYPTION;
            $mail->SMTPAuth = true;

            //Recipients
            $mail->setFrom('jawwadFida@example.com', 'Jawwad Fida');
            $mail->addAddress($customer_email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Email';
            $mail->Body = "<p>Please click here to reset your password: - 
            <a href='http://localhost/phpDemo/PHP%20Ecommerce%20Website/reset.php?email={$customer_email}&token={$token}' target='_blank'>http://localhost/phpDemo/PHP%20Ecommerce%20Website/reset.php?email={$customer_email}&token={$token}</a>
            </p>";

            $mail->send();
            redirect("forgot.php?success=forgot_sent");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

//reset password in reset.php
function reset_password()
{
    //prevent user from coming to reset page if there is no email or token in url
    if (!isset($_GET['email']) && !isset($_GET['token'])) {
        redirect("Location: index.php");
    } else {

        if (isset($_POST['reset_submit'])) {

            //we have to make sure that the information we are receiving from the email belongs to the right user
            $customer_email = $_GET['email'];
            $token = $_GET['token'];

            $stmt = query("SELECT username,user_email,token FROM users WHERE token='{$token}'");

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //check if the tokens and email from url match the correct user in database
            if ($_GET['token'] !== $row['token'] || $_GET['email'] !== $row['email']) {
                header("Location: index.php");
            }

            $customer_password = validate($_POST['password']);
            $password_repeat = validate($_POST['password_repeat']);
            $password_size = strlen($customer_password); //get size of password

            //CHECKING FOR ERRORS
            if (empty($customer_password) || empty($password_repeat)) {
                redirect("reset.php?error=emptyFields");
                exit();
            } elseif ($password_size <= 4) {
                //check if length of password is valid
                redirect("reset.php?error=invalid_pwd_length");
                exit();
            } elseif ($customer_password !== $password_repeat) {
                //check if password are same
                redirect("reset.php?error=pwd_no_match");
                exit();
            }

            //updating password and token columns

            $passwordHash = password_hash($customer_password, PASSWORD_DEFAULT);
            $token_update = "Token Used";  //once we are done using the token, we don't want it anymore

            $stmt = prepare_query("UPDATE users SET token=?,user_password=? WHERE user_email=?");
            $stmt->bindParam(1, $token_update, PDO::PARAM_STR);
            $stmt->bindParam(2, $passwordHash, PDO::PARAM_STR);
            $stmt->bindParam(3, $customer_email, PDO::PARAM_STR);
            $stmt->execute();
            unset($stmt); //close off prepare statement

            redirect("login.php?success=reset"); //on success,re-direct to login page
        }
    }
}

//====================================================================================================



//======================================== Cart Functions ============================================

function get_cart_item($product_id)
{
    $stmt = query("SELECT * FROM products WHERE product_id={$product_id}");
    return $stmt;
}

function get_all_cart_items($id)
{
    $stmt = query("SELECT * FROM products WHERE product_id={$id}");
    return $stmt;
}


//----------MAIN FUNCTIONS OF CART - responsible for displaying items--------


function display_cart()
{
    $total = 0;
    $item_quantity = 0;

    //variables to keep track of cart items
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;


    //operation on session variable (associative array) => $name = session name, $value = session data
    foreach ($_SESSION as $name => $value) {

        if ($value > 0) { //preventing multiple data to be shown

            //grab the session that we need
            //start at 0th character till 8th 
            if (substr($name, 0, 8) == "product_") {

                //pull product_id(session id) out of session
                $length = strlen($name) - 8;
                $id = substr($name, 8, $length);

                //$value contains the quantity of the item added

                $stmt = get_all_cart_items($id);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    //find sub-total of items 
                    $sub = $row['product_price'] * $value;

                    //find total no.of items
                    $item_quantity += $value;

                    $image_directory = change_image_directory();

                    echo "<tr>
                           <td>{$row['product_title']}
                           <br>
                           <img width='100' src='$image_directory/{$row['product_image']}'>
                           </td>
                           <td>{$row['product_price']} TK</td>
                           <td>{$value}</td>
                           <td>{$sub} TK</td>
                        <td>
                           <a class='btn btn-warning' href='checkout.php?remove={$row['product_id']}'><span class='glyphicon glyphicon-minus'></span></a>
                           <a class='btn btn-success' href='checkout.php?add={$row['product_id']}'><span class='glyphicon glyphicon-plus'></span></a>
                           <a class='btn btn-danger' href='checkout.php?delete={$row['product_id']}'><span class='glyphicon glyphicon-remove'></span></a>
                        </td>
                     </tr>";

                    //echo "
                    //<input type='hidden' name='carts[]' value='{$row['product_title']}'>
                    // <input type='hidden' name='carts[]' value='{$row['product_id']}'>
                    // <input type='hidden' name='carts[]' value='{$row['product_price']}'>
                    //<input type='hidden' name='carts[]' value='{$value}'>
                    //";

                    //in order to have different items, we need underscore(_)
                    echo "
                     <input type='hidden' name='item_name_{$item_name}' value='{$row['product_title']}'>
                     <input type='hidden' name='item_number_{$item_number}' value='{$row['product_id']}'>
                     <input type='hidden' name='amount_{$amount}' value='{$row['product_price']}'>
                     <input type='hidden' name='quantity_{$quantity}' value='{$value}'>
                     ";

                    //increment the values as u loop - these are info to checkout
                    $item_name++;
                    $item_number++;
                    $amount++;
                    $quantity++;
                }

                //grab the sub-totals to calculate total amount
                //echo $total += $sub;
                $total += $sub;
                $_SESSION['item_total'] = $total;

                //grab the total no.of items
                $_SESSION['item_quantity'] =  $item_quantity;
            }
        }
    }
}


function cart_system()
{
    //Detect product_id from url

    if (isset($_GET['add'])) {

        //--------ADD ITEM TO CART----------

        $stmt = get_cart_item($_GET['add']);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            //if we have item available, then add it to cart 
            if ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
                //join product_id to session, and
                //increment item

                $_SESSION['product_' . $_GET['add']] += 1;
                redirect("checkout.php?success=product_add");
            } else {
                //if we dont have the item available (quantity=0), prevent adding to cart
                redirect("checkout.php?error=not_available");
            }
        }
    }


    if (isset($_GET['remove'])) {

        //--------Remove ITEM FROM CART----------

        //if nothing is in cart, remove won't work
        if ($_SESSION['product_' . $_GET['remove']] < 1) {
            redirect("checkout.php?error=cart_empty");
        } else {
            //item is in cart, remove item
            $_SESSION['product_' . $_GET['remove']] -= 1;

            if ($_SESSION['product_' . $_GET['remove']] < 1) {
                //when cart becomes empty - unset cart values (sessions)
                unset($_SESSION['item_total']);
                unset($_SESSION['item_quantity']);
            }
            redirect("checkout.php?success=item_removed");
        }
    }


    if (isset($_GET['delete'])) {

        //--------DELETE ITEM FROM CART----------

        $_SESSION['product_' . $_GET['delete']] = '0'; //'0' has to be string

        //unset cart values (sessions) - when cart becomes empty
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);

        redirect("checkout.php?success=item_deleted");
    }

    display_cart();
}




//====================================================================================================




//======================================== Order Functions ============================================

function display_orders()
{
    //from product_report table in orders section
    $stmt = query("SELECT * FROM product_report ORDER BY report_id DESC"); //from product_report table
    return $stmt;
}

function delete_order(int $id)
{
    $stmt = query("DELETE FROM product_report WHERE report_id={$id}");
    return $stmt;
}

function display_report()
{
    //from orders table in homepage
    $stmt = query("SELECT * FROM orders ORDER BY id DESC"); //from product_report table
    return $stmt;
}


//======================================================================================================




//======================================== User Functions (Admin Panel) ============================================

function display_users()
{
    $stmt = query("SELECT * FROM users");
    return $stmt;
}

function delete_user(int $id)
{
    $stmt = query("DELETE FROM users WHERE user_id={$id}");
    return $stmt;
}

//get single user based on id
function get_single_user(int $the_user_id)
{
    $stmt = query("SELECT * FROM users WHERE user_id={$the_user_id}");
    return $stmt;
}

function get_user_image(int $user_id)
{
    $stmt = query("SELECT user_image FROM users WHERE user_id={$user_id}");
    return $stmt;
}


function update_user(int $user_id)
{
    if (isset($_POST['update_user'])) {

        $customer_username = validate($_POST['username']);
        $customer_name = validate($_POST['customer_name']);
        $customer_email = validate($_POST['email']);
        $customer_password = validate($_POST['password']);
        $password_repeat = validate($_POST['password_repeat']);
        $user_role = validate($_POST['user_role']);

        $customer_username_size = strlen($customer_username);
        $password_size = strlen($customer_password);

        //For Files, we need $_FILES['form_name']['property'] - FILES have 5 properties
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        $fileError = $_FILES['image']['error'];
        $fileSize = $_FILES['image']['size'];
        //NOTE: - files when uploaded will be sent to a temporary location. We move it from the temporary location -> to the location we want.

        //Checking for errors
        if (empty($customer_username) || empty($customer_password) || empty($customer_email) || empty($password_repeat) || empty($customer_name)) {
            redirect("../admin/users.php?error=emptyFields");
            exit();
        } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            //check if email is valid
            redirect("../admin/users.php?error=invalid_email");
            exit();
        } elseif (!preg_match("/^[a-zA-Z]*$/", $customer_username)) {
            //check if input characters are valid
            redirect("../admin/users.php?error=invalid_username");
            exit();
        } elseif ($customer_username_size <= 2) {
            //check if length of username is valid
            redirect("../admin/users.php?error=invalid_name_length");
            exit();
        } elseif ($password_size <= 4) {
            //check if length of password is valid
            redirect("../admin/users.php?error=invalid_pwd_length");
            exit();
        } elseif ($customer_password !== $password_repeat) {
            //check if password are same
            redirect("../admin/users.php?error=pwd_no_match");
            exit();
        }

        //------------QUERY-------------

        //UPLOAD FILE
        $user_image_upload = upload_image($user_image, $user_image_temp, $fileError, $fileSize);

        //check if the image location is empty or not
        if (empty($user_image_upload)) {
            $get_pic_stmt = get_user_image($user_id);
            $row = $get_pic_stmt->fetch(PDO::FETCH_ASSOC);
            $user_image_upload = $row['user_image'];
            //NOTE: - in this way, we can update product without the picture being lost
        }

        $passwordHash = password_hash($customer_password, PASSWORD_DEFAULT);

        //$stmt = prepare_query("INSERT INTO users(username,user_email,user_password,customer_name,user_image,user_role) VALUES(?,?,?,?,?,?)");
        $stmt = prepare_query("UPDATE users SET username=?,user_email=?,user_password=?,customer_name=?,user_image=?,user_role=? WHERE user_id=?");
        $stmt->bindParam(1, $customer_username, PDO::PARAM_STR);
        $stmt->bindParam(2, $customer_email, PDO::PARAM_STR);
        $stmt->bindParam(3, $passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(4, $customer_name, PDO::PARAM_STR);
        $stmt->bindParam(5, $user_image_upload, PDO::PARAM_STR);
        $stmt->bindParam(6, $user_role, PDO::PARAM_STR);
        $stmt->bindParam(7, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        unset($stmt); //close off prepare statement

        redirect("../admin/users.php?success=user_update");
    }
}


//===============================================================================================================


//======================================== Dynamic Slides  ============================================

function get_slides()
{
    $stmt = query("SELECT * FROM slides");
    return $stmt;
}

function get_active_slide()
{
    //get the latest slide (i.e. latest addition) - product promotion
    $stmt = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    return $stmt;
}

function get_current_slide_in_admin()
{
    //get the latest slide (i.e. latest addition) - product promotion
    $stmt = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    return $stmt;
}

function add_slide()
{
    if (isset($_POST['slide_submit'])) {

        $slide_title = validate($_POST['slide_title']);

        //For Files, we need $_FILES['form_name']['property'] - FILES have 5 properties
        $slide_image = $_FILES['slide_image']['name'];
        $slide_image_temp = $_FILES['slide_image']['tmp_name'];
        $fileError = $_FILES['slide_image']['error'];
        $fileSize = $_FILES['slide_image']['size'];
        //NOTE: - files when uploaded will be sent to a temporary location. We move it from the temporary location -> to the location we want.

        //Check for errors
        if (empty($slide_title) || empty($slide_image)) {
            redirect("../admin/slides.php?error=emptyFields");
            exit();
        }

        //------------QUERY-------------

        //UPLOAD FILE
        $slide_image_upload = upload_image($slide_image, $slide_image_temp, $fileError, $fileSize);

        $stmt = prepare_query("INSERT INTO slides(slide_title,slide_image) VALUES(?,?)");
        $stmt->bindParam(1, $slide_title, PDO::PARAM_STR);
        $stmt->bindParam(2, $slide_image_upload, PDO::PARAM_STR);

        $stmt->execute();
        unset($stmt); //close off prepare statement

        redirect("../admin/slides.php?success=slide_add");
    }
}

function get_slide_thumbnail()
{
    //get the latest slide (i.e. latest addition) - product promotion
    $stmt = query("SELECT * FROM slides ORDER BY slide_id ASC");
    return $stmt;
}

function get_slide_image(int $slide_id)
{
    $stmt = query("SELECT slide_image FROM slides WHERE slide_id={$slide_id} LIMIT 1");
    return $stmt;
}

function delete_slide(int $id)
{
    global $image_directory;
    //new --> before deleting from database, delete the picture from folder as well

    //find image from database based on id
    $stmt_image_delete = get_slide_image($id);
    $row = $stmt_image_delete->fetch(PDO::FETCH_ASSOC);
    //find the directory where the image is
    $target_path = "../{$image_directory}/{$row['slide_image']}";
    unlink($target_path); //delete image from directory

    //then delete from database
    $stmt = query("DELETE FROM slides WHERE slide_id={$id}");
    return $stmt;
}

//===============================================================================================================


//======================================== Pagination ============================================

//get products limited per page by pagination
function get_products_limited($num_of_products_displayed,$num_of_products_per_page)
{
    //for front page
    $stmt = query("SELECT * FROM products LIMIT {$num_of_products_displayed},{$num_of_products_per_page}");
    return $stmt;
}

//2nd pagination function to limit products per page
function paginate2_and_limit_products_per_page(){
    $num_of_products_per_page = 5;

    if(isset($_GET['page'])){
        $page_number = $_GET['page'];
    }
    else{
        //if for some reason page number not set
        $page_number=""; //empty string
    }

    if($page_number == "" || $page_number == 1){
        //if page is empty or page=1
        $num_of_products_displayed = 0; //then we are on home page (Display posts from 0 to num_of_products_per_page) (0-4)
    }
    else{
        //not on page 1

        //do some calculation 
        $num_of_products_displayed = ($page_number * $num_of_products_per_page) - $num_of_products_per_page; //(Display posts from 0 to num_of_products_per_page) (4-4)

        //e.g. on page=2, 2*4 = 8, 8-4=4 
        //therefore, 4 posts on page 2 ..and so on
    }

    //LIMIT: - 5 products per page (fixed above)

    $stmt_limit = get_products_limited($num_of_products_displayed,$num_of_products_per_page);
    return $stmt_limit;
}

//first paginate function --> to produce the pages needed, also to move forward and backward
function paginate_1()
{
    $stmt = get_products();
    $rows = count_records($stmt);

    if (isset($_GET['page'])) { //get page from URL if its there
        $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers

    } else { // If the page url variable is not present force it to be number 1
        $page = 1;
    }

    $perPage = 6; // Items per page here 
    $lastPage = ceil($rows / $perPage); // Get the value of the last page

    // Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

    if ($page < 1) { // If it is less than 1
        $page = 1; // force if to be 1

    } elseif ($page > $lastPage) { // if it is greater than $lastpage
        $page = $lastPage; // force it to be $lastpage's value
    }

    $middleNumbers = ''; // Initialize this variable

    // This creates the numbers to click in between the next and back buttons

    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;

    if ($page == 1) {
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';

    } elseif ($page == $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

    } elseif ($page > 2 && $page < ($lastPage - 1)) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a></li>';

    } elseif ($page > 1 && $page < $lastPage) {

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page= ' . $sub1 . '">' . $sub1 . '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' . $page . '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';
    }
   
    $outputPagination = ""; // Initialize the pagination output variable

    // If we are not on page one we place the back link

    if ($page != 1) {
        $prev  = $page - 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
    }

    // Lets append all our links to this variable that we can use this output pagination
    $outputPagination .= $middleNumbers;

    // If we are not on the very last page we the place the next link

    if ($page != $lastPage) {
        $next = $page + 1;
        $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
    }

    // Done with pagination
    echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";
}

//===============================================================================================================