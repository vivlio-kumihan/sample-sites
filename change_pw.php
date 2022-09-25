<?php
require_once('../../tmp/conf_common_thyme_jp.php');
require_once('./lib/function.php');

session_start();
// // セッションの切符も持っていない訪問者にログインページへリダイレクト処理。
if (!$_SESSION['email']) {
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: //$host$uri/login.php");
  exit;
}

$err_mesg = array();
$report_mesg = array();
$complete = false;

if ($_POST) {
  $password = get_post('password');
  $new_password = get_post('new_password');

  if (!$password || mb_strlen($password) > 17) {
    $err_mesg[] = '現在のパスワードを入力してください。';
  }

  if (!$new_password || mb_strlen($new_password) > 21) {
    $err_mesg[] = 'ご希望の新しいパスワードを20文字以内で入力してください。';
  }

  $dbh = get_db_connect();
  
  try {
    $sql = "SELECT * FROM `sample-sites` WHERE `email` = :email LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $profile = $stmt->fetch(PDO::FETCH_ASSOC);
      // 新しいパスワードのハッシュ値を生成させて初期化する。
      $hashed_new_pw = password_hash($new_password, PASSWORD_DEFAULT);
      if (password_verify($password, $profile['password'])) {
        $sql = "UPDATE `sample-sites` SET `password` = :password WHERE {$profile['id']}";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':password', $hashed_new_pw, PDO::PARAM_STR);
        $stmt->execute();
        $report_mesg[] = "パスワードを変更しました。<br>一旦、ログアウト→再度ログインしてご確認ください。<br>";
        $complete = true;
      } else {
        $err_mesg[] = '入力されたパスワードは登録されたものと違います。';
        $err_mesg[] = '一旦<a href="./logout.php">ログアウト</a>されますか？';
      }
    } else {
      $err_mesg[] = '入力されたEメールアドレスは登録されたものと違います。';
    }
  } catch (PDOException $e) {
    print("接続に失敗しました。" . $e->getMessage());
    die();
  }
} else {
  // GETで情報がきた時の処理
  $_POST = array();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>パスワードの変更</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
</head>

<body>
  <main class="entrance-form-wrapper">
  <?php if ($err_mesg) { ?>
    <?php
    echo '<div class="alert">';
    echo implode('<br>', $err_mesg);
    echo '</div>';
    ?>
  <?php } ?>

  <?php if ($complete) { ?>
    <?php
      echo '<div class="report_mesg">';
      echo implode('<br>', $report_mesg);
      echo '<a href="./logout.php">ログアウトへ</a><i class="fa-solid fa-arrow-right-to-bracket"></i>';
      echo '</div>';
    ?>

  <?php } else { ?>
    <h1>change password</h1>
    <form action="./change_pw.php" method="POST">
      <div class="form-item">
        <!-- <label for="password"></label> -->
        <input type="password" name="password" placeholder="現在のパスワード"></input>
      </div>
      <div class="form-item">
        <!-- <label for="new-password"></label> -->
        <input type="password" name="new_password" placeholder="新しいパスワード"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" value="送信"></input>
      </div>
    </form>
    <div class="form-footer">
      <p><a href="./index.php">ホームへ戻る<i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
    </div>
  <?php } ?>
  </main>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>