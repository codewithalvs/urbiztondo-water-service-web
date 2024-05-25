<?php

$url = 'http://127.0.0.1:8000/api/admin/customers';

$data = array(
	'username' => $_POST['username'],
	'password' => $_POST['password'],
	'name' => $_POST['name'],
	'email' => $_POST['email'],
	'phone_number' => $_POST['phone_number'],
	'address' => $_POST['address'],
	'meter_number' => $_POST['meter_number'],
);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);

if ($response === false) {
	echo 'Curl error: ' . curl_error($ch);
} else {

	if (json_decode($response, true)['success']) {
		echo '<script>alert("Customer created successfully!")</script>';
		header("Location: clients.php");
	} else {
		echo '<script>alert("Failed to add customer!")</script>';
		header("Location: clients.php");
	}
}

curl_close($ch);
