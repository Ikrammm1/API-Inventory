<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$status = $_POST['status'];

$sql_update = "UPDATE supplier SET 
    name = '$name', 
    address = '$address',
    phone_number = '$phone_number',
    status = '$status'
WHERE id = '$id'";
$query_update = $conn->query($sql_update);
// var_dump($sql_input);
if ($query_update) {
    echo json_encode(
        array(
            'status' => true,
            'message' => 'Success',
        )
    );
} else {
    echo json_encode(
        array(
            'status' => false,
            'message' => 'Kesalahan',
        )
    );
}


// mengatur tampilan json

header('Content-Type: application/json');