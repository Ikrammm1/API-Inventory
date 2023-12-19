<?php

	include './conn.php';

        //ambil data yang dikirim dari android
		$email = $_POST['email'];
		$password = $_POST['password'];
        
		$sql = "SELECT 
                users.id,
                users.name,
                users.email,
                users.password,
                users.address,
                users.role,
                users.phone_number,
                role.id as role_id,
                role.name as role_name
            FROM users 
            INNER JOIN role on users.role = role.id 
            WHERE users.role = role.id
            AND users.status = 'aktif'
            AND email = '$email'";
		$query = $conn->query($sql);
       
		if($query->num_rows < 1){
            echo json_encode(
                array(
                    'response' => false,
                    'message' => 'Cannot find User',
                    'payload' => null
                )
            );
		}
		else{
			$row = $query->fetch_assoc();

			if(password_verify($password, $row['password'])){
                    echo json_encode(
                        array(
                            'response' => true,
                            'message' => 'Success',
                            'payload' => array(
                                "id" => $row["id"],
                                "name" => $row["name"],
                                "email" => $row["email"],
                                "password" => $row["password"],
                                "address" => $row["address"],
                                "role" => $row["role_name"],
                                "phone_number" => $row["phone_number"],    
                            )
                        )
                    );
			}
			else{
                echo json_encode(
                    array(
                        'response' => false,
                        'message' => 'Incorrect password',
                        'payload' => null
                    )
                );
			}
		}

// mengatur tampilan json

header('Content-Type: application/json')

?>