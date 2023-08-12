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


// Kiểm tra kết quả giao dịch $_GET['resultCode']
    if($resultCode == 0) {
        // Nếu giao dịch thành công => Kiểm tra account_type 
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
            // Nếu người dùng pro => Kiểm tra pro_end_date cũ 
            $today = new DateTime('today');
            $checkproend = "SELECT `pro_end_date` 
                           FROM `users` 
                           WHERE email = '$email'";
            $result = $conn->query($checkproend);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $proEndTimestamp = strtotime($row['pro_end_date']);
                $today = new DateTime('today');
                $proEndDateTime = new DateTime();
                $proEndDateTime->setTimestamp($proEndTimestamp);
            
                // Nếu pro_end > ngày hiện tại => pro_start = pro_end (cũ) /  pro_end (mới) = pro_start + extraData (1 or 6 tháng)
                if ($proEndDateTime > $today) {
                    // $updateSql = "UPDATE your_table SET pro_start = '" . $row['pro_end'] . "' WHERE ...";
                    if ($exetraData == 1) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = '" . $row['pro_end_date'] . "',
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 1 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        mysqli_query($conn, $update_query);
                    }
        
                    if ($exetraData == 6) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = '" . $row['pro_end_date'] . "',
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 6 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        mysqli_query($conn, $update_query);
                    }
                }
                // Nếu pro_end < ngày hiện tại => pro_start = $today / pro_end = pro_start + extraData (1 or 6 tháng) 
                elseif ($proEndDateTime < $today) {
                    if ($exetraData == 1) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = CURRENT_TIMESTAMP,
                        `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        mysqli_query($conn, $update_query);
                    }
        
                    if ($exetraData == 6) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = CURRENT_TIMESTAMP,
                        `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 6 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        mysqli_query($conn, $update_query);
                    }
                } 
                else {
                    if ($exetraData == 1) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = CURRENT_TIMESTAMP,
                        `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        mysqli_query($conn, $update_query);
                    }
        
                    if ($exetraData == 6) {
                        $update_query = "UPDATE `laravel`.`users` 
                        SET
                        `pro_start_date` = CURRENT_TIMESTAMP,
                        `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 6 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        mysqli_query($conn, $update_query);
                    }
                }
            } else {
                echo "No results found.";
            }
            
        }
}   
else {
    echo "Giao dịch thất bại";
}
?> 