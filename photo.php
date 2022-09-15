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
  <link rel="stylesheet" href="./assets/css/modaal.min.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
  <link rel="stylesheet" href="./assets/css/ss-style-pages-org.css" />
  <script src="./assets/js/behavior.js"></script>
  <script src="./assets/js/modaal.min.js" defer></script>
</head>

<body>
  <header></header>


  <div class="container">
    <ul class="grid-photos">
      <?php foreach ($images as $photo) { ?>
        <?php
          $path_to_photo = './assets/img/thumbnail/' . basename($photo);
          $path_to_view_photo = './assets/img/album/' . basename($photo);
        ?>
        <?php echo '<a class="view-photo" href="', $path_to_view_photo, '" data-group="gallery" class="gallery">' ?>
          <div class="photo">
            <?php echo '<li><img src="', $path_to_photo, '" alt="thumbnail"></li>'; ?>
          </div>
        </a>
      <?php } ?>
    </ul>
  </div>

  <!-- <?php echo '<li><img src="', $photo, '" alt="thumbnail"></li>'; ?> -->
  <footer></footer>

  <aside></aside>

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