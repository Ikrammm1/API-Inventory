<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];

$sql_delete = "DELETE FROM users WHERE id = '$id'";
$query_delete = $conn->query($sql_delete);
// var_dump($sql_input);
if ($query_delete) {
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