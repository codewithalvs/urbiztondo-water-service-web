<?php session_start(); ?>
<?php

$url = 'http://127.0.0.1:8000/api/admin/customers/' . $_REQUEST['id'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
}

curl_close($ch);

$data = json_decode($response, true)['data'];

$url = 'http://127.0.0.1:8000/api/admin/bills/latest/users/' . $_REQUEST['id'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
}

$data1 = json_decode($response, true);

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($http_code == 200) {
  $previous_reading = $data1['data']['present_reading'];
} else {
  $previous_reading = 0;
}

?>

<p>
<h1>Client Bill</h1>
</p>
<h1>Name: <?php echo $data['customer']['name'] . '&nbsp;' . $data['customer']['meter_number']; ?></h1>
<p><?php $date = date('y/m/d ');
    echo $date; ?></p>
<form method="post" action="addbilling.php">
  <table width="400" border="2">
    <table height="200">
      <tr>
        <input type="hidden" name="user_id" value="<?php echo $_REQUEST['id']; ?>" />
        <td width="118">Previous Reading:</td>
        <td width="66"><input type="text" name="previous_reading" value="<?php echo $previous_reading; ?>" /></td>
        <td>ml</td>
      </tr>
      <tr>
        <td>Present Reading:</td>
        <td><input type="text" name="present_reading" /></td>
        <td>ml</td>
      </tr>
      <tr>
        <td>Price/ml</td>
        <td><input type="text" name="price" value="25" /></td>
        <td>PHP</td>
      </tr>
      <tr>
        <td><input type="submit" name="total" value="ENTER" /></td>
      </tr>
    </table>
</form>