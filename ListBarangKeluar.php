<?php

include './conn.php';

$sql = "SELECT
    shipped.id,
    shipped.date_out,
    shipped.qty,
    shipped.description,
    product.id as product_id,
    product.name as product,
    product.stok,
    product.price,
    product.category_id,
    category.name as category,
    product.supplier_id,
    supplier.name as supplier,
    supplier.address as supplier_address,
    supplier.phone_number as supplier_phone,
    users.name as admin
FROM product
INNER JOIN shipped on shipped.product_id = product.id
INNER JOIN category on product.category_id = category.category_id
INNER JOIN supplier on product.supplier_id = supplier.id
INNER JOIN users on users.id = shipped.admin
WHERE product.category_id = category.category_id
AND product.supplier_id = supplier.id
AND product.id = shipped.product_id
AND users.id = shipped.admin
ORDER BY shipped.date_out DESC
";
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
                "date_out" => $row["date_out"],
                "qty" => $row["qty"],
                "description" => $row["description"],
                "product_id" => $row["product_id"],
                "product" => $row["product"],
                "stok" => $row["stok"],
                "price" => $row["price"],
                "category_id" => $row["category_id"],
                "category" => $row["category"],
                "supplier_id" => $row["supplier_id"],
                "supplier" => $row["supplier"],
                "supplier_address" => $row["supplier_address"],
                "supplier_phone" => $row["supplier_phone"],
                "admin" => $row["admin"]
            )
        );
    }
    echo json_encode(array('Shipped' => $result));
}

// mengatur tampilan json

header('Content-Type: application/json')
?>