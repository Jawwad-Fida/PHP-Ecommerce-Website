<?php
//Refund is not done properly
include(__DIR__ . "/../db_connection.php");

if(isset($_POST['submit'])){
    $id = urlencode($_POST['id']);
    $bank_tran_id=urlencode($_POST['bank_trans_id']);
    $refund_amount=urlencode($_POST['refound_amount']);
    $refund_remarks=urlencode($_POST['refound_remarks']);
}


$store_id=urlencode("fidal5ed892039802d");
$store_passwd=urlencode("fidal5ed892039802d@ssl");

$requested_url = ("https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php?refund_amount=$refund_amount&refund_remarks=$refund_remarks&bank_tran_id=$bank_tran_id&store_id=$store_id&store_passwd=$store_passwd&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

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
	
	echo "<h1 style='color:green;font-size:40px;text-align:center'>Refund process is " .$status . "</h1>";

    //updatethis values in a refund database
    $sql = "UPDATE refunds
    SET status='$status', refund_ref_id='$refund_ref_id'
    WHERE id='$id'";
    if($conn_integration->query($sql) === true){
        //
    }
    else{
        echo "Error in creating record " .$conn_integration->connect_error;
    }

} else {

	echo "Failed to connect with SSLCOMMERZ";
}
$conn_integration->close();
