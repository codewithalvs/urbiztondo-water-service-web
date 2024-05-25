<?php
// if (isset($_POST['add']))
// 	{	   


// include 'db.php';
			 		
// 					$lname= $_POST['lname'] ;					
// 					$fname=$_POST['fname'] ;
// 					$mi=$_POST['mi'] ;
// 					$address=$_POST['address'] ;
// 					$contact=$_POST['contact'] ;
// 					$meterReader = $_POST['meterReader'];
					
// 		 mysqli_query($conn,"INSERT INTO  owners (lname,fname,mi,address,contact) 
// 		 VALUES ('$lname','$fname','$mi','$address','$contact')"); 
// 		 mysqli_query($conn,"INSERT INTO  tempo_bill (Client,Prev)
// 		 VALUES ('$fname','$meterReader')");
				
				
				
				
	        // }
	
			$url = 'http://127.0.0.1:8000/api/admin/customers';

			// Data to be sent in the POST request
			$data = array(
				'username' => $_POST['username'],
				'password' => $_POST['password'],
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'phone_number' => $_POST['phone_number'],
				'address' => $_POST['address'],
				'meter_number' => $_POST['meter_number'],
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
				
				if (json_decode($response, true)['success']) {
					echo '<script>alert("Customer created successfully!")</script>';
					header("Location: clients.php");
				}

				else {
					echo '<script>alert("Failed to add customer!")</script>';
					header("Location: clients.php");
				}
			
				// else {
			
				// 	header ("location: index.php?err");
				// }
			
				// echo 'Response: ' . $response;
			}
			
			// Close the cURL session
			curl_close($ch);


?>