<?php session_start();
if (!isset($_SESSION['id'])) {
  echo '<script>windows: location="index.php"</script>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
  <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="css/bootstrap/dist/js/jquery.js"></script>
  <script src="css/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="lib/jquery.js" type="text/javascript"></script>
  <script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage: 'src/loading.gif',
        closeImage: 'src/closelabel.png'
      })
    })
  </script>
  <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
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

    .user-contain {
      width: 100%;
      /* background:blue; */
    }

    #wrapper {
      display: flex;
      height: 100%;
      width: 100%;
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
      /* background: linear-gradient(to right, rgba(33, 150, 243, 0.9), rgba(3, 169, 244, 0.9)), url('path_to_your_image.jpg') no-repeat center center; */
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
        <li><a href="dashboard.php" class="white-default"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
        <li><a href="billing.php" class="white-default"><span class="glyphicon  white-default"></span>₱ Billing</a></li>
        <li class="btn btn-default btn-xs"><a href="clients.php"><span class="glyphicon glyphicon-list white-default"></span>&nbsp;Clients</a></li>
      </ul>
      <div class="logout-container" style="color:#F00; font-size:12px;">
        <a href="logout.php"><span class="btn btn-danger glyphicon glyphicon-log-out">&nbsp;Logout</span></a>
      </div>
    </div>
    <div id="content">
      <div class="user-contain">
        <div id="wrapper user-contain">


          <div style="overflow:scroll; height:350px;">
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <!-------- home panel ----------------------------->
                <!-----------------modal  ------------->


                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog" style="width:400px;">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Water Billing System</h4>
                      </div>
                      <div class="modal-body">
                        <p><?php include "addclient.php"; ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
                <!-------------------------- modal ends ---------------------------->


                <div class="panel panel-info">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <h5>System Clients</h5>
                      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"> + Add client</button>
                    </div>
                  </div>
                  <div class="panel-body">

                    <?php

                    $url = 'http://127.0.0.1:8000/api/admin/customers';

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

                    echo "<table class=\"table\" bgcolor='#fff'>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone Number</th>
<th>Address</th>
<th>Meter Number</th>
<th>Action</th>
</tr>";

                    foreach ($data as $user) {
                      $userId = $user['id'];
                      $customer = $user['customer'];

                      $customerId = isset($customer['id']) ? $customer['id'] : null;
                      $name = isset($customer['name']) ? $customer['name'] : null;
                      $email = isset($customer['email']) ? $customer['email'] : null;
                      $phoneNumber = isset($customer['phone_number']) ? $customer['phone_number'] : null;
                      $address = isset($customer['address']) ? $customer['address'] : null;
                      $meterNumber = isset($customer['meter_number']) ? $customer['meter_number'] : null;

                      echo "<tr>";
                      echo "<td>" . $name . "</td>";
                      echo "<td>" . $email . "</td>";
                      echo "<td>" . $phoneNumber . "</td>";
                      echo "<td>" . $address . "</td>";
                      echo "<td>" . $meterNumber . "</td>";
                      echo "<td><a rel='facebox' href='edit.php?id=" . $userId . "'><button class=\"btn btn-default btn-xs\"><span class=\"glyphicon glyphicon-edit\"></span></button> </a>| ";
                      echo "<a rel='facebox' href='del.php?id=" . $userId . "'><button class=\"btn btn-danger btn-xs\"><span class=\"glyphicon glyphicon-trash \"></span></button></td>";
                      echo "</tr>";
                    }

                    echo "</table>";

                    ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-----  ######################################### -->


        </div>
      </div>
    </div>
    <script src="js/jquery.js"></script>
</body>

</html>