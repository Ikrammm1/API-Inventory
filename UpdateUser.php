<?php
include './conn.php';

//ambil data yang dikirim dari android
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$role = $_POST['role'];
$phone_number = $_POST['phone_number'];
if ($password == '') {
    $password = $password;
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
}

$sql_update = "UPDATE users SET 
    name = '$name', 
    email = '$email', 
    password = '$password' ,
    address = '$address' ,
    role = '$role',
    phone_number = '$phone_number'
WHERE id = '$id'";
$query_update = $conn->query($sql_update);
// var_dump($sql_input);
if ($query_update) {
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


// mengatur tampilan json

header('Content-Type: application/json');
