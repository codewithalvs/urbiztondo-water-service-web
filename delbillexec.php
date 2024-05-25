<?php

$url = "http://127.0.0.1:8000/api/admin/bills/" . $_POST['id'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
	'Content-Type: application/json'
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
} else {
	$responseDecoded = json_decode($response, true);

	if ($responseDecoded['success']) {
		echo "<script>windows: location='billing.php'</script>";
	} else {
		echo "<script>alert(" . $responseDecoded['message'] . ")</script>";
	}
}

curl_close($ch);
