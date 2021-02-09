<?php
//---------1st LIST OF FUNCTIONS (1) -------
// 1) Database Functions
// 2) General Functions
// 3) Product Functions
// 4) Category Functions
// 5) User Functions
// 6) Comment system
//--------------------------------



//======================================== DATABASE FUNCTIONS ==========================================

function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//for prepared statements using pdo
function prepare_query($sql)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare($sql);
        return $stmt;
    } catch (Exception $ex) {
        die("Query failed " . $ex->getMessage());
    }
}

//for normal queries using pdo
function query($sql)
{
    global $pdo;
    try {
        $stmt = $pdo->query($sql);
        return $stmt;
    } catch (Exception $ex) {
        die("Query failed " . $ex->getMessage());
    }
}

//return no. of rows in table
function count_records($stmt)
{
    $rowNumber = $stmt->rowCount();
    return $rowNumber;
}


//========================================================================================================





//======================================== GENERAL FUNCTIONS ==========================================

//redirect to any webpage (location) - can also add url parameters
function redirect($location)
{
    header("Location: {$location}");
}

//list of error messages (on redirect)
function display_error_message()
{
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyFields') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Please Fill in all the Fields!<p>";
        } elseif ($_GET['error'] == 'no_user') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Username does not exist!<p>";
        } elseif ($_GET['error'] == 'password') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Incorrect Password!<p>";
        } elseif ($_GET['error'] == 'notallowed') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Cannot be accessed withoout logging in!<p>";
        } elseif ($_GET['error'] == 'invalid_email') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Invalid E-mail format!<p>";
        } elseif ($_GET['error'] == 'invalid_username') {
            echo "<p style='color:red;font-size:25px;text-align:center'>No special characters allowed for username!<p>";
        } elseif ($_GET['error'] == 'invalid_name_length') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Username has to be more than 2 Characters!<p>";
        } elseif ($_GET['error'] == 'invalid_pwd_length') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Password has to be more than 4 Characters!<p>";
        } elseif ($_GET['error'] == 'pwd_no_match') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Passwords do not match!<p>";
        } elseif ($_GET['error'] == 'user_exists') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Username already exists!<p>";
        } elseif ($_GET['error'] == 'email_exists') {
            echo "<p style='color:red;font-size:25px;text-align:center'>E-mail already exists!<p>";
        } elseif ($_GET['error'] == 'no_email') {
            echo "<p style='color:red;font-size:25px;text-align:center'>E-mail does not exist!<p>";
        } elseif ($_GET['error'] == 'session_expire') {
            echo "<p style='color:red;font-size:25px;text-align:center'>Session Expired! Please log in again<p>";
        } elseif ($_GET['error'] == 'not_available') {
            echo "<p class='text-center bg-danger' style='font-size:20px;text-align:center'>Sorry! This Product is no longer available<p>";
        } elseif ($_GET['error'] == 'cart_empty') {
            echo "<p class='text-center bg-danger' style='font-size:20px;text-align:center'>Cart is Empty!<p>";
        } elseif ($_GET['error'] == 'not_admin') {
            echo "<p class='text-center bg-danger' style='font-size:20px;text-align:center'>Sorry! Only Admin is Allowed<p>";
        }
    }
}

