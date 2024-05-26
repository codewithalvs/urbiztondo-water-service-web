<?php session_start();
if (!isset($_SESSION['id'])) {
    echo '<script>windows: location="index.php"</script>';
}
?>

<?php

$url = 'http://127.0.0.1:8000/api/admin/customers/' . $_SESSION['id'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    $data = json_decode($response, true)['data'];
}

curl_close($ch);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <div class="profile-card">
        <div class="header"></div>
        <div class="profile-picture">
            <img src="img/logo1.jpg" alt="Kunle Coker">
        </div>
        <div class="profile-info">
            <h1><?php echo $data['customer']['name']; ?></h1>

        </div>
        <div class="profile-actions">
            <a href="viewbill1.php?id=<?php echo $_SESSION['id']; ?>" class="message">VIEW BILL</a>
            <a href="bayad.php" class="follow">PAY BILL</a>
        </div>
    </div>
</body>

</html>