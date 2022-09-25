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
  <title>掲示板</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-pages-org.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-borad.css" />
  <link rel="stylesheet" href="./assets/css/modaal.min.css" />
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous" defer></script>
  <script src="./assets/js/modaal.min.js" defer></script>
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
              <li><a href="./index.php">ホーム</a></li>
              <li><a href="./book.php">本</a></li>
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
          <li class="menu-bar-item"><a href="./index.php">ホーム</a></li>
          <li class="menu-bar-item"><a href="./book.php">本</a></li>
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
    <h1>kumihanBBS</h1>

    <?php
    if ($err_mesg) {
      echo '<div class="alert">';
      echo implode('<br>', $err_mesg);
      echo '</div>';
    }
    ?>

    <div class="post-mesg">
      <div class="write-button">
        <button><a href="#modal_link" class="modal">投稿する</a></button>
      </div>

      <div id="modal_link" style="display: none;">
        <!-- 書き込み -->
        <form action="./board.php" method="POST">
          <div class="form-item">
            <input type="text" name="name" placeholder="名前" value="<?php echo forxss($_POST['name']) ?>"></input>
          </div>
          <div class="form-item">
            <textarea cols="30" rows="15" name="comment" placeholder="投稿"></textarea>
          </div>
          <div class="button-panel">
            <input type="submit" class="button" value="送信"></input>
          </div>
        </form>
      </div>
    </div>

    <div class="receive">
      <!-- 掲示板 -->
      <ul class="timeline">
        <?php if (count($data)) { ?>
          <?php foreach (array_reverse($data) as $row) { ?>
            <li class="timeline-item">
              <div class="user"><?php echo forxss($row['name']); ?></div>
              <p><?php echo $row['created']; ?></p>
              <p><?php echo nl2br(forxss($row['comment'])); ?></p>
            </li>
          <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </div>

  <footer></footer>
</body>

</html>