//list of success messages (on redirect)
function display_success_message()
{
    if (isset($_GET['success'])) {
        if ($_GET['success'] == 'logout') {
            echo "<p style='color:green;font-size:30px;text-align:center'>You are logged out!<p>";
        } elseif ($_GET['success'] == 'login') {
            echo "<p style='color:green;font-size:30px;text-align:center'>You are logged in!<p>";
        } elseif ($_GET['success'] == 'register') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Welcome Customer!<p>";
        } elseif ($_GET['success'] == 'contact_sent') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Mail Sent! Please wait for Our Reply<p>";
        } elseif ($_GET['success'] == 'forgot_sent') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Mail Sent! Check your inbox!<p>";
        } elseif ($_GET['success'] == 'reset') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Password Reset Successfull!<p>";
        } elseif ($_GET['success'] == 'product_add') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Product Added!<p>";
        } elseif ($_GET['success'] == 'item_removed') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Product Removed!<p>";
        } elseif ($_GET['success'] == 'item_deleted') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Product Deleted!<p>";
        } elseif ($_GET['success'] == 'order_delete') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Order Deleted!<p>";
        } elseif ($_GET['success'] == 'product_delete') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Product Deleted!<p>";
        } elseif ($_GET['success'] == 'product_add') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Product Added!<p>";
        } elseif ($_GET['success'] == 'product_update') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Product Updated!<p>";
        } elseif ($_GET['success'] == 'category_add') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Category Added!<p>";
        } elseif ($_GET['success'] == 'category_update') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Category Updated!<p>";
        } elseif ($_GET['success'] == 'category_delete') {
            echo "<p style='color:green;font-size:30px;text-align:center'>Category Deleted!<p>";
        } elseif ($_GET['success'] == 'user_delete') {
            echo "<p style='color:green;font-size:30px;text-align:center'>User Deleted!<p>";
        } elseif ($_GET['success'] == 'user_update') {
            echo "<p style='color:green;font-size:30px;text-align:center'>User Updated!<p>";
        } elseif ($_GET['success'] == 'slide_add') {
            echo "<p style='color:green;font-size:30px;text-align:center'> New Slide Added!<p>";
        } elseif ($_GET['success'] == 'slide_delete') {
            echo "<p style='color:green;font-size:30px;text-align:center'> Slide deleted!<p>";
        } elseif ($_GET['success'] == 'comment') {
            echo "<p style='color:green;font-size:30px;text-align:center'> Comment Added!<p>";
        }
    }
}

//check is user is logged in
function is_logged_in()
{
    return isset($_SESSION['role']) ? true : false;
}

//check if user is Admin or Customer
function is_admin()
{
    if (is_logged_in()) {
        $userName = $_SESSION['user_name'];
        $stmt = query("SELECT user_role FROM users WHERE username='{$userName}'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['user_role'] == 'Admin') {
            return true;
        } else {
            return false;
        }
    }
}

//check for session expiry/session timeout
function session_expire_function()
{
    //check if session is started. 
    //60 minutes = 60*60 seconds = 3600 seconds
    if (isset($_SESSION["role"])) {
        if (time() - $_SESSION["time_stamp"] > 3600) {
            session_unset();
            session_destroy();
            redirect("login.php?error=session_expire");
        }
    }
}

//get username of the user logged in
function get_username()
{
    return isset($_SESSION['username']) ? $_SESSION['user_name'] : null;
}

//get user role of the user logged in
function get_user_role()
{
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
}


//global variable for file upload
$image_directory = "images";

//function to upload files (especially images)
function upload_image($post_image, $post_image_temp, $fileError, $fileSize)
{
    global $image_directory;

    $fileArray = explode('.', $post_image); //explode() - creates an array
    //remove '.' dot extension from file. doing so, we get 2 parts: - name of file and extension

    //end() - get last data, and convert it to lowercase
    $fileExt  = strtolower(end($fileArray));

    $allowedExt = array('jpg', 'jpeg', 'png'); //file extensions to be allowed

    //check if file is allowed to be uploaded
    if (in_array($fileExt, $allowedExt)) {
        //check for errors
        if ($fileError === 0) {
            //check for file size
            if ($fileSize < 5000000) {
                //5 Gb = 500 mb = 5000000 kb

                //upload the file - specify destination
                $fileDestination = "../$image_directory/$post_image";

                //call function to compress image before upload
                $image_path = compress($post_image_temp, $fileDestination, 60);
                return $image_path;

                //move from temporary location to destination - upload file function
                // move_uploaded_file($post_image_temp, $fileDestination);
            }
        }
    }
}

