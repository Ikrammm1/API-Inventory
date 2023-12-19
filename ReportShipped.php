<?php 
require_once('conn.php');
require_once('SimpleXLSXGen.php');
$dateStart = $_GET['dateStart'];
$dateEnd = $_GET['dateEnd'];

$query = mysqli_query($conn, "SELECT
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
AND shipped.date_out BETWEEN '$dateStart' AND '$dateEnd'
ORDER BY shipped.date_out DESC");

$rows = $query->fetch_all(MYSQLI_ASSOC);
$result = [];

foreach($rows as $row) {
    $data[] = $row;
    array_push($result, [
        "result" => [$row]
    ]);
}

// Inisialisasi array hasil
$resultArray = [];

// Membuat header array
$header = array_keys($result[0]['result'][0]);
$resultArray[] = $header;

// Menambahkan data ke dalam array hasil
foreach ($result as $item) {
    $resultArray[] = array_values($item['result'][0]);
}

$xlsx = Shuchkin\SimpleXLSXGen::fromArray($resultArray);
$xlsx->downloadAs('ReportBarangKeluar.xlsx');
exit();


?>