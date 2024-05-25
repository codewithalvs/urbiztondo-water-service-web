<?php session_start(); ?>
<?php
//   include 'db.php';
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

// $q = mysqli_query($conn,"select Prev from tempo_bill where Client = '$fname'");
// $results = mysqli_fetch_array($q);
// $previous = $results['Prev'];

// URL to make the GET request
$url = 'http://127.0.0.1:8000/api/admin/customers/' . $_REQUEST['id'];

// Initialize cURL
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);

// Return the response instead of outputting it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the request and store the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true)['data'];

// URL to make the GET request
$url = 'http://127.0.0.1:8000/api/admin/bills/latest/users/' . $_REQUEST['id'];

// Initialize cURL
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);

// Return the response instead of outputting it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the request and store the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Decode the JSON response
$data1 = json_decode($response, true);

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close the cURL session
curl_close($ch);

    if ($http_code == 200) {
      $previous_reading = $data1['data']['present_reading'];
    } else {
      $previous_reading = 0;
    }

?>

<p><h1>Client Bill</h1></p>
 <h1>Name: <?php echo $data['customer']['name'] .'&nbsp;'. $data['customer']['meter_number'];?></h1>
<p><?php $date=date('y/m/d ');
 echo $date;?></p>
 <form method="post" action="addbill.php">
 <table width="400" border="2">
  <table height="200">
  <tr>
  <input type="hidden" name="user_id" value="<?php echo $_REQUEST['id']; ?>" />
    <td width="118">Previous Reading:</td>
    <td width="66"><input type="text" name="previous_reading" value="<?php echo $previous_reading; ?>" /></td>
    <td>ml</td>
  </tr>
  <tr>
    <td>Present Reading:</td>
    <td><input type="text" name="present_reading" /></td>
    <td>ml</td>
  </tr>
  <tr>
    <td>Price/ml</td>
    <td><input type="text" name="price" value="25" /></td>
    <td>PHP</td>
  </tr>
   <tr>
    <td><input type="submit" name="total" value="ENTER" /></td>
  </tr>
</table>
</form>