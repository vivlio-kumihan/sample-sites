<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="discription" content="MdNコーポレーションの書籍「初心者からちゃんとしたプロになる Webデザイン基礎入門」の紹介をするホームページです。">
  <title>Utilities</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
  <link rel="stylesheet" href="./assets/css/accordion_menu.css" />

</head>

<body class="home">
  <div class="container">
    <header>
      <!-- チェックボックスの実装。これは隠す。 -->
      <!-- 3本線のハンバーガーメニューボタンの元になるspanを敷設する。 -->
      <!-- 『id』『for』の関係で繋がっている。
            spanの3本線をクリックしたらチェックが入る
            仕組みをここで敷設する。 -->
      <div class="hamburger-menu">
        <input type="checkbox" id="menu-btn-check">
        <label for="menu-btn-check" class="menu-btn"><span></span></label>
        <label for="menu-btn-check" id="nav-black"></label>
        <div class="menu-content">
          <ul>
            <li><a href="./register.php">sign up</a></li>
            <li><a href="./login.php">log in</a></li>
            <li><a href="./member.php">member</a></li>
            <li><a href="./contact.php">contact</a></li>
            <li><a href="./change_pw.php">change password</a></li>
            <li><a href="./forget_pw.php">reissue password</a></li>
            <li><a href="https://wweb.dev/resources/css-separator-generator/">separator</a></li>
            <li><a href="https://flexbox.buildwithreact.com/">flexbox</a></li>
            <li><a href="https://shadows.brumm.af/">shadow</a></li>
            <li><a href="https://neumorphism.io/#e0e0e0">embossment</a></li>
            <li><a href="https://css.glass/">glass</a></li>
            <li><a href="https://mycolor.space/gradient3">gradient</a></li>
            <li><a href="https://bennettfeely.com/clippy/">clip-path</a></li>
            <li><a href="https://css-generator.netlify.app/">generator</a></li>
            <li><a href="https://coco-factory.jp/ugokuweb/">ugokuweb</a></li>
            <li><a href="https://www.color-hex.com/">color</a></li>
            <li><a href="https://sounansa.net/archives/647">login UI</a></li>
          </ul>
        </div>
      </div>
    </header>
    <main>
      <p class="greeting">kumihan.com</p>
    </main>
  </div>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>