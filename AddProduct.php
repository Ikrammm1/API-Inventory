<?php
	include './conn.php';

        //ambil data yang dikirim dari android
		$category_id = $_POST['category_id'];
		$supplier_id = $_POST['supplier_id'];
		$name = $_POST['name'];
		$stok = $_POST['stok'];
		$price = $_POST['price'];
		$description = $_POST['description'];
    
			$sql_input = "INSERT INTO product (
                category_id, 
                supplier_id,
                name, 
                stok, 
                price,
                description) 
            VALUES ('$category_id', 
                '$supplier_id', 
                '$name', 
                '$stok',
                '$price', 
                '$description')";
            $query_input = $conn->query($sql_input);
            // var_dump($sql_input);
            if ($query_input) {
               echo json_encode(
                    array(
                        'status' => true,
                        'message' => 'Success',
                    )
                );
            }else{
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