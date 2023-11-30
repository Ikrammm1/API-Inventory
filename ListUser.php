<?php

include './conn.php';

$sql = "SELECT * FROM users";
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
                "email" => $row["email"],
                "address" => $row["address"],
                "role" => $row["role_name"],
                "phone_number" => $row["phone_number"]
            )
        );
    }
    echo json_encode(array('Users' => $result));
}

// mengatur tampilan json

header('Content-Type: application/json')
?>