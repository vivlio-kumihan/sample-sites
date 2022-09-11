<?php
require_once('../../tmp/conf_common_thyme_jp.php');
require_once('./lib/function.php');

$err_mesg = array();
$report_mesg = array();
$complete = false;

if ($_POST) {
  $email = get_post('email');

  // Eメールアドレス
  if (!$email || mb_strlen($email) > 100) {
    $err_mesg[] = 'Eメールアドレスを入力してください。';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err_mesg[] = '入力されたEメールアドレスは不正です。';
  }

  $dbh = get_db_connect();

  try {
    $sql = "SELECT * FROM `sample-sites` WHERE `email` = :email LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $profile = $stmt->fetch(PDO::FETCH_ASSOC);
      // ================ 重要 =================
      // 再発行するパスワードを生成する。
      $tmp_pw = bin2hex(random_bytes(5));
      // ================ 重要 =================
      // サーバーにメールを送信させる命令。
      // 日本語の送信で文字化けが起こる場合、mail.phpを参照する。
      $mail_mesg = "パスワードを変更しました。\r\n新パスワード => " . $tmp_pw . "\r\n";
      mail($email, 'パスワードの再発行いたしました。', $mail_mesg);
      // パスワードハッシュをかける。
      $hashed_tmp_pw = password_hash($tmp_pw, PASSWORD_DEFAULT);
      // 該当のデータをアップデートする。
      $sql = "UPDATE `sample-sites` SET `password` = :password WHERE {$profile['id']}";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':password', $hashed_tmp_pw, PDO::PARAM_STR);
      $stmt->execute();
      $complete = true;
      $report_mesg[] = "新しいパスワードを登録されているEメールアドレス宛に送信しました。";
      // $host = $_SERVER['HTTP_HOST'];
      // $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      // header("Location: //$host$uri/logout.php");
    } else {
      $err_mesg[] = '登録されたEメールアドレスと違います。';
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
  <title>パスワードの再発行</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
</head>

<body id="entrance"">
  <main class=" entrance-form-wrapper">
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
      echo '<a href="./logout.php">
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
              ログアウトへ
            </a>';
      echo '</div>';
    ?>
  <?php } else { ?>
    <h1>REISSUE OF PASSWORD</h1>
    <h3>Eメールアドレス宛に<br>新しいパスワードを送信します。</h3>
    <form action="./forget_pw.php" method="POST">
      <div class="form-item">
        <!-- <label for="email"></label> -->
        <input type="email" name="email" placeholder="Eメールアドレス"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" value="送信"></input>
      </div>
    </form>
    <div class="form-footer">
    </div>
  <?php } ?>
  </main>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>