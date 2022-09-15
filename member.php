<!-- <?php
session_start();
if (!$_SESSION['email']) {
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: //$host$uri/login.php");
  exit;
}
?> -->

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員ページ</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-pages-org.css" />
</head>

<body>
  <header>
    <nav id="nav">
      <div class="inner">
        <a class="menu" id="menu"><span>MENU</span></a>
        <div class="panel">
          <ul>
            <li class="current-menu-item"><a href="index.php"><strong>トップページ</strong><span>Top</span></a></li>
            <li>
              <a href="book.html"><strong>本</strong><span>book</span></a>
              <ul class="sub-menu">
                <li><a href="sample.html">Vivliostyle</a></li>
                <li><a href="sample.html">サンプル</a></li>
              </ul>
            </li>
            <li><a href="dtp.php"><strong>組版</strong><span>typesetting</span></a></li>
            <li><a href="programming.php"><strong>プログラミング</strong><span>programming</span></a></li>
            <li><a href="photo.php"><strong>写真</strong><span>photography</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container">
    <div id="banner">
      <div class="slogan">
        <h2>kumihan.com</h2>
        <h3>ことばを残す</h3>
        <p>
          本当に残したい</br>
          『ことば』を</br>
          記録していきたいと</br>
          思っているみなさんへ</br>
          WEB標準の技術を使い</br>
          『本』を手本にパッケージング</br>
          その時々に必要な形で</br>
          しっかりと想いを伝える……</br>
        </p>
        <p>
          そんなお手伝ができればと</br>
          日々、考えております。
        </p>
      </div>
    </div>

    <main>
      <section class="overview">
        <h2 class="h2-title">book</h2>
        <h3>本にする</h3>
        <article class="overview-flex-box">
          <div class="figure"><img src="./assets/img/coffee-2151200_1920.jpeg" alt="" /></div>
          <p>ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社ではホームページサンプル株式会社では最新技術と自然との革新的な技術で世の中を調和を目指します。革新的な技術で世の中を動かす企業。動かす企業。</p>
        </article>
      </section>

      <section id= "contents" class="contents-area">
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
            <p class="readmore"><a href="./book.php">関連ページへ</a></p>
          </li>
          <li class="type-of-thing">
            <i class="fa-solid fa-scroll"></i>
            <h4>組版</h4>
            <p>エリザベス女王の国葬には、バイデン米大統領やドイツのシュタインマイヤー大統領らが参列する予定だ。政府内では「英国で弔問外交を展開する必要がある」（官邸筋）として、首相も訪英を検討すべきだとの意見も出ていた。</p>
            <p class="readmore"><a href="./typesetting.php">関連ページへ</a></p>
          </li>
          <li class="type-of-thing">
            <i class="fa-solid fa-laptop-code"></i>
            <h4>プログラミング</h4>
            <p>エリザベス女王の国葬には、バイデン米大統領やドイツのシュタインマイヤー大統領らが参列する予定だ。政府内では「英国で弔問外交を展開する必要がある」（官邸筋）として、首相も訪英を検討すべきだとの意見も出ていた。</p>
            <p class="readmore"><a href="./programming.php">関連ページへ</a></p>
            <li class="type-of-thing">
              <i class="fa-solid fa-camera-retro"></i>
              <h4>写真</h4>
              <p>エリザベス女王の国葬には、バイデン米大統領やドイツのシュタインマイヤー大統領らが参列する予定だ。政府内では「英国で弔問外交を展開する必要がある」（官邸筋）として、首相も訪英を検討すべきだとの意見も出ていた。</p>
              <p class="readmore"><a href="./photography.php">関連ページへ</a></p>
          </li>
          </li>
        </ul>
      </section>
    </main>

  </div>

  <aside></aside>

  <footer id="footer">
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