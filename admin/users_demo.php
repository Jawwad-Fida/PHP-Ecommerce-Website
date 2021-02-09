<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "../includes/back/nav.php";  ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="col-lg-12">

                <h1 style="text-align:center" class="page-header">
                    Users
                </h1>
                
                <p class="bg-success">
                    <?php echo $message; ?>
                </p>

                <a href="add_user.php" class="btn btn-primary">Add User</a>


                <div class="col-md-12">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($users as $user) : ?>

                                <tr>

                                    <td>2</td>
                                    <td><img class="admin-user-thumbnail user_image" src="placehold.it/62x62" alt=""></td>

                                    <td>Rico
                                        <div class="action_links">

                                            <a href="">Delete</a>
                                            <a href="">Edit</a>


                                        </div>
                                    </td>


                                    <td>Edwin</td>
                                    <td>Diaz</td>
                                </tr>


                            <?php endforeach; ?>




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