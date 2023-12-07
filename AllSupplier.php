<?php

include './conn.php';

$sql = "SELECT * FROM supplier ";
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
                "name" => $row["name"],
                "address" => $row["address"],
                "phone_number" => $row["phone_number"],
                "status" => $row["status"]

            )
        );
    }
    echo json_encode(array('Supplier' => $result));
}

// mengatur tampilan json

header('Content-Type: application/json')
?>