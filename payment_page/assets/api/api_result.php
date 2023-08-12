<?php 

session_start();

$host = 'meowtech-chatmeow.mysql.database.azure.com';
$username = 'dev';
$password = 'S3cureP@ss!2023';
$db_name = 'app'; 
 // Set your connection variables
 $conn = mysqli_init();
//  mysqli_ssl_set($conn,NULL,NULL, "db/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
 mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306); //, MYSQLI_CLIENT_SSL
 if (mysqli_connect_errno()) {
     die('Failed to connect to MySQL: ' . mysqli_connect_error());
 }
  // Set character set and collation
     mysqli_set_charset($conn, 'utf8mb4');


    // $resultCode ="0";
    $exetraData = $_GET['extraData'];
    $account_type = $_SESSION['account_type'];
    $email = $_SESSION['email'];
    $pro_end = $_SESSION['end_date'];


// Check resultCode
    if(isset($_GET['resultCode']) && $_GET['resultCode'] == 0) {
        // Check account_type: free => up to pro
        if($account_type == "free") {
            // Nếu là người dùng free => kiểm tra gói nâng cấp 
            if ($exetraData == 1) {
                $update_query = "UPDATE `app`.`users` 
                SET
                `account_type` = 'pro', 
                `pro_start_date` = CURRENT_TIMESTAMP,
                `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 MONTH),
                `last_payment` = CURRENT_TIMESTAMP
                WHERE
                email = '$email'";
                mysqli_query($conn, $update_query);
                $account_type = 'pro';
                
            }

            if ($exetraData == 6) {
                $update_query = "UPDATE `app`.`users` 
                SET
                `account_type` = 'pro', 
                `pro_start_date` = CURRENT_TIMESTAMP,
                `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 6 MONTH),
                `last_payment` = CURRENT_TIMESTAMP
                WHERE
                email = '$email'";
                mysqli_query($conn, $update_query);
                $account_type = 'pro';

                
            }
        }
        
        // Check account_type: pro => update pro_start / pro_end
        else {
            $today = date('Y-m-d H:i:s');
            $checkproend = "SELECT `pro_end_date` 
                           FROM `users` 
                           WHERE email = '$email'";
            $result = $conn->query($checkproend);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $pro_end_date = $row['pro_end_date'];
                
                // Check pro_end: pro_end > today (end in the future) => pro_start = pro_end (old) / pro_end (new)
                if ($pro_end_date > $today) {
      
                    if ($exetraData == 1) {
                        $update_query = "UPDATE `app`.`users` 
                        SET
                        `pro_start_date` = '" . $pro_end_date . "',
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 1 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        
                        mysqli_query($conn, $update_query);
                        
                    }

                    if ($exetraData == 6) {
                        $update_query = "UPDATE `app`.`users` 
                        SET
                        `pro_start_date` = '" . $pro_end_date . "',
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 6 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        
                        mysqli_query($conn, $update_query);
                    }
                }
                // Check pro_end: pro_end <= today (ended) => pro_start = today / pro_end (new)
                elseif ($pro_end_date <= $today) {
                    if ($exetraData == 1) {
                        $update_query = "UPDATE `app`.`users` 
                        SET
                        `pro_start_date` = CURRENT_TIMESTAMP,
                        `pro_end_date` = DATE_ADD(pro_start_date, INTERVAL 1 MONTH),
                        `last_payment` = CURRENT_TIMESTAMP
                        WHERE
                        email = '$email'";
                        
                        mysqli_query($conn, $update_query);
                    }
        
                    if ($exetraData == 6) {
                        $update_query = "UPDATE `app`.`users` 
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
        header("Location: ../../thank.php");

    }   
else {
    echo "Transaction failed";
}

// Logic : 
// * Nếu tài khoản tạo mới :
// free -> pro / { pro_start_date = currenttime  / pro_end_date = pro_start_date + extraData(1 or 6) }

// * Nếu tài khoản pro hết hạn gia hạn (pro_end_date <= current_time) :
// pro / { pro_start_date = currenttime  / pro_end_date = pro_start_date + extraData(1 or 6) }
        
// * Nếu tài khoản pro vẫn còn hạn gia hạn (pro_end_date > current_time ) :
// pro / { pro_start_date(new) = pro_end_date(old)  / pro_end_date(new) = pro_start_date(new) + extraData(1 or 6) } 

// * 
?> 