//compress file (image) function
function compress($source, $destination, $quality)
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality); //function to upload image to current destination

    //unlink($destination); //remove the old image

    return $destination;
}

//we can come here anytime, and change the directory of where our files will be uploaded. Make sure u also change in upload_image()
function change_image_directory()
{
    global $image_directory;
    return $image_directory;
}

//========================================================================================================





//======================================== PRODUCT FUNCTIONS ==========================================

//get all products
function get_products()
{
    //Limit it later - for front page
    $stmt = query("SELECT * FROM products");
    return $stmt;
}

//get single product based on id
function get_single_product(int $the_product_id)
{
    $stmt = query("SELECT * FROM products WHERE product_id={$the_product_id}");
    return $stmt;
}

function delete_product(int $id)
{
    $stmt = query("DELETE FROM products WHERE product_id={$id}");
    return $stmt;
}

function add_product()
{
    if (isset($_POST['publish'])) {

        $product_title = validate($_POST['product_title']);
        $product_description = validate($_POST['product_description']);
        $product_price = validate($_POST['product_price']);
        $product_category = validate($_POST['product_category']);
        $product_quantity = validate($_POST['product_quantity']);
        $product_keywords = validate($_POST['product_tags']);
        $product_short_description = validate($_POST['product_short_description']);

        //For Files, we need $_FILES['form_name']['property'] - FILES have 5 properties
        $product_image = $_FILES['product_image']['name'];
        $product_image_temp = $_FILES['product_image']['tmp_name'];
        $fileError = $_FILES['product_image']['error'];
        $fileSize = $_FILES['product_image']['size'];
        //NOTE: - files when uploaded will be sent to a temporary location. We move it from the temporary location -> to the location we want.

        //Check for errors
        if (empty($product_title) || empty($product_description) || empty($product_price) || empty($product_quantity) || empty($product_keywords) || empty($product_short_description)) {
            redirect("../admin/add_product.php?error=emptyFields");
            exit();
        }

        //------------QUERY-------------

        //UPLOAD FILE
        $product_image_upload = upload_image($product_image, $product_image_temp, $fileError, $fileSize);

        $stmt = prepare_query("INSERT INTO products(product_title,product_category_title,product_price,product_quantity,product_description,product_short_description,product_image,product_keywords) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $product_title, PDO::PARAM_STR);
        $stmt->bindParam(2, $product_category, PDO::PARAM_STR);
        $stmt->bindParam(3, $product_price, PDO::PARAM_STR);
        $stmt->bindParam(4, $product_quantity, PDO::PARAM_STR);
        $stmt->bindParam(5, $product_description, PDO::PARAM_STR);
        $stmt->bindParam(6, $product_short_description, PDO::PARAM_STR);
        $stmt->bindParam(7, $product_image_upload, PDO::PARAM_STR);
        $stmt->bindParam(8, $product_keywords, PDO::PARAM_STR);

        $stmt->execute();
        unset($stmt); //close off prepare statement

        redirect("../admin/products.php?success=product_add");
    }
}

function get_product_image(int $product_id)
{
    $stmt = query("SELECT product_image FROM products WHERE product_id={$product_id}");
    return $stmt;
}


function edit_product(int $product_id)
{
    if (isset($_POST['publish'])) {

        $product_title = validate($_POST['product_title']);
        $product_description = validate($_POST['product_description']);
        $product_price = validate($_POST['product_price']);
        $product_category = validate($_POST['product_category']);
        $product_quantity = validate($_POST['product_quantity']);
        $product_keywords = validate($_POST['product_tags']);
        $product_short_description = validate($_POST['product_short_description']);

        //For Files, we need $_FILES['form_name']['property'] - FILES have 5 properties
        $product_image = $_FILES['product_image']['name'];
        $product_image_temp = $_FILES['product_image']['tmp_name'];
        $fileError = $_FILES['product_image']['error'];
        $fileSize = $_FILES['product_image']['size'];
        //NOTE: - files when uploaded will be sent to a temporary location. We move it from the temporary location -> to the location we want.

        //Check for errors
        if (empty($product_title) || empty($product_description) || empty($product_price) || empty($product_quantity) || empty($product_keywords) || empty($product_short_description)) {
            redirect("../admin/products.php?error=emptyFields");
            exit();
        }

        //------------QUERY-------------

        //UPLOAD FILE
        $product_image_upload = upload_image($product_image, $product_image_temp, $fileError, $fileSize);

        //check if the image location is empty or not
        if (empty($product_image_upload)) {
            $get_pic_stmt = get_product_image($product_id);
            $row = $get_pic_stmt->fetch(PDO::FETCH_ASSOC);
            $product_image_upload = $row['product_image'];
            //NOTE: - in this way, we can update product without the picture being lost
        }

        $stmt = prepare_query("UPDATE products SET product_title=?,product_category_title=?,product_price=?,product_quantity=?,product_description=?,product_short_description=?,product_image=?,product_keywords=? WHERE product_id=?");
        $stmt->bindParam(1, $product_title, PDO::PARAM_STR);
        $stmt->bindParam(2, $product_category, PDO::PARAM_STR);
        $stmt->bindParam(3, $product_price, PDO::PARAM_STR);
        $stmt->bindParam(4, $product_quantity, PDO::PARAM_STR);
        $stmt->bindParam(5, $product_description, PDO::PARAM_STR);
        $stmt->bindParam(6, $product_short_description, PDO::PARAM_STR);
        $stmt->bindParam(7, $product_image_upload, PDO::PARAM_STR);
        $stmt->bindParam(8, $product_keywords, PDO::PARAM_STR);
        $stmt->bindParam(9, $product_id, PDO::PARAM_INT);

        $stmt->execute();
        unset($stmt); //close off prepare statement

        redirect("../admin/products.php?success=product_update");
    }
}


//========================================================================================================




//======================================== CATEGORY FUNCTIONS ==========================================

//get all categories
function get_categories()
{
    $stmt = query("SELECT * FROM categories");
    return $stmt;
}

//get all categories items based on title
function get_category_items(string $the_category_title)
{
    $stmt = query("SELECT * FROM products WHERE product_category_title='{$the_category_title}'");
    return $stmt;
}

//get category based on id
function get_certain_category(int $category_id)
{
    $stmt = query("SELECT * FROM categories WHERE cat_id={$category_id}");
    return $stmt;
}



function add_category()
{
    if (isset($_POST['add_category'])) {

        $category_title = validate($_POST['category_title']);

        //Check for errors
        if (empty($category_title)) {
            redirect("../admin/categories.php?error=emptyFields");
            exit();
        }

        //------------QUERY-------------

        $stmt = prepare_query("INSERT INTO categories(cat_title) VALUES(?)");
        $stmt->bindParam(1, $category_title, PDO::PARAM_STR);
        $stmt->execute();
        unset($stmt); //close off prepare statement

        redirect("../admin/categories.php?success=category_add");
    }
}

function update_category(int $category_id)
{
    if (isset($_POST['update_category'])) {
        $category_title = validate($_POST['category_title']);
        $stmt = prepare_query("UPDATE categories SET cat_title=? WHERE cat_id=?");
        $stmt->bindParam(1, $category_title, PDO::PARAM_STR);
        $stmt->bindParam(2, $category_id, PDO::PARAM_INT);
        $stmt->execute();
        unset($stmt); //close off prepare statement

        redirect("../admin/categories.php?success=category_update");
    }
}

function delete_category(int $id)
{
    $stmt = query("DELETE FROM categories WHERE cat_id={$id}");
    return $stmt;
}

//when category is deleted, all products related to that category will also be deleted 
function delete_product_in_category(string $category_title)
{
    $stmt = query("DELETE FROM products WHERE product_category_title='{$category_title}'");
    return $stmt;
}

//========================================================================================================





//======================================== USER FUNCTIONS ============================================

//check if a user exists for login
function login_user_exists(string $username)
{
    $stmt = query("SELECT * FROM users WHERE username='$username'");
    $rowNumber = count_records($stmt);
    if ($rowNumber <= 0) {
        redirect("login.php?error=no_user");
        exit();
    }
    return $stmt;
}

//function to log in user
function login_user()
{
    if (isset($_POST['login_submit'])) {
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);

        //check for errors
        if (empty($username) || empty($password)) {
            redirect("login.php?error=emptyFields");
            exit();
        }

        //check if username exists for log in 
        $stmt = login_user_exists($username);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            //dehash the password from database (returns true or false)
            $pwdCheck = password_verify($password, $row['user_password']);

            //if password doesn't match (false)
            if ($pwdCheck == false) {
                //dont log in user
                redirect("login.php?error=password");
                exit();
            } else {
                //password is correct (true) - log in the user

                session_start();

                //store information of user from database into global session variable
                $_SESSION['userID'] = $row['user_id'];
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['role'] = $row['user_role'];
                $_SESSION['cus_name'] = $row['customer_name'];
                $_SESSION['cus_email'] = $row['user_email'];

                //A session variable to store the time of login is initialized
                $_SESSION["time_stamp"] = time(); //Using time() function, the current time can be calculated.

                redirect("index.php?success=login");
            }
        }
    }
}

