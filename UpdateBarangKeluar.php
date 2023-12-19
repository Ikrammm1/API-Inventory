<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
$id_awal = $_POST['id_awal'];
$dateOut = $_POST['date_out'];
$product_id = $_POST['product_id'];
$qty = $_POST['qty'];
$qty_awal = $_POST['qty_awal'];
$description = $_POST['description'];

$sqlShipped = "SELECT * FROM shipped WHERE id = '$id'";
$queryShipped = $conn->query($sqlShipped);
$rowShipped = $queryShipped->fetch_assoc();

if($id_awal == $product_id){
    $sqlProduct = "SELECT * FROM product WHERE id = '$product_id'";
    $queryProduct = $conn->query($sqlProduct);
    $rowProduct = $queryProduct->fetch_assoc();    
    $stok = ($rowProduct['stok'] + $rowShipped['qty'] - $qty);

    if($rowProduct['stok'] >= $qty){
        $sql_update = "UPDATE shipped SET 
            date_out = '$dateOut', 
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
    }else{
        echo json_encode(
            array(
                'status' => false,
                'message' => 'Quantity Melebihi Stok Persediaan',
            )
        );
    }

}else{
    $sqlProduct = "SELECT * FROM product WHERE id = '$product_id'";
    $queryProduct = $conn->query($sqlProduct);
    $rowProduct = $queryProduct->fetch_assoc();    
    $stok = ($rowProduct['stok'] - $qty);

    $sqlProductAwal = "SELECT * FROM product WHERE id = '$id_awal'";
    $queryAwal = $conn->query($sqlProductAwal);
    $rowProductAwal = $queryAwal->fetch_assoc();    
    $stokAwal = ($rowProductAwal['stok'] + $qty_awal);

    if($rowProduct['stok'] >= $qty){
        $sql_update = "UPDATE shipped SET 
            date_out = '$dateOut', 
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
            $Update_productAwal = "UPDATE product SET stok = '$stokAwal'
                                WHERE id = '$id_awal'";
            $query_updateProd = $conn->query($Update_productAwal);
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

}


// mengatur tampilan json

header('Content-Type: application/json');