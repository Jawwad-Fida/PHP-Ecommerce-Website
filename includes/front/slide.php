<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">

        <?php
        // get latest slide
        $stmt = get_active_slide();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $slide_image =  $row['slide_image'];
            $image_directory = change_image_directory();
        ?>

        <div class="item active">
            <img class="slide-image" src="<?php echo $image_directory; ?>/<?php echo $slide_image; ?>" alt="800x300">
        </div>

        <?php } ?>
        

        <?php
        //http://placehold.it/800x300 - image placeholder for slide

        # get slides from database
        $stmt = get_slides();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $slide_image =  $row['slide_image'];
            $image_directory = change_image_directory();

            //close php tags
        ?>

            <div class="item">
                <img class="slide-image" src="<?php echo $image_directory; ?>/<?php echo $slide_image; ?>" alt="800x300">
            </div>

        <?php } ?>

    </div>

    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>

    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

</div>