//function to log out user
function log_out()
{
    session_start();
    //end the session - remove the session variables and destroy them
    session_unset();
    session_destroy();
    // redirect("../../index.php?success=logout");
    redirect("../index.php?success=logout");
}

//check if username already exists in table
function username_exists(string $username)
{

    $stmt = query("SELECT username FROM users WHERE username='$username'");
    $rowNumber = count_records($stmt);

    if ($rowNumber > 0) {
        return true;
    } else {
        return false;
    }
}

//check if email already exists in table
function email_exists(string $email)
{
    $stmt = query("SELECT user_email FROM users WHERE user_email='$email'");
    $rowNumber = count_records($stmt);

    if ($rowNumber > 0) {
        return true;
    } else {
        return false;
    }
}

//for forgotten password system - check if a email does not exist 
function email_does_not_exist(string $email)
{
    $stmt = query("SELECT user_email FROM users WHERE user_email='$email'");
    $rowNumber = count_records($stmt);

    if ($rowNumber <= 0) {
        return true;
    } else {
        return false;
    }
}


//register user
function register_user()
{
    if (isset($_POST['register_submit'])) {
        $customer_username = validate($_POST['username']);
        $customer_name = validate($_POST['customer_name']);
        $customer_email = validate($_POST['email']);
        $customer_password = validate($_POST['password']);
        $password_repeat = validate($_POST['password_repeat']);

        $customer_username_size = strlen($customer_username);
        $password_size = strlen($customer_password);

        //For Files, we need $_FILES['form_name']['property'] - FILES have 5 properties
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $fileError = $_FILES['image']['error'];
        $fileSize = $_FILES['image']['size'];
        //NOTE: - files when uploaded will be sent to a temporary location. We move it from the temporary location -> to the location we want.

        //Checking for errors
        if (empty($customer_username) || empty($customer_password) || empty($customer_email) || empty($password_repeat) || empty($customer_name)) {
            redirect("registration.php?error=emptyFields");
            exit();
        } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
            //check if email is valid
            redirect("registration.php?error=invalid_email");
            exit();
        } elseif (!preg_match("/^[a-zA-Z]*$/", $customer_username)) {
            //check if input characters are valid
            redirect("registration.php?error=invalid_username");
            exit();
        } elseif ($customer_username_size <= 2) {
            //check if length of username is valid
            redirect("registration.php?error=invalid_name_length");
            exit();
        } elseif ($password_size <= 4) {
            //check if length of password is valid
            redirect("registration.php?error=invalid_pwd_length");
            exit();
        } elseif ($customer_password !== $password_repeat) {
            //check if password are same
            redirect("registration.php?error=pwd_no_match");
            exit();
        }

        //CHECKING FOR DUPLICATE USERS AND EMAILS (by calling functions above)

        if (username_exists($customer_username) == 'true') {
            redirect("registration.php?error=user_exists");
            exit();
        }

        if (email_exists($customer_email) == 'true') {
            redirect("registration.php?error=email_exists");
            exit();
        }

        //------------QUERY-------------

        //UPLOAD FILE
        $post_image_upload = upload_image($post_image, $post_image_temp, $fileError, $fileSize);

        $customer_role = 'Customer';
        $passwordHash = password_hash($customer_password, PASSWORD_DEFAULT);

        $stmt = prepare_query("INSERT INTO users(username,user_email,user_password,customer_name,user_image,user_role) VALUES(?,?,?,?,?,?)");
        $stmt->bindParam(1, $customer_username, PDO::PARAM_STR);
        $stmt->bindParam(2, $customer_email, PDO::PARAM_STR);
        $stmt->bindParam(3, $passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(4, $customer_name, PDO::PARAM_STR);
        $stmt->bindParam(5, $post_image_upload, PDO::PARAM_STR);
        $stmt->bindParam(6, $customer_role, PDO::PARAM_STR);
        $stmt->execute();
        unset($stmt); //close off prepare statement

        redirect("registration.php?success=register");
    }
}

