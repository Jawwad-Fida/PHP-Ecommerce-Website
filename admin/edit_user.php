<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<?php
if (isset($_GET['edit'])) {

    $user_id = $_GET['edit'];
    $stmt = get_single_user($user_id);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $username =  $row['username'];
        $user_email =  $row['user_email'];
        $user_role =  $row['user_role'];
        $customer_name =  $row['customer_name'];
        $user_image =  $row['user_image'];

        $image_directory = change_image_directory();
    }
}
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "../includes/back/nav.php";  ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="col-md-12">

                    <div class="row">
                        <h1 class="page-header">
                            Edit User
                        </h1>
                    </div>

                    <form role="form" action="" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">

                        <!-- update user using function (function has to be inside form) -->
                        <?php update_user($user_id) ?>

                        <div class="form-group">
                            <!-- Upload Image  -->
                            <img style='display:block;margin-left:auto;margin-right:auto' width="200" src="../<?php echo $image_directory; ?>/<?php echo $user_image; ?>">
                            <label for="post_image">User Image</label>
                            <input type="file" name="image">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="username" class="sr-only">Customer Name</label>
                            <input type="text" name="customer_name" id="username" class="form-control" value="<?php echo $customer_name; ?>">
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $user_email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="status">User Role</label>
                            <select name="user_role" id="">
                                <!-- default option -->
                                <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

                                <?php
                                //adding select options to user role

                                if ($user_role == 'Admin') {
                                    //if user role is Admin, give option to change to Customer
                                    echo "<option value='Customer'>Customer</option>";
                                } else {
                                    //if user role is Customer, give option to change to Admin
                                    echo "<option value='Admin'>Admin</option>";
                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Enter your password to update changes">
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Repeat Password</label>
                            <input type="password" name="password_repeat" id="key" class="form-control" placeholder="Enter your password again to update changes">
                        </div>

                        <input type="submit" name="update_user" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Update">

                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Footer -->
        <?php include "../includes/back/footer.php";  ?>