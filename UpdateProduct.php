<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
		$category_id = $_POST['category_id'];
		$supplier_id = $_POST['supplier_id'];
		$name = $_POST['name'];
		$stok = $_POST['stok'];
		$price = $_POST['price'];
		$description = $_POST['description'];

$sql_update = "UPDATE product SET 
    category_id = '$category_id', 
    supplier_id = '$supplier_id', 
    name = '$name' ,
    stok = '$stok' ,
    price = '$price',
    description = '$description'
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