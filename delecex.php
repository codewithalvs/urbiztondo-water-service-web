<?php
// include 'db.php';
// 	$id = $_POST['id'];
// 	mysqli_query($conn,"DELETE from owners WHERE id='$id'");

// The URL to send the DELETE request to
$url = "http://127.0.0.1:8000/api/admin/customers/" . $_POST['id'];

// Initialize cURL session
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Optional: if your API requires authentication, set the headers like this
$headers = [
    'Content-Type: application/json'
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode the response if it's in JSON format (optional)
    $responseDecoded = json_decode($response, true);

	if ($responseDecoded['success']) {
		echo "<script>windows: location='clients.php'</script>";	
	} 
	else {
		echo "<script>alert(". $responseDecoded['message'] .")</script>";
	}
    
    // Print the response
}

// Close the cURL session
curl_close($ch);

		 			
			