<?php
if (isset($_GET['submit'])) {
	$refund_ref_id = urlencode($_GET['refund_ref_id']);
	//$trans_id=urlencode($_POST['trans_id']);
}

$store_id = urlencode("fidal5ed892039802d");
$store_passwd = urlencode("fidal5ed892039802d@ssl");

$requested_url = ("https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php?refund_ref_id=$refund_ref_id&store_id=$store_id&store_passwd=$store_passwd&format=json");

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
	$status = $result->status;
	$bank_tran_id = $result->bank_tran_id;
	$trans_id = $result->trans_id;
	$refund_ref_id = $result->refund_ref_id;
	$errorReason = $result->errorReason;

	# API AUTHENTICATION
	$APIConnect = $result->APIConnect;

	echo "<h1 style='color:green;font-size:40px;text-align:center'>Refund is " . $status . "</h1>";

} else {

	echo "Failed to connect with SSLCOMMERZ";
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
		<h4 class="mb-3" style="text-align: center;font-size: 40px">Confirm Refund Payment</h4>

		<form action="cust_refund.php" method="post" class="needs-validation">

			<div class="row">
				<div class="col-md-12 mb-3">

					<label for="">Reference ID</label>
					<input type="text" name="refund_ref_id" class="form-control" id="search_num" value="<?php echo $refund_ref_id; ?>">

					<hr class=" mb-4">

					<select name="id">
						<?php
						include "showAllData.php";
						?>
					</select>

					<button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Check Refund Status</button>

				</div>
			</div>

		</form>
	</div>


</body>

</html>