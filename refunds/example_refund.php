<?php
if(isset($_GET['submit'])){
    $bank_tran_id=urlencode($_GET['bank_trans_id']);
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
        <h4 class="mb-3" style="text-align: center;font-size: 40px">Refund Payment</h4>

        <form action="checkout_refund.php" method="get" class="needs-validation">

            <div class="row">
                <div class="col-md-12 mb-3">

                    <label for="">Bank Transaction ID</label>
                    <input type="text" name="bank_trans_id" class="form-control" id="search_num" value ="<?php echo $bank_tran_id; ?>">

					<label for="">Refund Amount</label>
                    <input type="text" name="refound_amount" class="form-control" id="search_num" placeholder="Enter refound amount" required>

					<label for="">Refund Remarks</label>
                    <input type="text" name="refound_remarks" class="form-control" id="search_num" placeholder="Enter refound remarks" >

                    <hr class="mb-4">

                    <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Refund Customer</button>

                </div>
            </div>

        </form>
    </div>


</body>
</html>
