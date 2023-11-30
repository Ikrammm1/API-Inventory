<?php
include './conn.php';

//ambil data yang dikirim dari android
$name = $_POST['name'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];

$sql_input = "INSERT INTO supplier (name, address, phone_number) 
            VALUES ('$name','$address','$phone_number')";
$query_input = $conn->query($sql_input);
// var_dump($sql_input);
if ($query_input) {
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

header('Content-Type: application/json')
?>