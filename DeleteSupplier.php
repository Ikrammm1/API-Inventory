<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
$status = "nonaktif";
$sql_update = "UPDATE supplier SET 
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