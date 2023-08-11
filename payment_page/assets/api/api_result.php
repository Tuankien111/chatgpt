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

// Kiểm tra kết quả giao dịch $_GET['resultCode]
if(isset($_GET['resultCode']) && $_GET['resultCode'] ==0) {
    $exetraData =  $_GET['extraData'];
    $email = $_SESSION['email'];

    // Kiểm tra Pro_end_date
    
    
    if ($exetraData == 1) {
       $update_query = "UPDATE `app`.`users` 
       SET
        `account_type` = 'pro', 
        `pro_start_date` = CURRENT_TIMESTAMP,
        `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 MONTH)
       WHERE
        email = '$email'";
       mysqli_query($conn, $update_query);
       $_SESSION['account_type'] = 'pro';
    }

    if ($exetraData == 6) {
        $update_query = "UPDATE `app`.`users` 
       SET
        `account_type` = 'pro', 
        `pro_start_date` = CURRENT_TIMESTAMP,
        `pro_end_date` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 6 MONTH)
       WHERE
        email = '$email'";
       mysqli_query($conn, $update_query);
       $_SESSION['account_type'] = 'pro';
    }
}   
else {
    echo "Giao dịch thất bại";
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