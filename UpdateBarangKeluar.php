<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
$dateOut = $_POST['date_out'];
$admin = $_POST['admin'];
$product_id = $_POST['product_id'];
$qty = $_POST['qty'];
$description = $_POST['description'];

$sqlShipped = "SELECT * FROM shipped WHERE id = '$id'";
$queryShipped = $conn->query($sqlShipped);
$rowShipped = $query->fetch_assoc();
$sqlProduct = "SELECT * FROM product WHERE id = '$product_id'";
$queryProduct = $conn->query($sqlProduct);
$rowProduct = $query->fetch_assoc();    
$stok = ($rowProduct['stok'] + $rowShipped['qty'] - $qty);


$sql_update = "UPDATE shipped SET 
    date_out = '$dateOut', 
    admin = '$admin', 
    product_id = '$product_id',
    qty = '$qty' ,
    description = '$description'
WHERE id = '$id'";
$query_update = $conn->query($sql_update);
// var_dump($sql_input);
if ($query_update) {
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