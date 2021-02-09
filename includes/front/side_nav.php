<div class="col-md-3">
    <p class="lead">Categories</p>

    <div class="list-group">

        <?php
        //Display categories dynamically - from categories table
        
        $stmt = get_categories();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $cat_title = $row['cat_title'];
            echo "<a href='category.php?title={$cat_title}' class='list-group-item'>{$cat_title}</a>";
        }
        
        ?>

    </div>

</div>