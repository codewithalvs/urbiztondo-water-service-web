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
    <title>Bayad</title>
    <link rel="stylesheet" href="bayad.css">
</head>

<body>
    <h1>Payment Area</h1>
    <form method="post" action="addpayment.php">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" />
        <table class="form-table">
            <tr>
                <td class="label">Amount:</td>
                <td colspan="2"><input type="text" name="amount" placeholder="100" required /></td>
                <td class="unit">PHP</td>
            </tr>
            <tr>
                <td class="label">Payment Method:</td>
                <td colspan="3">
                    <select name="payment_method">
                        <option value="CASH">CASH</option>
                        <option value="G-CASH">G-CASH</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="submit-cell"><input type="submit" name="total" value="ENTER" /></td>
            </tr>
        </table>
    </form>
</body>

</html>