<?php
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
// Set character set and collation
mysqli_set_charset($conn, 'utf8mb4');


// Check if the user table exists, and create it if it doesn't
// $createTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
//     `id` INT AUTO_INCREMENT PRIMARY KEY,
//     `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
//     `email` VARCHAR(255) NOT NULL,
//     `password` VARCHAR(255) NOT NULL,
//     `account_type` VARCHAR(255) NOT NULL DEFAULT 'free',
//     `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
//     `free_trial_start_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     `free_trial_end_date` TIMESTAMP NULL,
//     `pro_start_date` TIMESTAMP NULL,
//     `pro_end_date` TIMESTAMP NULL,
//     `last_payment` TIMESTAMP NULL,
//     `created_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )";
// if ($conn->query($createTableQuery) !== TRUE) {
//     die("Table creation failed: " . $conn->error);
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = $conn->query($checkEmailQuery);
    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Email already exists.');</script>";
        echo "<script>setTimeout(function() { window.location.href = '../register.php'; }, 1000);</script>";
        exit();
    }
     else {
        // Set default values for new user
        $is_active = TRUE;
        $free_trial_start_date = date('Y-m-d H:i:s');

        // Set timezone to GMT+7
        date_default_timezone_set('Asia/Bangkok');

        // Calculate the free trial end date (7 days from the start date)
        $free_trial_end_date = date('Y-m-d H:i:s', strtotime($free_trial_start_date . ' +7 days'));

        // Reset the timezone back to the default timezone if needed
        // date_default_timezone_set('Your Default Timezone');


        $pro_start_date = NULL;
        $pro_end_date = NULL;
        $last_payment = NULL;

        // Insert the new user into the database
        $insertUserQuery = "INSERT INTO `users` (`name`, `email`, `password`, `is_active`, `free_trial_start_date`, `free_trial_end_date`, `pro_start_date`, `pro_end_date`, `last_payment`)
                            VALUES ('$name', '$email', '$hashedPassword', '$is_active', '$free_trial_start_date', '$free_trial_end_date', NULL, NULL, NULL)";
        if ($conn->query($insertUserQuery) === TRUE) {
             echo "<script>alert('User registered successfully.');</script>";
             echo "<script>setTimeout(function() { window.location.href = '../login.php'; }, 1000);</script>";
                        exit();
        } else {
            echo "Error: " . $insertUserQuery . "<br>" . $conn->error;
        }
        // Redirect to api_login.php
                header("Location: ../login.php");
                exit();
    }
}

// Close the database connection
$conn->close();
?>
