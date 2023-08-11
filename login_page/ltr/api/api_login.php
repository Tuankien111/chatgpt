<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $host = 'meowtech-chatmeow.mysql.database.azure.com';
        // $username = 'chatmeowadmin';
        // $password = 'Meowtech@2023';
        // $db_name = 'app';

        $host = 'meowtech-chatmeow.mysql.database.azure.com';
        $username = 'dev';
        $password = 'S3cureP@ss!2023';
        $db_name = 'app';

        // Set your connection variables
        $conn = mysqli_init();
        mysqli_ssl_set($conn,NULL,NULL, "db/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
        mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL);
        if (mysqli_connect_errno()) {
            die('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
         // Set character set and collation
            mysqli_set_charset($conn, 'utf8mb4');

        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email exists in the database
        $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($checkEmailQuery);
        if ($result->num_rows === 0) {
            // Email does not exist
            echo "<script>alert('Email does not exist.');</script>";
            echo "<script>setTimeout(function() { window.location.href = '../login.php'; }, 1000);</script>";
            exit();
        } else {
            // Fetch the user data
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            // Check if the password is correct
            if (password_verify($password, $hashedPassword)) {
                // Password is correct

                // Check if the account is active
                $is_active = $user['is_active'];
                if (!$is_active) {
                    // Account is inactive
                    echo "Account is inactive.";
                } else {
                    // Account is active

                    // Get the account type
                    $account_type = $user['account_type'];

                    if ($account_type === 'free') {
                        $free_trial_end_date = $user['free_trial_end_date'];

                        // Check if the free trial has expired
                        $current_time = date('Y-m-d H:i:s');
                        if ($current_time > $free_trial_end_date) {
                            // Free trial has expired
                            echo "Your free trial has expired. Please upgrade to a pro user package.";
                        } else {
                            // Free trial is still active
                            $name = $user['name'];
                            $_SESSION['username'] = $name; // Set session variable
                            $_SESSION['email'] = $email; // Set session variable
                            $_SESSION['account_type'] = $account_type; // Set session variable
                            $_SESSION['end_date'] = $free_trial_end_date; // Set session variable

                            // Redirect to app.php
                            header("Location: ../../../app.php");
                            exit();
                        }
                    } elseif ($account_type === 'pro') {
                        $pro_end_date = $user['pro_end_date'];

                        // Check if the pro package has expired
                        $current_time = date('Y-m-d H:i:s');
                        if ($current_time > $pro_end_date) {
                            // Pro package has expired
                            echo "Your pro package has expired. Please upgrade to extend your subscription.";
                        } else {
                            // Pro package is still active
                            $name = $user['name'];
                            $_SESSION['username'] = $name; // Set session variable
                            $_SESSION['email'] = $email; // Set session variable
                            $_SESSION['account_type'] = $account_type; // Set session variable
                            $_SESSION['end_date'] = $pro_end_date; // Set session variable

                            // Redirect to app.php
                            header("Location: ../../../app.php");
                            exit();
                        }
                    }
                }
            } else {
                // Password is incorrect
                 echo "<script>alert('Incorrect password.');</script>";
                echo "<script>setTimeout(function() { window.location.href = '../login.php'; }, 500);</script>";
                 exit();
            }
        }
        mysqli_close($conn);
    }
?>
