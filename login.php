<?php
require_once('../../tmp/conf_common_thyme_jp.php');
require_once('./lib/function.php');

session_start();

$err_mesg = array();

if ($_POST) {
  $email = get_post('email');
  $password = get_post('password');

  
  // for email
  if (!$email || mb_strlen($email) > 100) {
    $err_mesg[] = 'Eメールアドレスを確認してください。';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err_mesg[] = '入力されたEメールアドレスは不正です。';
  }
  
  // for password
  if (!$password || mb_strlen($password) > 17) {
    $err_mesg[] = 'パスワードを入力してください。';
  }

  $dbh = get_db_connect();

  try {
    $sql = "SELECT * FROM `sample-sites` WHERE `email` = :email LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $profile = $stmt->fetch(PDO::FETCH_ASSOC);
      if (password_verify($password, $profile['password'])) {
        $_SESSION['email'] = $email;
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: //$host$uri/member.php");
        exit;
      } else {
        $err_mesg[] = "登録されたパスワードを入力してください。";
      }
    } else {
      $err_mesg[] = "入力されたアドレスで登録はありません。再入力をしてください。";
    }
  } catch (PDOException $e) {
    echo ('接続に失敗しました。' . $e->getMessage());
    die();
  }
} else {
  $_POST = array();
  $_POST['email'] = '';
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
</head>

<body id="entrance">
  <main class="entrance-form-wrapper">
    <?php if ($err_mesg) { ?>
      <?php
      echo '<div class="alert">';
      echo implode('<br>', $err_mesg);
      echo '</div>';
      ?>
    <?php } ?>
    
    <h1>log in</h1>
    <form action="./login.php" method="POST">
      <div class="form-item">
        <!-- <label for="email"></label> -->
        <input type="email" name="email" placeholder="Eメールアドレス" value="<?php echo forxss($_POST['email']) ?>"></input>
      </div>
      <div class="form-item">
        <!-- <label for="password"></label> -->
        <input type="password" name="password" placeholder="パスワード"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" value="ログイン"></input>
      </div>
    </form>
    <div class="form-footer">
      <p><a href="./index.php">ホームへ<i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
      <p><a href="./register.php">メンバー登録へ<i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
      <p><a href="./forget_pw.php">パスワードを忘れた方はこちらから<i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
    </div>
  </main>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>