//====================================================================================================


//======================================== Reviews and Comments ==========================================

function insert_comment(int $the_product_id, string $the_product_title)
{
    if (isset($_POST['submit'])) {
        $comment_name = validate($_POST['comment_name']);
        $comment_email = validate($_POST['comment_email']);
        $comment_content = validate($_POST['comment_content']);
        $comment_date = date("d-m-Y");

        //Checking for errors
        if (empty($comment_name) || empty($comment_email) || empty($comment_content)) {
            redirect("item.php?error=emptyFields&id={$the_product_id}");
            exit();
        } elseif (!filter_var($comment_email, FILTER_VALIDATE_EMAIL)) {
            //check if email is valid
            redirect("item.php?error=invalid_email&id={$the_product_id}");
            exit();
        } 
        
        //------------QUERY-------------

        $stmt = prepare_query("INSERT INTO comments(comment_product_id,comment_product_title,comment_author,comment_email,comment_content,comment_date) VALUES(?,?,?,?,?,?)");
        $stmt->bindParam(1, $the_product_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $the_product_title, PDO::PARAM_STR);
        $stmt->bindParam(3, $comment_name, PDO::PARAM_STR);
        $stmt->bindParam(4, $comment_email, PDO::PARAM_STR);
        $stmt->bindParam(5, $comment_content, PDO::PARAM_STR);
        $stmt->bindParam(6, $comment_date, PDO::PARAM_STR);
        $stmt->execute();

        $stmt2 = get_current_number_of_reviews($the_product_id);
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        $number_of_reviews = $row["product_reviews"];
        update_reviews($number_of_reviews,$the_product_id);


        unset($stmt); //close off prepare statement
        unset($stmt2);

        redirect("item.php?success=comment&id={$the_product_id}");
    }
}

function get_comments(int $the_product_id)
{
    $stmt = query("SELECT * FROM comments WHERE comment_product_id={$the_product_id}");
    return $stmt;
}


function get_current_number_of_reviews(){
    $stmt = query("SELECT product_reviews FROM products");
    return $stmt;
}
//in products table
function update_reviews($number_of_reviews,$the_product_id){
    $number_of_reviews += 1;
    $stmt = query("UPDATE products SET product_reviews={$number_of_reviews} WHERE product_id={$the_product_id}");
}

//========================================================================================================
