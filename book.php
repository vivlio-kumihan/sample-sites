<?php
session_start();
if (!$_SESSION['email']) {
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: //$host$uri/login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>本</title>

  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/modaal.min.css" />
  <link rel="stylesheet" href="./assets/css/jquery.bxslider.min.css">
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-pages-org.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-borad.css" />

  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="./assets/js/modaal.min.js" defer></script>
  <script src="./assets/js/jquery.bxslider.min.js" defer></script>
  <script src="./assets/js/behavior.js" defer></script>
</head>

<body>
  <header>
    <div class="hp-only">
      <div class="hamburger-menu-container">
        <h1 class="logo">
          <img src="./assets/img/logo_white.png" alt="logo">
          <span>kumihan.com</span>
        </h1>
        <div class="hamburger-menu">
          <input type="checkbox" id="menu-btn-check">
          <label for="menu-btn-check" class="menu-btn"><span></span></label>
          <label for="menu-btn-check" id="nav-black"></label>
          <div class="menu-content">
            <ul>
              <!-- <li><a href="./index.php">ホーム</a></li> -->
              <li><a href="https://barba.rossa.cc/">ホーム</a></li>
              <li><a href="./book.html">本</a></li>
              <!-- <li><a href="https://barba.rossa.cc/book/">本</a></li> -->
              <!-- <li><a href="./typesetting.php">組版</a></li> -->
              <li><a href="https://barba.rossa.cc/typesetting/">組版</a></li>
              <!-- <li><a href="./programming.php">プログラミング</a></li> -->
              <li><a href="https://barba.rossa.cc/programming/">プログラミング</a></li>
              <li><a href="./photo.php">写真</a></li>
              <li><a class="sub-menu" href="./member.php">メンバーページ</a>
                <ul class="sub-menu">
                  <li><a href="./register.php">sign up</a></li>
                  <li><a href="./login.php">log in</a></li>
                  <li><a href="./contact.php">contact</a></li>
                  <li><a href="./board.php">bbs</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="pc-only">
      <div class="menu-bar">
        <h1 class="logo">
          <img src="./assets/img/logo_white.png" alt="logo">
          <span>kumihan.com</span>
        </h1>
        <ul class="menu-bar-lists">
          <!-- <li class="menu-bar-item"><a href="./index.php">ホーム</a></li> -->
          <li class="menu-bar-item"><a href="https://barba.rossa.cc/">ホーム</a></li>
          <li class="menu-bar-item"><a href="./book.php">本</a></li>
          <!-- <li class="menu-bar-item"><a href="https://barba.rossa.cc/book/">本</a></li> -->
          <!-- <li class="menu-bar-item"><a href="./typesetting.php">組版</a></li> -->
          <li class="menu-bar-item"><a href="https://barba.rossa.cc/typesetting/">組版</a></li>
          <!-- <li class="menu-bar-item"><a href="./programming.php">プログラミング</a></li> -->
          <li class="menu-bar-item"><a href="https://barba.rossa.cc/programming/">プログラミング</a></li>
          <li class="menu-bar-item"><a href="./photo.php">写真</a></li>
          <li class="menu-bar-item"><a href="./member.php">メンバーページ</a>
            <ul class="sub-menu">
              <li class="menu-bar-item"><a href="./register.php">sign up</a></li>
              <li class="menu-bar-item"><a href="./login.php">log in</a></li>
              <li class="menu-bar-item"><a href="./contact.php">contact</a></li>
              <li class="menu-bar-item"><a href="./board.php">bbs</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <body>
    <div id="container">
      <h1>book page</h1>
      <main>
        <section class="overview">
          <h2 class="h2-title">book</h2>
          <h3>本にする</h3>
          <article class="overview-flex-box">
            <div class="figure"><img src="./assets/img/coffee-2151200_1920.jpeg" alt="" /></div>
            <p>ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社ではホームページサンプル株式会社では最新技術と自然との革新的な技術で世の中を調和を目指します。革新的な技術で世の中を動かす企業。動かす企業。</p>
          </article>
        </section>

        <section id="contents" class="contents-area">
          <div class="contents-header">
            <h2 class="h2-title">contents</h2>
            <h3>目次</h3>
            <p>すべてのプランに標準でご利用いただけるサービスです。<br class="pc-only">
              その他にも会議に必要な備品など数多く取り揃えておりますので申し込み時にお問い合わせください。</p>
          </div>
          <ul class="cando">
            <li class="type-of-thing">
              <i class="fa-solid fa-book"></i>
              <h4>本</h4>
              <p>エリザベス女王の国葬には、バイデン米大統領やドイツのシュタインマイヤー大統領らが参列する予定だ。政府内では「英国で弔問外交を展開する必要がある」（官邸筋）として、首相も訪英を検討すべきだとの意見も出ていた。</p>
              <p class="readmore"><a href="https://common.thyme.jp/book.php">関連ページへ</a></p>
            </li>
            <li class="type-of-thing">
              <i class="fa-solid fa-scroll"></i>
              <h4>組版</h4>
              <p>エリザベス女王の国葬には、バイデン米大統領やドイツのシュタインマイヤー大統領らが参列する予定だ。政府内では「英国で弔問外交を展開する必要がある」（官邸筋）として、首相も訪英を検討すべきだとの意見も出ていた。</p>
              <p class="readmore"><a href="https://barba.rossa.cc/typesetting/">関連ページへ</a></p>
            </li>
            <li class="type-of-thing">
              <i class="fa-solid fa-laptop-code"></i>
              <h4>プログラミング</h4>
              <p>エリザベス女王の国葬には、バイデン米大統領やドイツのシュタインマイヤー大統領らが参列する予定だ。政府内では「英国で弔問外交を展開する必要がある」（官邸筋）として、首相も訪英を検討すべきだとの意見も出ていた。</p>
              <p class="readmore"><a href="https://barba.rossa.cc/programming/">関連ページへ</a></p>
            <li class="type-of-thing">
              <i class="fa-solid fa-camera-retro"></i>
              <h4>写真</h4>
              <p>エリザベス女王の国葬には、バイデン米大統領やドイツのシュタインマイヤー大統領らが参列する予定だ。政府内では「英国で弔問外交を展開する必要がある」（官邸筋）として、首相も訪英を検討すべきだとの意見も出ていた。</p>
              <p class="readmore"><a href="https://common.thyme.jp/photo.php">関連ページへ</a></p>
            </li>
            </li>
          </ul>
          <div class="to_Viliostyle">
            <a href="./viewer/#src=../book.html">Vivliostyleで閲覧</a>
          </div>
        </section>
      </main>
    </div>
  </body>

  <footer id="footer-container">
    <ul class="footer-icons">
      <li><a href="https://twitter.com/vivlioKumihan"><i class="fa-brands fa-square-twitter"></i></a></li>
      <li><a href="https://github.com/vivlio-kumihan"><i class="fa-brands fa-square-github"></i></a></li>
      <li><a href="https://facebook.com/vivlioKumihan"><i class="fa-brands fa-square-facebook"></i></a></li>
      <li><a href="#"><i class="fa-brands fa-slack"></i></a></li>
    </ul>
    <ul class="footer-copyright">
      <li>&copy; kumihan.com</li>
      <li>Design: <a href="https://kumihan.com">Nobuyuki Takahiro</a></li>
    </ul>
  </footer>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>