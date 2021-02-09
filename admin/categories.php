<!-- Header -->
<?php include "../includes/back/header.php";  ?>

<!-- Display error messages -->
<?php display_error_message(); ?>

<!-- Display success messages -->
<?php display_success_message(); ?>

<?php
//delete category based on id 
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];
    $stmt1 = get_certain_category($category_id);
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $category_title =  $row['cat_title'];
    }

    $stmt2 = delete_product_in_category($category_title);
    $stmt3 = delete_category($category_id);
    
    redirect("categories.php?success=category_delete");
}
?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "../includes/back/nav.php";  ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <h1 style="text-align:center" class="page-header">
                Product Categories
            </h1>

            <div class="col-md-4">
                <form action="" method="post">

                    <!-- add_category using function (function has to be inside form) -->
                    <?php add_category(); ?>

                    <div class="form-group">
                        <label for="category-title">Title</label>
                        <input type="text" name="category_title" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
                    </div>
                </form>

                <?php
                if (isset($_GET['edit'])) {
                    $category_id = $_GET['edit'];
                    //There is another form in the file below
                    include "update_categories.php";
                }
                ?>

            </div>

            <div class="col-md-8">
                <table class="table">

                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $stmt = get_categories();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $category_id = $row['cat_id'];
                            $category_title =  $row['cat_title'];
                        ?>

                            <tr>
                                <td><?php echo $category_id; ?></td>
                                <td><?php echo $category_title; ?></td>
                                <td>
                                    <a class="btn btn-success" href="categories.php?edit=<?php echo $category_id; ?>">Edit</a>
                                    <a class="btn btn-danger" href="categories.php?delete=<?php echo $category_id; ?>"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>


            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Footer -->
<?php include "../includes/back/footer.php";  ?>