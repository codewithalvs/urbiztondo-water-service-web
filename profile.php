<?php session_start();
if (!isset($_SESSION['id'])) {
    echo '<script>windows: location="index.php"</script>';
}
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
            <h1>ALVIC REYES</h1>

        </div>
        <div class="profile-actions">
            <a href="viewbill1.php?id=<?php echo $_SESSION['id']; ?>" class="message">VIEW BILL</a>
            <a href="bayad.php" class="follow">PAY BILL</a>
        </div>
    </div>
</body>

</html>