<?php 
// Kết nối data
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'laravel';

// Set your connection variables
$conn = mysqli_init();
 mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306); //, MYSQLI_CLIENT_SSL
 if (mysqli_connect_errno()) {
     die('Failed to connect to MySQL: ' . mysqli_connect_error());
 }
  // Set character set and collation
     mysqli_set_charset($conn, 'utf8mb4');
    $resultCode ="0";
    $exetraData ="1";
    $account_type ="PRO";
    $email = "tuankien@gmail.com";



    if($resultCode == 0) {

        if($account_type == "FREE") {
            // Nếu là người dùng free => kiểm tra gói nâng cấp 
            if ($exetraData == 1) {
                $update_query = "UPDATE `laravel`.`users` 
                SET
                `account_type` = 'PRO', 
                `pro_start_date` = CURRENT_TIMESTAMP,
                `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 MONTH),
                `last_payment` = CURRENT_TIMESTAMP
                WHERE
                email = '$email'";
                mysqli_query($conn, $update_query);
                $account_type = 'PRO';
            }

            if ($exetraData == 6) {
                $update_query = "UPDATE `laravel`.`users` 
                SET
                `account_type` = 'PRO', 
                `pro_start_date` = CURRENT_TIMESTAMP,
                `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 6 MONTH),
                `last_payment` = CURRENT_TIMESTAMP
                WHERE
                email = '$email'";
                mysqli_query($conn, $update_query);
                $account_type = 'PRO';
            }
        }
        
        else {
            $today = date('Y-m-d H:i:s');
            $checkproend = "SELECT `pro_end_date` 
                           FROM `users` 
                           WHERE email = '$email'";
            $result = $conn->query($checkproend);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $pro_end_date = $row['pro_end_date'];
                echo $pro_end_date;
            
                if ($pro_end_date > $today) {
      
                    if ($exetraData == 1) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = '" . $pro_end_date . "',
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 1 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        
                        mysqli_query($conn, $update_query);
                    }

                    if ($exetraData == 6) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = '" . $pro_end_date . "',
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 6 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        
                        mysqli_query($conn, $update_query);
                    }
                }
                // Nếu pro_end < ngày hiện tại => pro_start = $today / pro_end = pro_start + extraData (1 or 6 tháng) 
                elseif ($pro_end_date <= $today) {
                    if ($exetraData == 1) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = CURRENT_TIMESTAMP,
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 1 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        
                        mysqli_query($conn, $update_query);
                    }
        
                    if ($exetraData == 6) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = CURRENT_TIMESTAMP,
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 6 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        
                        mysqli_query($conn, $update_query);
                    }
                } 
                else {
                    echo "\n\n end today";
                }
            } else {
                echo "No results found.";
            }
            
        
        
        }
}   
else {
    echo "Transaction failed";
}
?> 