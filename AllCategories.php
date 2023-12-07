<?php

include './conn.php';

$sql = "SELECT * FROM category";
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
                "category_id" => $row["category_id"],
                "name" => $row["name"],
                "status" => $row["status"]
            )
        );
    }
    echo json_encode(array('Category' => $result));
}

// mengatur tampilan json

header('Content-Type: application/json')
?>