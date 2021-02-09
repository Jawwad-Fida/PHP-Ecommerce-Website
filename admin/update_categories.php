<!-- Form to update data in database -->
<form action="" method="post">

    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php
        //select which categories to update by clicking on link

        if (isset($_GET['edit'])) {

            //collect data from url
            $cat_id = $_GET['edit'];

            $stmt = get_certain_category($cat_id);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $category_title =  $row['cat_title'];

                //close php tag so that we can include some HTML within the loop 
        ?>
                <!-- This Field will only appear when edit option is clicked -->
                <input value="<?php echo $category_title; ?>" type="text" class="form-control" name="category_title">

        <?php
            }
        }
        ?>  

        <?php
        //update category function
        $stmt = update_category($cat_id);
        ?>

    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>

</form>