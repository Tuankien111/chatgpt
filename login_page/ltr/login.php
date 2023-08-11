<!doctype html>
<html class="no-js" lang="">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ChatMeow | Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/embi-favicon.webp">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="font/flaticon.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mulish:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
    <section class="fxt-template-animation fxt-template-layout30">
        <!-- Star Animation Start Here -->
        <canvas id="canvas"></canvas>
        <!-- Star Animation End Here -->
        <div class="fxt-content">
            <div class="fxt-header">
                <a href="login.php" class="fxt-logo"><img src="img/chatmeow-logo.webp" alt="Logo" style="width: 242px; height: 54px "></a>
            </div>
            <div class="fxt-form">
                <p>Login into your account</p>
                <form method="POST" action="api/api_login.php">
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-2">
                            <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                            <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-3">
                            <div class="fxt-checkbox-area">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">Keep me logged in</label>
                                </div>
                                <a href="forgot-password.php" class="switcher-text">Forgot Password</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fxt-transformY-50 fxt-transition-delay-4">
                            <button type="submit" class="fxt-btn-fill">Log in</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="fxt-style-line">
                <div class="fxt-transformY-50 fxt-transition-delay-5">
                    <h3>Follow us</h3>
                </div>
            </div>
            <ul class="fxt-socials">
                <li class="fxt-facebook fxt-transformY-50 fxt-transition-delay-6">
                    <a href="https://www.facebook.com/meowtechvn" title="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                </li>
                <!--				<li class="fxt-twitter fxt-transformY-50 fxt-transition-delay-7">-->
                <!--					<a href="#" title="twitter"><i class="fab fa-twitter"></i></a>-->
                <!--				</li>-->
                <li class="fxt-google fxt-transformY-50 fxt-transition-delay-8">
                    <a href="https://g.page/r/CarwTJ5DitVnEAE" title="google" target="_blank"><i class="fab fa-google-plus-g"></i></a>
                </li>
                <li class="fxt-linkedin fxt-transformY-50 fxt-transition-delay-9">
                    <a href="https://www.linkedin.com/company/meowtech/" title="linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </li>
                <li class="fxt-instagram fxt-transformY-50 fxt-transition-delay-9">
                    <a href="https://www.instagram.com/meowtechvn/" title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                </li>
                <!--				<li class="fxt-pinterest fxt-transformY-50 fxt-transition-delay-9">-->
                <!--					<a href="#" title="pinterest"><i class="fab fa-pinterest-p"></i></a>-->
                <!--				</li>-->
            </ul>
            <div class="fxt-footer">
                <div class="fxt-transformY-50 fxt-transition-delay-9">
                    <p>Don't have an account?<a href="register.php" class="switcher-text2 inline-text">Register</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    <script src="js/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <!-- Star Animation js -->
    <script src="js/star-animation.js"></script>
    <!-- Validator js -->
    <script src="js/validator.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>

</html>
