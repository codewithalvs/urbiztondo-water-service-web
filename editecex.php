<?php
$url = 'http://127.0.0.1:8000/api/admin/customers/' . $_POST['id'];

$data = array(
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone_number' => $_POST['phone_number'],
    'address' => $_POST['address'],
    'meter_number' => $_POST['meter_number'],
);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_CUSTOMREQUEST => 'PATCH',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);

if ($response === false) {
    echo 'cURL error: ' . curl_error($curl);
} else {
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_code == 200) {
        echo '<script>alert("Customer updated successfully!")</script>';
        echo "<script>windows: location='clients.php'</script>";
    } else {
        echo '<script>alert("Failed to update customer!")</script>';
        echo "<script>windows: location='clients.php'</script>";
    }
}

curl_close($curl);
