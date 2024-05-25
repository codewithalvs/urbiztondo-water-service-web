<?php
// include 'db.php';
// $owner_id =$_REQUEST['id'];
// 	$id = $_POST['id'];
// 	$lname = $_POST['lname'];
// 	$fname = $_POST['fname'];
// 	$mi = $_POST['mi'];
// 	$address=$_POST['address'] ;
// 	$contact=$_POST['contact'] ;

// 	mysqli_query($conn,"UPDATE owners SET id ='$id', lname ='$lname',
// 		 fname ='$fname',mi ='$mi', address='$address', contact='$contact' WHERE id = '$owner_id'");
			
// API endpoint URL
$url = 'http://127.0.0.1:8000/api/admin/customers/' . $_POST['id'];

// Data to be sent in the PATCH request
$data = array(
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone_number' => $_POST['phone_number'],
    'address' => $_POST['address'],
    'meter_number' => $_POST['meter_number'],
);

// Initialize cURL session
$curl = curl_init();

// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_CUSTOMREQUEST => 'PATCH', // Use PATCH method
    CURLOPT_POSTFIELDS => json_encode($data), // Convert data to JSON format
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
    ),
));

// Execute cURL request and get the response
$response = curl_exec($curl);

// Check for errors
if ($response === false) {
    echo 'cURL error: ' . curl_error($curl);
} else {
    // Handle response
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_code == 200) {
		echo '<script>alert("Customer updated successfully!")</script>';
		echo "<script>windows: location='clients.php'</script>";	
        // echo 'Customer email updated successfully.';
    } else {
		echo '<script>alert("Failed to update customer!")</script>';
		echo "<script>windows: location='clients.php'</script>";
        // echo 'Failed to update customer email. HTTP Status Code: ' . $http_code;
    }
}

// Close cURL session
curl_close($curl);

?>



		 			
			