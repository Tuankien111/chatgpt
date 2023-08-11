<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'meowtech-chatmeow.mysql.database.azure.com';
    $username = 'dev';
    $password = 'S3cureP@ss!2023';
    $db_name = 'app';
    // Set your connection variables
    $conn = mysqli_init();
    mysqli_ssl_set($conn, NULL, NULL, "db/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
    mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL);
    if (mysqli_connect_errno()) {
        die('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    // Retrieve form data
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT * FROM 'users' WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Email exists in the database
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];

        // Generate a new password
        $new_password = generateRandomPassword();

        // Update the password in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE 'users' SET password = '$hashed_password' WHERE id = '$user_id'";
        mysqli_query($conn, $update_query);

        // Prepare the response data
        $response = array(
            'status' => 'success',
            'new_password' => $new_password
        );
    } else {
        // Email not found in the database
        $response = array(
            'status' => 'error',
            'message' => 'Email not found'
        );
    }

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Close the database connection
    $conn->close();
}

// Function to generate a random password
function generateRandomPassword() {
    // Define characters to use in the random password
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = 10;

    $random_password = '';
    for ($i = 0; $i < $length; $i++) {
        $random_password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $random_password;
}
?>
