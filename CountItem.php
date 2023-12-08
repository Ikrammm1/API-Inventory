<?php

include './conn.php';

$sql = "SELECT
    COUNT(DISTINCT product.id) AS total_produk,
    COUNT(DISTINCT category.category_id) AS total_kategori,
    COUNT(DISTINCT supplier.id) AS total_supplier,
    COUNT(DISTINCT received.id) AS total_received,
    COUNT(DISTINCT shipped.id) AS total_shipped
FROM product
LEFT JOIN category ON product.id = category.category_id
LEFT JOIN supplier ON product.id = supplier.id
LEFT JOIN received ON product.id = received.id
LEFT JOIN shipped ON product.id = shipped.id";
$query = $conn->query($sql);

if ($query->num_rows < 1) {
    echo json_encode(
        array(
            'response' => false,
            'message' => 'Data Not Found',
            'payload' => null
        )
    );
} else {
    $result = [];
    while ($row = mysqli_fetch_array($query)) {
        echo json_encode(
            array(
                "total_produk" => $row["total_produk"],
                "total_kategori" => $row["total_kategori"],
                "total_supplier" => $row["total_supplier"],
                "total_received" => $row["total_received"],
                "total_shipped" => $row["total_shipped"]
            )
            ); 
    }
}

// mengatur tampilan json

header('Content-Type: application/json')
?>