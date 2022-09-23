<?php
session_start();
if (!$_SESSION['email']) {
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: //$host$uri/login.php");
  exit;
}
// 画像収集
$images = glob('./assets/img/thumbnail/*.jpg');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>写真</title>

  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-pages-org.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-board.css" />
  <link rel="stylesheet" href="./assets/css/modaal.min.css" />
  <link rel="stylesheet" href="./assets/css/jquery.bxslider.min.css">

  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="./assets/js/modaal.min.js" defer></script>
  <script src="./assets/js/jquery.bxslider.min.js" defer></script>
  <script src="./assets/js/behavior.js" defer></script>
  <script>
    $(document).ready(function() {
      $('.slider').bxSlider();
    });
  </script>
</head>

<body>
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
            <li><a href="./book.html">本</a></li>
            <li><a href="./typesetting.php">組版</a></li>
            <li><a href="./programming.php">プログラミング</a></li>
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
        <li class="menu-bar-item"><a href="./book.html">本</a></li>
        <li class="menu-bar-item"><a href="./typesetting.php">組版</a></li>
        <li class="menu-bar-item"><a href="./programming.php">プログラミング</a></li>
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

  <div id="container">
    <h1>Photograph</h1>

    <!-- <div class="slider">
      <div><img src="./assets/img/photo1.jpg" alt=""> </div>
      <div><img src="./assets/img/photo2.jpg" alt=""> </div>
      <div><img src="./assets/img/photo3.jpg" alt=""> </div>
      </div> -->

    <button class="header-button"><span></span></button>
    <ul class="grid-photos">
      <?php foreach ($images as $photo) { ?>
        <?php
        $path_to_thumbnail = './assets/img/thumbnail/' . basename($photo);
        $path_to_view_photo = './assets/img/album/' . basename($photo);
        ?>
        <?php echo '<a class="view-photo" href="', $path_to_view_photo, '" data-group="gallery" class="gallery">' ?>
        <?php echo '<li><img class="thumbnail-photo" src="', $path_to_thumbnail, '" alt="thumbnail"></li>'; ?>
        </a>
      <?php } ?>
    </ul>
  </div>

  <footer></footer>
</body>

</html>