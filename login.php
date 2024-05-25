<?php
session_start();

$url = 'http://127.0.0.1:8000/api/login';

$data = array(
	'username' => $_POST['username'],
	'password' => $_POST['password'],
);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);

if ($response === false) {
	echo 'Curl error: ' . curl_error($ch);
} else {

	if (json_decode($response, true)['data']['type'] == 'USER') {
		$_SESSION['id'] = json_decode($response, true)['data']['id'];
		echo '<script>alert("Welcome, CUSTOMER!")</script>';
		echo '<script>windows: location="modal.php"</script>';
	} else if (json_decode($response, true)['data']['type'] == 'ADMIN') {
		$_SESSION['id'] = json_decode($response, true)['data']['id'];
		echo '<script>alert("Welcome, ADMIN!")</script>';
		echo '<script>windows: location="dashboard.php"</script>';
	} else {
		echo '<script>alert("Login failed!")</script>';
		header("location: index.php");
	}
}

curl_close($ch);
