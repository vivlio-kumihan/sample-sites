<?php
// セッション開始
session_start();
// セッションの切符も持っていない訪問者にログインページへリダイレクト処理。
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
  <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
  <script src="./assets/js/behavior.js"></script>
</head>

<body>
  <header></header>


  <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
    <!-- 背景のオーバーレイ -->
    <div class="modal-overlay" tabindex="-1" data-micromodal-close>
      <div class="modal-container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal-header">
          <h2 class="modal-title" id="modal-1-title">Micromodal</h2>
          <!-- 閉じるボタン -->
          <button class="modal-close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <!-- モーダルのコンテンツ -->
        <div class="modal-content" id="modal-1-content">
          Modal Content
        </div>
      </div>
    </div>
  </div>
  <!-- 開くボタン -->
  <button data-micromodal-trigger="modal-1" class="modal-open">
    open
  </button>

  <div class="container">
    <ul class="grid-photos">
      <?php foreach ($images as $photo) { ?>
        <div class="photo">
          <?php echo '<li><img src="', $photo, '" alt="thumbnail"></li>'; ?>
        </div>
      <?php } ?>
    </ul>
  </div>

  <footer></footer>

  <aside></aside>
  <script>MicroModal.init();</script>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

<!-- 
<main>
  <section class="py-5 text-center container">

    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="page-title">Photo</h1>

      </div>
    </div>

    <div class="slider">
      <?php foreach ($images as $photo) { ?>
        <div><?php echo '<img src="', $photo, '">'; ?></div>
      <?php } ?>
    </div>


  </section>
</main> 
-->