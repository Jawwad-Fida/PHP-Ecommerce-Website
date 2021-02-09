<!-- Header -->
<?php include "includes/front/header.php";  ?>

<!-- Top Navigation -->
<?php include "includes/front/top_nav.php";  ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!--Side Navigation (Categories)  -->
        <?php include "includes/front/side_nav.php";  ?>


        <div class="col-md-8 order-md-1">

            <!-- ------Search Area --------- -->
            <!-- Search Engine -->
            <h4 class="mb-3" style="text-align: center;font-size: 40px">Search Product</h4>

            <form action="" method="post" class="needs-validation">

                <div class="row">
                    <div class="col-md-12 mb-3">

                        <label for="searching"></label><br>
                        <input type="text" name="search_value" class="form-control" id="search_num" placeholder="Enter Keyword">

                        <hr class="mb-2">

                        <button class="btn btn-primary btn-block" name="submit_search" type="submit">Search</button>
                        <br>

                    </div>
                </div>

            </form>
        </div>

        <?php

        if (isset($_POST['submit_search'])) {
            $search_value = validate($_POST['search_value']);

            $query = "SELECT * FROM products WHERE product_keywords LIKE ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, "%$search_value%");
            $stmt->execute();

            $rows = count_records($stmt);
            //echo $rows;
            if ($rows == 0) {
                echo "<p>NO RESULT</p>";
            } else {
                echo "<div class='row'>";


                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $product_id = $row['product_id'];
                    $product_title =  $row['product_title'];
                    $product_category_title =  $row['product_category_title'];
                    $product_price =  $row['product_price'];
                    $product_image =  $row['product_image'];
                    $product_reviews =  $row['product_reviews'];

                    //shrink some content
                    $product_short_description = substr($row['product_short_description'], 0, 100);
                    $image_directory = change_image_directory();



                    echo "
            <div class='col-sm-4 col-lg-4 col-md-4'>
                        <div class='thumbnail'>

                            <img class='img-responsive' src='{$image_directory}/{$product_image}' alt='320x150'>

                            <div class='caption'>
                                <h4 class='pull-right'>{$product_price}TK</h4>
                                <h4><a href='item.php?id={$product_id}' target='_blank'>{$product_title}</a>
                                </h4>
                                <p>{$product_short_description}</p>
                            </div>

                            <div class='ratings'>
                                <p class='pull-right'>{$product_reviews}reviews</p>
                                <p>
                                    <a href='item.php?id={$product_id}' class='btn btn-primary' target='_blank'>View Item</a>
                                </p>
                            </div>

                        </div>
                    </div>
            ";
                }
                echo "</div>";
            }

            unset($stmt);
        }

        ?>

    </div>

</div>


<!-- Footer -->
<?php include "includes/front/footer.php";  ?>