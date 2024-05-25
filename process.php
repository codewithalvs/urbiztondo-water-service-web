<?php
 session_start();
 

// include 'db.php';    
  
//  $login = mysqli_query($conn,"SELECT * FROM user WHERE username = '" .$_POST['username'] . "' and password = '" .$_POST['password'] . "'");
//  $row=mysqli_fetch_array($login);  
 
// URL to send the POST request to
$url = 'http://127.0.0.1:8000/api/login';

// Data to be sent in the POST request
$data = array(
    'username' => $_POST['username'],
    'password' => $_POST['password'],
);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// Execute the POST request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {

	if (json_decode($response, true)['data']['type'] == 'USER') {
		$_SESSION['id'] = json_decode($response, true)['data']['id'];
		echo '<script>alert("Welcome, CUSTOMER!")</script>';
		echo '<script>windows: location="modal.php"</script>';
	}

	else if (json_decode($response, true)['data']['type'] == 'ADMIN') {
		$_SESSION['id'] = json_decode($response, true)['data']['id'];
		echo '<script>alert("Welcome, ADMIN!")</script>';
		echo '<script>windows: location="billing.php"</script>';
	}

	else {

		echo '<script>alert("Login failed!")</script>';
		header ("location: index.php?err");
	}

    // echo 'Response: ' . $response;
}

// Close the cURL session
curl_close($ch);
 
?>
