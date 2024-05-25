<?php 
session_start();
if(!isset($_SESSION['id'])){
    echo '<script>windows: location="index.php"</script>';
}
$session=$_SESSION['id'];
include 'db.php';
$result = mysqli_query($conn,"SELECT * FROM user where id= '$session'");
while($row = mysqli_fetch_array($result)) {
    $sessionname = $row['name'];
}

$results = mysqli_query($conn,"SELECT * FROM user");
$users = mysqli_num_rows($results);

$results = mysqli_query($conn,"SELECT * FROM bill");
$bill = mysqli_num_rows($results);

$jibu = mysqli_query($conn,"SELECT * FROM owners");
$client = mysqli_num_rows($jibu);
?>

<?php
if (isset($_POST['add'])) {	   
    include 'db.php';
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mi = $_POST['mi'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    
    mysqli_query($conn,"INSERT INTO owners (id,lname,fname,mi,address,contact) VALUES ('$id','$lname','$fname','$mi','$address','$contact')"); 
    echo '<script>alert("success")</script>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css"  href="css/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Billing System</title>
    <style type="text/css">
        body, html {
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
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
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
        .nav-pills > li {
            width: 100%;
        }
        .nav-pills > li > a {
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
        .white-default{
          color: #fff !important; 
        }
        .white-default:hover{
          color: #0096FF !important; 
        }
    </style>
</head>

<body>
<div id="wrapper">
    <div id="sidebar">
        <h2>URBIZTONDO WATER SERVICE</h2>
        <ul class="nav nav-pills">
            <li class="btn btn-default btn-xs"><a href="billing.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>

            <li ><a href="bill.php" class="white-default"><span class="glyphicon  white-default"></span>₱ Billing</a></li>
            <li ><a href="clients.php" class="white-default"><span class="glyphicon glyphicon-list white-default"></span>&nbsp;Clients</a></li>
        </ul>
        <div class="logout-container" style="color:#F00; font-size:12px;">
            <span><?php echo $sessionname;?></span>
            <a href="logout.php"><span class="btn btn-danger glyphicon glyphicon-log-out">&nbsp;Logout</span></a>
        </div>
    </div>
    <div id="content">
        <h4>Welcome To Urbiztondo Ater Billing System, <?php echo $sessionname; ?></h4>
        <hr color="#000000" />
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="panel-title"><h5 style="font-size:24px; font-weight:bold;">Clients</h5></div>
                    </div>
                    <div class="panel-body">
                        <h1><?php echo $client; ?></h1>
                    </div>
                    <a href="clients.php"><div class="panel-footer"><span class="alert-link glyphicon glyphicon-circle-arrow-right"></span>View</div></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                        <div class="panel-title"><h5 style="font-size:24px; font-weight:bold;">Users</h5></div>
                    </div>
                    <div class="panel-body">
                        <h1><?php echo $users; ?></h1>
                    </div>
                    <a href="user.php"><div class="panel-footer"><span class="alert-link glyphicon glyphicon-circle-arrow-right"></span>View</div></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="panel-title"><h5 style="font-size:24px; font-weight:bold;">Bills and Income</h5></div>
                    </div>
                    <div class="panel-body">
                        <h1><?php echo $bill; ?>
                        <?php
                        include "db.php";
                        $add = mysqli_query($conn,"SELECT SUM(price) FROM Bill");
                        while($row1 = mysqli_fetch_array($add)) {
                            $total = $row1['SUM(price)'];
                        }
                        ?>
                        </h1>
                    </div>
                    <a href="bill.php"><div class="panel-footer"><span class="alert-link glyphicon glyphicon-circle-arrow-right"></span>View</div></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script type="text/javascript">
$(function() {
    $(".delbutton").click(function(){
        var element = $(this);
        var del_id = element.attr("id");
        var info = 'id=' + del_id;
        if(confirm("Sure you want to delete this update? There is NO undo!")) {
            $.ajax({
                type: "GET",
                url: "delete.php",
                data: info,
                success: function(){}
            });
            $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
            .animate({ opacity: "hide" }, "slow");
        }
        return false;
    });
});
</script>
</body>
</html>
