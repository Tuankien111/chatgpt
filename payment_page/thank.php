<!-- Sau khi thanh toán xong trả về trang này -->
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Thank You</title>
  <style>
    body {
      background-color: #f8f9fa;
    }
    
    .jumbotron {
      background-color: #ffffff;
      margin-top: 50px;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="jumbotron text-center">
      <h1 class="display-3">Thank You!</h1>
      <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
      <hr class="my-4">
      <p>
          Please login again ! | endday : <?=$_SESSION['end_date']?>
      </p>
      <p class="lead">
        <a class="btn btn-primary btn-sm" href="http://localhost/chatGPT2/login_page/ltr/login.php" role="button">Continue to homepage</a>
      </p>
    </div>
  </div>
</body>
</html>