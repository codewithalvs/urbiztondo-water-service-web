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

<form action="delecex.php" method="post">
    <h4>Are you sure you want to delete <br /></h4>
    <h5><?php echo $data['customer']['name']; ?></h5>
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
    <input type="submit" nsme="ok" value="Delete">
</form>