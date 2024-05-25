<?php
$url = 'http://127.0.0.1:8000/api/admin/bills/users/' . $_POST['user_id'];

$data = [
    "previous_reading" => $_POST['previous_reading'],
    "present_reading" => $_POST['present_reading'],
    "price" => $_POST['price']
];

$jsonData = json_encode($data);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo '<script>alert("Created bill successfully!")</script>';
    echo '<script>windows: location="billing.php"</script>';
}

curl_close($ch);
