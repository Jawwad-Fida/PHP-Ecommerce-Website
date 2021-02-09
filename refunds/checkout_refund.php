<?php
//Refund is not done properly
include(__DIR__ . "/../db_connection.php");

if (isset($_GET['submit'])) {
	$bank_tran_id = urlencode($_GET['bank_trans_id']);
	$refund_amount = urlencode($_GET['refound_amount']);
	$refund_remarks = urlencode($_GET['refound_remarks']);
}


$store_id = urlencode("fidal5ed892039802d");
$store_passwd = urlencode("fidal5ed892039802d@ssl");

$requested_url = ("https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php?refund_amount=$refund_amount&refund_remarks=$refund_remarks&bank_tran_id=$bank_tran_id&store_id=$store_id&store_passwd=$store_passwd&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if ($code == 200 && !(curl_errno($handle))) {

	# TO CONVERT AS ARRAY
	# $result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	$result = json_decode($result);

	# TRANSACTION INFO
	$status = $result->status; //success : Refund request is initiated successfully
	$bank_tran_id = $result->bank_tran_id;
	$trans_id = $result->trans_id;
	$refund_ref_id = $result->refund_ref_id;
	$errorReason = $result->errorReason;

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;

	echo "<h1 style='color:green;font-size:40px;text-align:center'>Refund is " . $status . "</h1>";

	//store this values in a refund database
	$sql = "INSERT INTO refunds(transaction_id,status,bank_transaction_id,refund_remarks,refund_ref_id,refund_amount) VALUES('$trans_id','$status','$bank_tran_id','$refund_remarks','$refund_ref_id','$refund_amount')";
	if ($conn_integration->query($sql) === true) {
		//
	} else {
		echo "Error in creating record " . $conn_integration->connect_error;
	}
} else {

	echo "Failed to connect with SSLCOMMERZ";
}
$conn_integration->close();

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
		<h4 class="mb-3" style="text-align: center;font-size: 40px">CONFIRM Refund Payment (after status is processing)</h4>

		<form action="confirm_refund.php" method="post" class="needs-validation">

			<div class="row">
				<div class="col-md-12 mb-3">

					<label for="">Bank Transaction ID</label>
					<input type="text" name="bank_trans_id" class="form-control" id="search_num" value="<?php echo $bank_tran_id; ?>">

					<label for="">Refund Amount</label>
                    <input type=" text" name="refound_amount" class="form-control" id="search_num" value="<?php echo $refund_amount; ?>">

					<label for="">Refund Remarks</label>
                    <input type=" text" name="refound_remarks" class="form-control" id="search_num" value="<?php echo $refund_remarks; ?>">

					<hr class=" mb-4">

					<select name="id">
						<?php
						include "showAllData.php";
						?>
					</select>

					<button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Confirm Refund Payment</button>

				</div>
			</div>

		</form>
	</div>

</body>

</html>