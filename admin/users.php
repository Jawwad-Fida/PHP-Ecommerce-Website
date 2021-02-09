<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<?php
//delete order based on report id 
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $stmt = delete_user($user_id);
    redirect("users.php?success=user_delete");
}
?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "../includes/back/nav.php";  ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="col-lg-12">

                <h1 style="text-align:center" class="page-header">
                    Customers
                </h1>

                <div class="col-md-12">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $stmt = display_users();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $user_id = $row['user_id'];
                                $username =  $row['username'];
                                $user_email =  $row['user_email'];
                                $user_role =  $row['user_role'];
                                $customer_name =  $row['customer_name'];
                                $user_image =  $row['user_image'];
    
                                $image_directory = change_image_directory();

                            ?>

                            <tr>
                                <td><?php echo $user_id; ?></td>
                                <td><img width="150" src="../<?php echo $image_directory;?>/<?php echo $user_image;?>">
                                </td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $user_email; ?></td>
                                <td><?php echo $user_role; ?></td>
                                <td>
                                    <a class="btn btn-success" href="edit_user.php?edit=<?php echo $user_id; ?>">Edit</a>
                                    <a class="btn btn-danger" href="users.php?delete=<?php echo $user_id; ?>"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>

                            <?php } ?>

                        </tbody>


                    </table>
                    <!--End of Table-->

                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Footer -->
<?php include "../includes/back/footer.php";  ?>