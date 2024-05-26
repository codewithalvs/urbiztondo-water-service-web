<?php session_start();
if(!isset($_SESSION['id'])){
	echo '<script>windows: location="index.php"</script>';
	
	}
?>
<?php
$session=$_SESSION['id'];
include 'db.php';
$result = mysqli_query($conn,"SELECT * FROM user where id= '$session'");
while($row = mysqli_fetch_array($result))
  {
  $sessionname=$row['name'];

  }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css"  href="css/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
	jQuery(document).ready(function($) {
	  $('a[rel*=facebox]').facebox({
		loadingImage : 'src/loading.gif',
		closeImage   : 'src/closelabel.png'
	  })
	})
  </script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>	
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
.user-contain{
  width:100%;
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
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
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
            <li ><a href="billing.php" class="white-default"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
            <li class="btn btn-default btn-xs"><a href="bill.php" ><span class="glyphicon  white-default"></span>&nbsp;₱ Billing</a></li>
            <li ><a href="clients.php" class="white-default"><span class="glyphicon glyphicon-list white-default"></span>&nbsp;Clients</a></li>
        </ul>
        <div class="logout-container" style="color:#F00; font-size:12px;">
            <span><?php echo $sessionname;?></span>
            <a href="logout.php"><span class="btn btn-danger glyphicon glyphicon-log-out">&nbsp;Logout</span></a>
        </div>
    </div>
    <div id="content">
    <div class="user-contain">
<div id="wrapper user-contain">
<div  style="overflow:scroll; height:350px;">
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <!-------- home panel ----------------------------->
      
      
         <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title bg-green 100"><h5>Billing Sequence</h5></div>
            </div>
              <div class="panel-body">
            
              <?php
// include 'db.php';
// $result = mysqli_query($conn,"SELECT * FROM owners");

$url = 'http://127.0.0.1:8000/api/admin/customers';

// Initialize a cURL session
$ch = curl_init();

// Set the URL
curl_setopt($ch, CURLOPT_URL, $url);

// Return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the request and store the response
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Decode the JSON response
    $data = json_decode($response, true)['data'];
}

// Close the cURL session
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
  echo "<td><a rel='facebox' href='paybill.php?id=".$userId."'><span class=\" btn btn-success \"> Create Bills </span> </a>| ";
  echo "<a rel='facebox' href='viewbill.php?id=".$userId."'><span class=\"btn btn-danger \">View Bill Record</span></td>";
  echo "</tr>";
}

// while($row = mysqli_fetch_array($result))
//   {
  
//   }
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
 <script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "delete.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>






