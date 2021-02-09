<?php
include(__DIR__ . "/../db_connection.php");

if(isset($_GET['submit-id'])){
    $id = urlencode($_GET['id']);

    $sql = "SELECT * FROM refunds WHERE id='$id'";

    $result = $conn_integration->query($sql);
    $row = $result->fetch_assoc();
    $refund_ref_id = $row['refund_ref_id'];
}

?>



<!DOCTYPE html> <!-- -->
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Customer's Receipt</title>
     <!-- Bootstrap Core CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

<div class="col-md-8 order-md-1">
		<h4 class="mb-3" style="text-align: center;font-size: 40px">Refund ID</h4>

		<form action="check_refund.php" method="get" class="needs-validation">

			<div class="row">
				<div class="col-md-12 mb-3">

					<select name="id">
						<?php
						include "showAllData.php";
						?>
					</select>

					<button class="btn btn-primary btn-lg btn-block" name="submit-id" type="submit">Get Refund ID</button>

				</div>
			</div>

		</form>
    </div>

    <hr class=" mb-4">
    
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3" style="text-align: center;font-size: 40px">Refund Payment</h4>

        <form action="refund.php" method="get" class="needs-validation">

            <div class="row">
                <div class="col-md-12 mb-3">

                    <label for="">Reference ID</label>
                    <input type="text" name="refund_ref_id" class="form-control" id="search_num" value ="<?php echo $refund_ref_id; ?>">

                    <hr class="mb-4">

                    <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Check Refund Status</button>

                </div>
            </div>

        </form>
    </div>


</body>

</html>