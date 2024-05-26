<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo '<script>windows: location="index.php"</script>';
}
$session = $_SESSION['id'];

$ch = curl_init();

$url = "http://127.0.0.1:8000/api/admin/dashboard";
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {

    $data = json_decode($response, true)['data'];
}

curl_close($ch);
?>

<!DOCTYPE html>
<html>

<head>
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Billing System</title>
    <style type="text/css">
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            background: url('path_to_your_image.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        #wrapper {
            display: flex;
            height: 100%;
        }

        #sidebar {
            width: 250px;
            background: linear-gradient(to right, rgba(33, 150, 243, 0.9), rgba(3, 169, 244, 0.9)), url('path_to_your_image.jpg') no-repeat center center;
            background-size: cover;
            padding: 10px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .nav-pills {
            flex-direction: column;
        }

        .nav-pills>li {
            width: 100%;
        }

        .nav-pills>li>a {
            border-radius: 0;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .panel-body h1 {
            font: Verdana, Geneva, sans-serif;
            font-weight: bolder;
            text-align: center;
        }

        .logout-container {
            margin-top: auto;
            margin-bottom: 10px;
        }

        .panel-yellow .panel-heading {
            background: linear-gradient(to right, #ffeb3b, #ffc107);
            color: #000;
        }

        .panel-blue .panel-heading {
            background: linear-gradient(to right, #2196f3, #03a9f4);
            color: #fff;
        }

        .panel-red .panel-heading {
            background: linear-gradient(to right, #f44336, #e91e63);
            color: #fff;
        }

        .white-default {
            color: #fff !important;
        }

        .white-default:hover {
            color: #0096FF !important;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar">
            <h2>URBIZTONDO WATER SERVICE</h2>
            <ul class="nav nav-pills">
                <li class="btn btn-default btn-xs"><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>

                <li><a href="billing.php" class="white-default"><span class="glyphicon  white-default"></span>₱ Billing</a></li>
                <li><a href="clients.php" class="white-default"><span class="glyphicon glyphicon-list white-default"></span>&nbsp;Clients</a></li>
                <li><a href="paymentlist.php" class="white-default"><span class="glyphicon glyphicon-list white-default"></span>&nbsp;Payment List</a></li>
            </ul>
            <div class="logout-container" style="color:#F00; font-size:12px;">
                <a href="logout.php"><span class="btn btn-danger glyphicon glyphicon-log-out">&nbsp;Logout</span></a>
            </div>
        </div>
        <div id="content">
            <h4>Welcome To Urbiztondo Ater Billing System, Admin</h4>
            <hr color="#000000" />
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5 style="font-size:24px; font-weight:bold;">Clients</h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h1><?php echo $data['clients']; ?></h1>
                        </div>
                        <a href="clients.php">
                            <div class="panel-footer"><span class="alert-link glyphicon glyphicon-circle-arrow-right"></span>View</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5 style="font-size:24px; font-weight:bold;">Bills</h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h1><?php echo $data['bills']; ?>
                            </h1>
                        </div>
                        <a href="billing.php">
                            <div class="panel-footer"><span class="alert-link glyphicon glyphicon-circle-arrow-right"></span>View</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5 style="font-size:24px; font-weight:bold;">Payments</h5>
                            </div>
                        </div>
                        <div class="panel-body">
                            <h1><?php echo $data['payments']; ?>
                            </h1>
                        </div>
                        <a href="paymentlist.php">
                            <div class="panel-footer"><span class="alert-link glyphicon glyphicon-circle-arrow-right"></span>View</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
</body>

</html>