<?php

include './conn.php';

$sql = "SELECT product.id,
    product.name,
    product.category_id,
    product.supplier_id,
    product.stok,
    product.price,
    product.description,
    category.name as category,
    supplier.name as supplier,
    supplier.address as supplier_address,
    supplier.phone_number as supplier_phone,
    product.status as status
FROM product
INNER JOIN category on product.category_id = category.category_id
INNER JOIN supplier on product.supplier_id = supplier.id
WHERE product.category_id = category.category_id
AND product.supplier_id = supplier.id
order by product.status, product.id DESC";
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
        array_push(
            $result,
            array(
                "id" => $row["id"],
                "category_id" => $row["category_id"],
                "supplier_id" => $row["supplier_id"],
                "name" => $row["name"],
                "stok" => $row["stok"],
                "price" => $row["price"],
                "description" => $row["description"],
                "category" => $row["category"],
                "supplier" => $row["supplier"],
                "supplier_address" => $row["supplier_address"],
                "supplier_phone" => $row["supplier_phone"],
                "status" => $row["status"]
            )
        );
    }
    echo json_encode(array('Product' => $result));
}

// mengatur tampilan json

header('Content-Type: application/json')
?>