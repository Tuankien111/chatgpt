<?php 
    session_start();
    $name = "Noname";
    $email = "";
    if(isset($_SESSION['username'])) {
        $name = $_SESSION['username'];
        $email =$_SESSION['email'];
    }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Payment</title>

    <!-- Favicon  -->
    <link rel="icon" href="assets/img/favicon.png">

    <!-- ***** All CSS Files ***** -->

    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="homepage-2">
<!--====== Scroll To Top Area Start ======-->
<div id="scrollUp" title="Scroll To Top">
    <i class="fas fa-arrow-up"></i>
</div>
<!--====== Scroll To Top Area End ======-->

<div class="main" >

    <!-- ***** Header Start ***** -->
    <header class="navbar navbar-sticky navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img class="navbar-brand-regular" src="./assets/img/logo/logo.png" style="width: 52px; height: 52px" alt="brand-logo">
            <img class="navbar-brand-sticky" src="./assets/img/logo/logo.png" style="width: 52px; height: 52px" alt="sticky brand-logo">
        </a>

    </header>
    <!-- ***** Header End ***** -->


    <!-- ***** Price Plan Area Start ***** -->
    <section id="pricing" class="section price-plan-area bg-gray overflow-hidden ptb_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <!-- Section Heading -->
                    <div class="section-heading text-center">
                        <h3>Mở khoá Tính năng tuyệt vời - Chi phí cực hời</h3>
                        <p class="d-none d-sm-block mt-4">Chào bạn: <?= $name ?> <br> Quét mã QR MOMO để thanh toán</p>
                        <p class="d-block d-sm-none mt-4">Chào bạn: Full name <br> Quét mã QR MOMO để thanh toán</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                <!-- Pricing Table: Pro -->
                <div class="col-12 col-md-4 mt-4 mt-md-0">
                    <div class="single-price-plan text-center p-5 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.4s">
                        <!-- Plan Thumb -->
                        <div class="plan-thumb">
                            <img class="avatar-lg" src="./assets/img/pricing/premium.png" alt="">
                        </div>
                        <!-- Plan Title -->
                        <div class="plan-title my-2 my-sm-3">
                            <h4 class="text-uppercase">Pro</h4>
                        </div>
                        <!-- Plan Price -->
                        <div class="plan-price pb-2 pb-sm-3">
                            <h2 class="fw-7">36,000<small class="fw-6">đ</small></h2>
                        </div>
                        <!-- Plan Description -->
                        <div class="plan-description">
                            <ul class="plan-features">
                                <li class="border-top py-3">Hiệu lực 1 tháng</li>
                                <li class="border-top py-3">Chat GPT 4 Plus</li>
                                <li class="border-top py-3">Nhanh hơn 100 lần </li>
                                <li class="border-top border-bottom py-3">Luôn ổn định</li>
                            </ul>
                        </div>
                        <!-- Plan Button -->
                        <!-- <div class="plan-button">
                            <a href="#" class="btn mt-4" style="color: #FFFFFF">Nâng Cấp</a>
                        </div> -->

                        <form class="plan-button" action="assets/api/api_momo.php" method="post" target="_blank" enctype="application/x-www-form-urlencoded">
                            <input type = "hidden" name = "price" value = "36000" >
                            <input type = "hidden" name = "key" value = "1" >
                            <input class="btn mt-4" style="color: #FFFFFF" name="payUrl" type="submit" value="Nâng cấp">
                        </form>
                    </div>
                </div>

                <!-- Pricing Table: Pro 1-year -->
                <div class="col-12 col-md-4 mt-4 mt-md-0">
                    <div class="single-price-plan text-center p-5 wow fadeInRight" data-aos-duration="2s" data-wow-delay="0.4s">
                        <!-- Plan Thumb -->
                        <div class="plan-thumb">
                            <img class="avatar-lg" src="./assets/img/pricing/premium.png" alt="">
                        </div>
                        <!-- Plan Title -->
                        <div class="plan-title my-2 my-sm-3">
                            <h4 class="text-uppercase">Pro 6-month</h4>
                        </div>
                        <!-- Plan Price -->
                        <div class="plan-price pb-2 pb-sm-3">
                            <h2 class="fw-7">216,000<small class="fw-6">đ</small></h2>
                        </div>
                        <!-- Plan Description -->
                        <div class="plan-description">
                            <ul class="plan-features">
                                <li class="border-top py-3">Hiệu lực 6 tháng</li>
                                <li class="border-top py-3">Chat GPT 4 Plus</li>
                                <li class="border-top py-3">Nhanh hơn 100 lần </li>
                                <li class="border-top border-bottom py-3">Luôn ổn định</li>
                            </ul>
                        </div>
                        <!-- Plan Button -->
                        <!-- <div class="plan-button">
                            <a href="#" class="btn mt-4" style="color: #FFFFFF">Nâng Cấp</a>
                        </div> -->
                        <form class="plan-button" action="assets/api/api_momo.php" method="post" target="_blank" enctype="application/x-www-form-urlencoded">
                            <input type = "hidden" name = "price" value = "216000" >
                            <input type = "hidden" name = "key" value = "6" >
                            <input class="btn mt-4" style="color: #FFFFFF" name="payUrl" type="submit" value="Nâng cấp">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center pt-5">
                <div class="col-12 col-md-10 col-lg-8 text-center">
                    <p class="pt-4 fw-5" style="color: #D9DDE1">Bạn cần được hỗ trợ? <a href="https://www.facebook.com/meowtechvn" target="_blank" style="color: #D9DDE1; text-decoration: underline;">Liên hệ chúng tôi</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Price Plan Area End ***** -->

</div>


<!-- ***** All jQuery Plugins ***** -->

<!-- jQuery(necessary for all JavaScript plugins) -->
<script src="../assets/js/jquery/jquery.min.js"></script>

<!-- Bootstrap js -->
<script src="../assets/js/bootstrap/popper.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.min.js"></script>

<!-- Plugins js -->
<script src="../assets/js/plugins/plugins.min.js"></script>

<!-- Active js -->
<script src="../assets/js/active.js"></script>
<!-- Star Animation js -->
<script src="../assets/js/star-animation.js"></script>
</body>

</html>
<!--collapse-->