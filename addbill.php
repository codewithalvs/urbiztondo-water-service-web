<?php
// include 'db.php';
	
// 	$owners_id = $_POST['owners_id'];
// 	$prev = $_POST['prev'];
// 	$pres = $_POST['pres'];
// 	$totalcun = $pres - $prev;
// 	$price = $_POST['price'];
// 	$pricetotal = $totalcun * $price;
// 	$date=$_POST['date'] ;
	

// 	mysqli_query($conn,"INSERT INTO  bill (owners_id,prev,pres,price,date) 
// 		 VALUES ('$owners_id','$prev','$pres','$pricetotal','$date')"); 
		 
// 	mysqli_query($conn,"UPDATE tempo_bill SET Prev = '$pres' where id ='$owners_id'");

// URL to make the POST request to
$url = 'http://127.0.0.1:8000/api/admin/bills/users/' . $_POST['user_id'];

// Data to send in the JSON body
$data = [
    "previous_reading" => $_POST['previous_reading'],
    "present_reading" => $_POST['present_reading'],
    "price" => $_POST['price']
];

// Convert the data array to a JSON string
$jsonData = json_encode($data);

// Initialize cURL session
$ch = curl_init($url);

// Set the necessary cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
]); // Set the content type to application/json
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Attach the JSON data

// Execute the POST request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Print the response from the server
    echo '<script>alert("Created bill successfully!")</script>';
	echo '<script>windows: location="bill.php"</script>';
}

// Close the cURL session
curl_close($ch);
?>


				
	