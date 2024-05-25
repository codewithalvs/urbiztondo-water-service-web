<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap-theme.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap-theme.min.css" />
</head>

<!-- <h4>Note: Bill Amount = Total Consumption * Price/unit<br />&copy; 2024</h4> -->
<?php
// include 'db.php';
// $id = $_REQUEST['id'];
// $result = mysqli_query($conn,"SELECT * FROM bill where owners_id='$id'");

echo "<table class=\"table table-striped table-hover table-bordered\">
<tr>
<th>Previous Reading</th>
<th>Present Reading</th>
<th>Consumption</th>
<th>Price</th>
<th>Date</th>
<th>Action</th>
</tr>";

// while($row = mysqli_fetch_array($result))
// {
//     $prev = $row['prev'];
//     $pres = $row['pres'];
//     $price = $row['price'];
//     $totalcons = $pres - $prev;
//     $bill = $price ; 
//     $penalty = $bill* 0.1; 

$url = 'http://127.0.0.1:8000/api/admin/bills/users/' . $_REQUEST['id'];

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the GET request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    curl_close($ch);
    exit;
} else {
    $data = json_decode($response, true)['data'];
}

// Close cURL session
curl_close($ch);

foreach ($data as $key => $value) {

    echo "<tr>";
    echo "<td>" . $value['previous_reading'] . "</td>";
    echo "<td>" . $value['present_reading'] . "</td>";
    echo "<td>" . $value['consumption'] . "</td>";
    echo "<td>" . $value['price'] . "</td>";
    echo "<td>" . $value['date'] . "</td>";
    echo "<td><a rel='facebox' href='viewpayment.php?id=".$value['id']."&user_id=".$value['user_id']."'><span class=\"glyphicon glyphicon-eye-open\">View </a>| ";
    echo "<a rel='facebox' href='delbill.php?id=".$value['id']."'>Del</td>";
    echo "</tr>";
// }

}
echo "</table>";


?>

</html>
