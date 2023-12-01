<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
$product_id = $_POST['product_id'];

$sqlShipped = "SELECT * FROM shipped WHERE id = '$id'";
$queryShipped = $conn->query($sqlShipped);
$rowShipped = $query->fetch_assoc();
$sqlProduct = "SELECT * FROM product WHERE id = '$product_id'";
$queryProduct = $conn->query($sqlProduct);
$rowProduct = $query->fetch_assoc();    
$stok = ($rowProduct['stok'] + $rowShipped['qty']);

$sql_delete = "DELETE FROM shipped WHERE id = '$id'";
$query_delete = $conn->query($sql_delete);
// var_dump($sql_input);
if ($query_delete) {
    $Update_product = "UPDATE product SET stok = '$stok'
                        WHERE id = '$product_id'";
    $query_updateProd = $conn->query($Update_product);
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