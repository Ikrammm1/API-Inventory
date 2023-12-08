<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
$dateIn = $_POST['date_in'];
$product_id = $_POST['product_id'];
$qty = $_POST['qty'];
$description = $_POST['description'];

$sqlRecieved = "SELECT * FROM received WHERE id = '$id'";
$queryRecieved = $conn->query($sqlRecieved);
$rowRecieved = $queryRecieved->fetch_assoc();
$sqlProduct = "SELECT * FROM product WHERE id = '$product_id'";
$queryProduct = $conn->query($sqlProduct);
$rowProduct = $queryProduct->fetch_assoc();    
$stok = ($rowProduct['stok'] - $rowRecieved['qty'] + $qty);


$sql_update = "UPDATE received SET 
    date_in = '$dateIn',
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