<?php
	include './conn.php';

        //ambil data yang dikirim dari android
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$address = $_POST['address'];
		$role = $_POST['role'];
		$phone_number = $_POST['phone_number'];

		$sql = "SELECT * FROM users WHERE email = '$email'";
		$query = $conn->query($sql);
    
		if($query->num_rows < 1){
			$sql_input = "INSERT INTO users (
                name, 
                email,
                password, 
                address, 
                role,
                phone_number) 
            VALUES ('$name', 
                '$email', 
                '$password', 
                '$address',
                '$role', 
                '$phone_number')";
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

            
		}
		else{
			    echo json_encode(
                    array(
                        'status' => false,
                        'message' => 'Email is already exists',
                    )
                );
		}

// mengatur tampilan json

header('Content-Type: application/json')

?>