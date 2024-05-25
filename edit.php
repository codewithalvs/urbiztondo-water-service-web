<?php session_start(); ?>
<?php
// include 'db.php';
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

<p><h1>Owners Update</h1></p>
  <form method="post" action="editecex.php">
  <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
<table width="342" border="0">
  <tr>
    <td>Name:</td>
    <td><input type="text" name="name" value="<?php echo $data['customer']['name']; ?>" required/></td>
    </tr>
  <tr>
    <td>Email:</td>
    <td><input type="text" name="email" value="<?php echo $data['customer']['email']; ?>" required/></td>
    </tr>
  <tr>
    <td>Phone Number:</td>
    <td><input type="text" name="phone_number" value="<?php echo $data['customer']['phone_number']; ?>" required/></td>
    </tr>
  <tr>
    <td>Address:</td>
    <td><input type="text" name="address" value="<?php echo $data['customer']['address']; ?>" required/></td>
    </tr>
  <tr>
    <td>Meter Number:</td>
    <td><input type="text" name="meter_number" value="<?php echo $data['customer']['meter_number']; ?>" required/></td>
    </tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="save" value="Edit"  /></td>
	</tr>
</table>