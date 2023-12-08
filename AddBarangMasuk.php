<?php
include './conn.php';

//ambil data yang dikirim dari android
$dateIn = $_POST['date_in'];
$admin = $_POST['admin'];
$product_id = $_POST['product_id'];
$qty = $_POST['qty'];
$description = $_POST['description'];

$sql_input = "INSERT INTO received (
                date_in, 
                admin,
                product_id, 
                qty,
                description) 
            VALUES ('$dateIn', 
                '$admin', 
                '$product_id', 
                '$qty', 
                '$description')";
$query_input = $conn->query($sql_input);
// var_dump($sql_input);
if ($query_input) {
    $sql = "SELECT * FROM product WHERE id = '$product_id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $stok = ($row['stok'] + $qty);

    $Update_product = "UPDATE product SET stok = '$stok'
                        WHERE id = '$product_id'";
    $query_update = $conn->query($Update_product);
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