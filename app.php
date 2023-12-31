<?php
session_start();

// Check if the user is not logged in or session has expired
if (!isset($_SESSION['username']) || (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 1800)) {
    // Destroy the current session
    session_destroy();

    // Redirect to the login page
    header("Location: login_page/ltr/api/api_login.php");
    exit();
}

// Update the last activity time
$_SESSION['last_activity'] = time();

// If the session variable is set, the user is authenticated
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$account_type = $_SESSION['account_type'];
$end_date = $_SESSION['end_date'];
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2EDYP4WHHD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-2EDYP4WHHD');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Meow</title>
    <meta name="description" content="Chat Meow.">
    <meta name="description" content="ChatMeow.">
    <meta name="description" content="chat meow.">
    <meta name="description" content="chatmeow.">
    <meta name="description" content="MEOWTECH.">
    <meta name="description" content="meowtechvn.">
    <meta name="theme-color" content="#1A85F8">
    <meta property="og:title" content="Chat Meow - MeowTech" />
    <link rel="apple-touch-icon" sizes="180x180" href="fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="fav/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="fav/favicon.png">
    <link rel="manifest" href="fav/site.webmanifest">
    <link rel="mask-icon" href="fav/favicon.png" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#1A85F8">
    <meta property="og:description" content="In the template, you can communicate with ten intelligent animals, each of which has been trained by AI to understand a specific subject." />
    <meta property="og:image" content="img/thumb.webp" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/foundation.min.css">
    <link rel="stylesheet" href="style/stars.css" />
    <link rel="stylesheet" href="style/highlight.min.css" />
    <link rel="stylesheet" href="style/highlight.dark.min.css" />
    <link rel="stylesheet" href="style/toastr.min.css" />
    <link href="style/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/app.css?v1-10" />
    <link itemprop="url" href="img/thumb.webp">
    <link itemprop="thumbnailUrl" href="img/thumb.webp">
</head>
<body >


<div class="title-bar" style="display:none">
  <div class="title-bar-right">
  <p>Hello: <?php echo $username . '   Account Type: ' . $account_type . '    End Date: ' . $end_date; ?></p>

    <ul class="horizontal menu mobile-menu-title-bar" style="display:none">
      <li class="menu-buttons" id="mobile-menu"><a href="#" onclick="mobileMenu()"><button class="menu-icon" type="button"></button> Menu</a></li>
    </ul>
    <ul class="horizontal mobile-menu-toogle menu float-left">
      <li class="menu-buttons" id="clear-chat"><a href="#" onclick="clearChat()"><img src="img/clear-chat.svg"> <span>Clear Chat</span></a></li>
      <li class="menu-buttons" id="clear-all-chats"><a href="#" onclick="clearChat('all')"><img src="img/icon-trash.svg"> <span>Clear All Chats</span></a></li>
      <li class="menu-buttons" id="download-chat"><a href="#" onclick="handleDownload()"><img src="img/icon-download.svg"> <span>Download Chat</span></a></li>

      <li class="menu-buttons" id="payment"><a href="http://localhost/chatGPT2/payment_page/payment.php" onclick="#"><img src="img/icon-download.svg"> <span>Nâng cấp</span></a></li>
    </ul>

    <ul class="horizontal mobile-menu-toogle menu float-right">
      <li class="menu-buttons" id="close-chat"><a href="#" onclick="closeChat()"><img src="img/icon-close.svg"> <span>Close chat</span></a></li>
      <li class="menu-buttons" id="logout"><a href="#" onclick="logOut()"><img src="img/icon-close.svg"> <span>Log out</span></a></li>
    </ul>
  </div>
</div>


<div id="loading"></div>

  <div id="chatModal" style="display:none;">

    <section class="chat-container">
            <div id="bg-star"><div id="stars"></div><div id="stars2"></div><div id="stars3"></div></div>
              <div class="container-flex">
                  <div id="chat-frame">
                    <div id="overflow-chat"></div><!--overflow-chat-->
                  </div><!--chat-frame-->
              <div class="chat-input" >
                <div class="input" >
                  <textarea style="background-color:#142129; border-color: #001018; font-color:#ffffff" name="chat" id="chat" placeholder="Type your message here" maxlength="1000"></textarea>
<!--                  <input type="text" id="uname" name="name" />-->
                </div>
                <button class="submit btn-send-chat" tabindex="0"><span>Send</span></button>
                <span class="character-typing"><b class='wait'>Wait,</b> <span></span>  <b class='is_typing'>is typing...</b></span>
              </div><!--chat-input-->
            </div><!--container-flex-->
    </section>

  </div><!--chatModal-->

<header>
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell"><a href="https://meowtech.vn/" target="_blank"><img src="img/logo.webp" alt="MeowTech logo" title="MeowTech logo" class="logo" style="width:222px; height:56px"></a></div>
    </div>
  </div>
</header>

<section class="bg-blue">
  <div id="bg-star"><div id="stars"></div><div id="stars2"></div><div id="stars3"></div></div>

  <div class="grid-container full margin-top-custom">
    <div class="grid-x">
      <div class="cell">
        <h1>Chọn chuyên gia tư vấn nào bạn nhể 🤣?</h1>
      </div>
    </div>
  </div>

  <div class="grid-container full">
    <div class="grid-x">

      <div class="cell">
        <div class="swiper swiperCharacters">
          <div class="swiper-wrapper" id="load-character">
              <div class="h-custom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="40" height="40">
                  <circle cx="50" cy="50" r="40" stroke="#05151D" stroke-width="8" fill="none" />
                  <circle cx="50" cy="50" r="40" stroke="#000000" stroke-width="8" fill="none" stroke-dasharray="250" stroke-dashoffset="0">
                    <animate attributeName="stroke-dashoffset" dur="2s" repeatCount="indefinite" from="0" to="250" />
                  </circle>
                </svg>
              </div>
          </div>
          <div class="swiper-scrollbar"></div>
          <div class="swiper-button-next swiper-button-next1"><img src="img/right.svg" alt="Right" title="Right"></div>
          <div class="swiper-button-prev swiper-button-prev1"><img src="img/left.svg" alt="Left" title="Left"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

    </div>
    <footer>
      <h3 style="font-color: #ffffff">MEOWTECH CO., LTD</h3>
    </footer>
  </div>

</section>

<section id="feedback"><span></span></section>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/swiper-bundle.min.js"></script>
<script src="js/vendor/foundation.min.js"></script>
<script src="js/highlight.min.js"></script>
<script src="js/toastr.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/app.js?v1-8"></script>
  </body>
</html>