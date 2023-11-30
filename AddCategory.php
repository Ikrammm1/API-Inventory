<?php
include './conn.php';

//ambil data yang dikirim dari android
$name = $_POST['name'];

$sql_input = "INSERT INTO category (name) 
            VALUES ('$name')";
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