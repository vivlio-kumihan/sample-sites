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
  <title>login</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
</head>


<body id="entrance">
  <div class="entrance-form-wrapper">
    <?php
    if ($err_mesg) {
      echo '<div class="alert">';
      echo implode('<br>', $err_mesg);
      echo '</div>';
    }
    ?>
    <h1>Completed log out</h1>
    <h3>ログアウトしました。</h3>
    <a href="./login.php"></a>
    <div class="form-footer">
      <p><a href="./register.php">メンバー登録はこちら<i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
      <p><a href="./login.php">ログインページはこちら<i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>