<?php session_start(); ?>
<?php
//  include 'db.php';
// $owner_id =$_REQUEST['id'];

// $result = mysqli_query($conn,"SELECT * FROM owners WHERE id  = '$owner_id'");
// $test = mysqli_fetch_array($result);
// if (!$result) 
// 		{
// 		die("Error: Data not found..");
// 		}
// 				$id=$test['id'] ;
// 				$lname= $test['lname'] ;					
// 				$fname=$test['fname'] ;
// 				$mi=$test['mi'] ;
// 				$address=$test['address'] ;
// 				$contact=$test['contact'] ;

// 

// API endpoint
$apiUrl = 'http://127.0.0.1:8000/api/admin/customers/' . $_REQUEST['id'];

// Set up the HTTP context options for a GET request
$options = [
    'http' => [
        'method' => 'GET',
        'header' => 'Content-Type: application/json',
    ]
];

// Create a stream context
$context = stream_context_create($options);

// Send the GET request
$response = file_get_contents($apiUrl, false, $context);

// Check if the request was successful
if ($response === FALSE) {
    die('Error occurred');
}

// Decode the JSON response
$data = json_decode($response, true)['data'];


?>



<form action="delecex.php" method="post">
<h4>Are you sure you want to delete <br /></h4><h5><?php echo $data['customer']['name']; ?></h5>
<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
<input type="submit" nsme="ok" value="Delete">
</form>