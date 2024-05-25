<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo '<script>window.location="index.php"</script>';
}
?>
<?php

$url = 'http://127.0.0.1:8000/api/admin/customers/' . $_REQUEST['user_id'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close($ch);

$data = json_decode($response, true)['data'];

?>

<?php

$url = 'http://127.0.0.1:8000/api/admin/bills/' . $_REQUEST['id'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close($ch);

$data1 = json_decode($response, true)['data'];

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
        #data {
            margin: 0 auto;
            width: 900px;
            padding: 20px;
            border: #066 thin ridge;
            height: 800px;
        }
    </style>
    <div id="data">
        <center>
            <img src="img/logo.png" alt="Company Logo" style="width: 100px; height: auto;" />
            <h4><b>URBIZTONDO WATER BILLING</b></h4>
            <p><strong>Bill Invoice</strong></p>
            <p>Phone: <?php echo $data['customer']['phone_number']; ?></p>
            <b style="text-align:right; margin-left:250px;"><strong>Date:</strong> <?php echo date('y/m/d'); ?></b>
        </center>
        <div id="context">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>Name:</td>
                    <td><b><i><?php echo $data['customer']['name']; ?></i></b></td>
                    <td>Client ID:</td>
                    <td><i>SMART/00<?php echo $data['id']; ?></i></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><b><i><?php echo $data['customer']['email']; ?></td>
                    <td>Meter Number:</td>
                    <td><?php echo $data['customer']['meter_number']; ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><b><i><?php echo $data['customer']['address']; ?></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><b><i><?php echo $data['customer']['phone_number']; ?></td>
                </tr>
                <tr>
                    <td>Previous Reading:</td>
                    <td><b><i><?php echo $data1['previous_reading']; ?></td>
                    <td>Present Reading:</td>
                    <td><b><i><?php echo $data1['present_reading']; ?></td>
                </tr>
                <tr>
                    <td>Consumption:</td>
                    <td><b><i><?php echo $data1['consumption']; ?></td>
                    <td>Price / unit:</td>
                    <td><b><i><?php echo $data1['price']; ?>&nbsp; </td>
                </tr>
                <td>REMINDERS
                    AMOUNT DUE DATE:</td>
                <td>PENALTY AFTER DUE</td>
                <td>10% OF TOTAL</td>
                <td><b><i><?php echo $data1['price'] * 0.1; ?></td>

                </td>
                <tr>
                    <td colspan="4">
                        <center>
                            <h2>Total Invoice:<b><i> <?php echo $data1['price']; ?> PHP</i></b></h2>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td>Casher: _____________</td>
                    <td>Signature: _____________</td>
                </tr>
            </table>
        </div>
    </div>
    <center>
        <button type="button" class="btn btn-default" onclick="printDiv(data)"><span class="glyphicon glyphicon-print"></span>&nbsp;Print Bill</button>&nbsp;
        <a href="dashboard.php"><button class="btn btn-danger"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Go back</button></a>
    </center>
</body>

</html>