<?php 
session_start();
if (!isset($_SESSION['id'])) {
    echo '<script>window.location="index.php"</script>';
}
?>
<?php
// include 'db.php';
// $id = $_REQUEST['id'];
// $result = mysqli_query($conn, "SELECT * FROM bill WHERE id='$id'");
// while ($row = mysqli_fetch_array($result)) {
//     $prev = $row['prev'];
//     $owners_id = $row['owners_id'];
//     $pres = $row['pres'];
//     $price = $row['price'];
//     $totalcons = $pres - $prev;
//     $bill = $totalcons * $price; 
//     $penalty = $price* 0.1; 
//     $date = $row['date'];
// }


?>

<?php
// include 'db.php';

// $result = mysqli_query($conn, "SELECT * FROM owners WHERE id = '$owners_id'");
// $test = mysqli_fetch_array($result);
// if (!$result) {
//     die("Error: Data not found..");
// }
// $id = $test['id'];
// $lname = $test['lname'];
// $fname = $test['fname'];
// $mi = $test['mi'];
// $address = $test['address'];
// $contact = $test['contact'];

?>
<html>
<head>
    <title>Smart Utilities</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap-theme.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap-theme.min.css" />
    <script>
    function printDiv(data) {
        var printContents = document.getElementById('data').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    </script>
</head>
<body style="background-size:cover; font-family:'Courier New', Courier;">
<style type="text/css">
#data { margin: 0 auto; width: 900px; padding: 20px; border: #066 thin ridge; height: 800px; }
</style>
<div id="data">
    <center>
        <img src="img/logo.png" alt="Company Logo" style="width: 100px; height: auto;"/>
        <h4><b>URBIZTONDO WATER BILLING</b></h4>
        <p><strong>Bill Invoice</strong></p>
        <p>Phone: 09318467146</p>
        <b style="text-align:right; margin-left:250px;"><strong>Date:</strong> <?php echo $date; ?></b>
    </center>
    <div id="context">
        <table class="table table-striped table-bordered">
            <tr>
                <td>Last Name:</td>
                <td><b><i><?php echo $lname; ?></i></b></td>
                <td>Client ID</td>
                <td><i>SMART/00<?php echo $id; ?></i></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><b><i><?php echo $fname; ?></td>
                <td>Meter Number</td>
                <td><?php echo $mi; ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><b><i><?php echo $address; ?></td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td><b><i><?php echo $contact; ?></td>
            </tr>
            <tr>
                <td>Previous Reading:</td>
                <td><b><i><?php echo $prev; ?></td>
                <td>Present Reading:</td>
                <td><b><i><?php echo $pres; ?></td>
            </tr>
            <tr>
                <td>Consumption:</td>
                <td><b><i><?php echo $totalcons; ?></td>
                <td>Price / unit:</td>
                <td><b><i><?php echo $price; ?>&nbsp; </td>
            </tr>
            <td>REMINDERS
                AMOUNT DUE DATE:</td>
            <td>PENALTY AFTER DUE</td>
            <td>10% OF TOTAL</td>
            <td><b><i><?php echo $penalty; ?></td>

                </td>
            <tr>
                <td colspan="4"><center><h2>Total Invoice:<b><i> <?php echo $price; ?> PHP</i></b></h2></center></td>
            </tr>
            <?php
            $session = $_SESSION['id'];
            include 'db.php';
            $result = mysqli_query($conn, "SELECT * FROM user WHERE id= '$session'");
            while ($row = mysqli_fetch_array($result)) {
                $sessionname = $row['name'];
            }
            ?>
            <tr>
                <td>Casher: <?php echo $sessionname; ?></td>
                <td>Signature: _____________</td>
            </tr>
        </table>
    </div>
</div>
<center>
    <button type="button" class="btn btn-default" onclick="printDiv(data)"><span class="glyphicon glyphicon-print"></span>&nbsp;Print Bill</button>&nbsp;
    <a href="modal.php"><button class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Go back</button></a>
</center>
</body>
</html>
