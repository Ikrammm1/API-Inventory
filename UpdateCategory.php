<?php
include './conn.php';

//ambil data yang dikirim dari android
$category_id = $_POST['category_id'];
$name = $_POST['name'];
        $status = $_POST['status'];

$sql_update = "UPDATE category SET 
    name = '$name' ,
    status = '$status'
WHERE category_id = '$category_id'";
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