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
  <title>会員ページ</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-pages-org.css" />
</head>

<body>
  <!-- donner -->
<header id="header" role="banner">
<h1>ホームページサンプル株式会社のサイトです</h1>
<div class="logo">
  <a href="index.html" title="ホームページサンプル株式会社" rel="home">Company Name<span>Your Company Slogan</span></a>
</div>
<div class="info">
  <p class="tel"><span>電話:</span> 012-3456-7890</p>
  <p class="open">受付時間: 平日 AM 10:00 〜 PM 5:00</p>
</div>
</header>

<nav id="mainNav">
<div class="inner">
  <a class="menu" id="menu"><span>MENU</span></a>
  <div class="panel">
    <ul>
      <li class="current-menu-item"><a href="index.html"><strong>トップページ</strong><span>Top</span></a></li>
      <li>
        <a href="sample.html"><strong>ごあいさつ</strong><span>Greeting</span></a>
        <ul class="sub-menu">
          <li><a href="sample.html">代表メッセージ</a></li>
          <li><a href="sample.html">社員の声</a></li>
        </ul>
      </li>
      <li><a href="sample.html"><strong>サービス概要</strong><span>Service</span></a></li>
      <li><a href="sample.html"><strong>弊社の取り組み</strong><span>Approach</span></a></li>
      <li><a href="sample.html"><strong>会社概要</strong><span>Company</span></a></li>
      <li><a href="sample.html"><strong>お問い合わせ</strong><span>Contact</span></a></li>
    </ul>
  </div>
</div>
</nav>

<div id="wrapper">
<div id="mainBanner">
  <img src="./assets/img/mainImg.jpg" alt="ホームページサンプル株式会社のサイトです">
  <div class="slogan">
    <h2>SAMPLE COFFEE SHOP</h2>
    <p>Your Company Slogan</p>
  </div>
</div>

<section class="content">
  <h3 class="heading">ホームページ株式会社フロントページ表示サンプル</h3>
  <article class="post">
    <p><img src="./assets/img/sample.jpg" alt="" width="260" height="113" class="alignright" />ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社ではホームページサンプル株式会社では最新技術と自然との革新的な技術で世の中を調和を目指します。革新的な技術で世の中を動かす企業。動かす企業。</p>
    <p>ホームページサンプル株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業を目指します。ホームページサンプル株式会社では最新技術と自然との調和を目指します。株式会社では最新技術と自然との調和を目指します。革新的な技術で世の中を動かす企業。ホームページサンプル株式会社では最新技術と自然との革新的な技術で世の中を調和を目指します。革新的な技術で世の中を動かす企業。動かす企業。</p>
  </article>
</section>

<section class="gridWrapper">
  <article class="grid">
    <div class="box">
      <img width="320" height="320" src="./assets/img/eyecatch1.jpg" alt="" />
      <h3>サンプル株式会社の取り組み</h3>
      <p>ホームページサンプル株式会社の取り組み ホームページサンプル株式会社では最新技術と自然との調和を目指します。革 &#8230;</p>
      <p class="readmore"><a href="sample.html">詳細を確認する</a></p>
    </div>
  </article>
  <article class="grid">
    <div class="box">
      <img width="320" height="320" src="./assets/img/eyecatch2.jpg" alt="" />
      <h3>自然との調和を目指す企業</h3>
      <p>ホームページサンプル株式会社の取り組み ホームページサンプル株式会社では最新技術と自然との調和を目指します。革 &#8230;</p>
      <p class="readmore"><a href="sample.html">詳細を確認する</a></p>
    </div>
  </article>
  <article class="grid">
    <div class="box">
      <img width="320" height="320" src="./assets/img/eyecatch3.jpg" alt="" />
      <h3>ホームページ株式会社の取り組み</h3>
      <p>ホームページサンプル株式会社の取り組み ホームページサンプル株式会社では最新技術と自然との調和を目指します。革 &#8230;</p>
      <p class="readmore"><a href="sample.html">詳細を確認する</a></p>
    </div>
  </article>
</section>

<footer id="footer">
  <div class="inner">
    <div id="info" class="grid">
      <div class="logo">
        <a href="index.html" title="ホームページサンプル株式会社" rel="home">Company Name<span>Your Company Slogan</span></a>
      </div>
      <div class="info">
        <p class="tel"><span>電話:</span> 012-3456-7890</p>
        <p class="open">受付時間: 平日 AM 10:00 〜 PM 5:00</p>
      </div>
    </div>
    <div class="menu">
      <ul class="footnav">
        <li><a href="sample.html">ホームページ株式会社</a></li>
        <li><a href="sample.html">株式会社</a></li>
        <li><a href="sample.html">利用規約</a></li>
        <li><a href="sample.html">弊社の取り組み</a></li>
        <li><a href="sample.html">お問い合わせ</a></li>
      </ul>
    </div>
  </div>
</footer>

<p id="copyright">Copyright(c) 2016 ホームページサンプル株式会社 All Rights Reserved. Design by <a href="http://f-tpl.com" target="_blank" rel="nofollow">http://f-tpl.com</a></p><!-- ←クレジット表記を外す場合はシリアルキーが必要です http://f-tpl.com/credit/ -->
  <!-- donner ここまで -->



  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>