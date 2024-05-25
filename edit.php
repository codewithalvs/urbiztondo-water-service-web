<?php session_start(); ?>
<?php

$apiUrl = 'http://127.0.0.1:8000/api/admin/customers/' . $_REQUEST['id'];

$options = [
  'http' => [
    'method' => 'GET',
    'header' => 'Content-Type: application/json',
  ]
];

$context = stream_context_create($options);

$response = file_get_contents($apiUrl, false, $context);

if ($response === FALSE) {
  die('Error occurred');
}

$data = json_decode($response, true)['data'];

?>

<p>
<h1>Owners Update</h1>
</p>
<form method="post" action="editecex.php">
  <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
  <table width="342" border="0">
    <tr>
      <td>Name:</td>
      <td><input type="text" name="name" value="<?php echo $data['customer']['name']; ?>" required /></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input type="text" name="email" value="<?php echo $data['customer']['email']; ?>" required /></td>
    </tr>
    <tr>
      <td>Phone Number:</td>
      <td><input type="text" name="phone_number" value="<?php echo $data['customer']['phone_number']; ?>" required /></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td><input type="text" name="address" value="<?php echo $data['customer']['address']; ?>" required /></td>
    </tr>
    <tr>
      <td>Meter Number:</td>
      <td><input type="text" name="meter_number" value="<?php echo $data['customer']['meter_number']; ?>" required /></td>
    </tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="save" value="Edit" /></td>
    </tr>
  </table>