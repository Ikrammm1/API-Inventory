<?php
include './conn.php';

//ambil data yang dikirim dari android
$dateOut = $_POST['date_out'];
$admin = $_POST['admin'];
$product_id = $_POST['product_id'];
$qty = $_POST['qty'];
$description = $_POST['description'];

$sql = "SELECT * FROM product WHERE id = '$product_id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $stok = ($row['stok'] - $qty);

if($row['stok'] >= $qty){

    $sql_input = "INSERT INTO shipped (
        date_out, 
        admin,
        product_id, 
        qty,
        description) 
    VALUES ('$dateOut', 
        '$admin', 
        '$product_id', 
        '$qty', 
        '$description')";
    $query_input = $conn->query($sql_input);
    
    if ($query_input) {

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

}else{
    echo json_encode(
        array(
            'status' => false,
            'message' => 'Quantity Melebihi Stok Persediaan',
        )
    );
}



// mengatur tampilan json

header('Content-Type: application/json')
?>