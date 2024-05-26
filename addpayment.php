<?php
$url = 'http://127.0.0.1:8000/api/admin/payments/users/' . $_POST['user_id'];

$data = [
    "payment_method" => $_POST['payment_method'],
    "amount" => $_POST['amount'],
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
    echo '<script>alert("Created payment successfully!")</script>';
    echo '<script>windows: location="profile.php"</script>';
}

curl_close($ch);
