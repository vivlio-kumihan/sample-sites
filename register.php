<?php
require_once('../../tmp/conf_common_thyme_jp.php');
require_once('./lib/function.php');

$err_mesg = array();

if ($_POST) {
  $name = get_post('name');
  $email = get_post('email');
  $password = get_post('password');
  $confirm_password = get_post('confirm_password');

  $dbh = get_db_connect();

  // for name
  if (!$name || mb_strlen($name) > 20) {
    $err_mesg[] = 'お名前を入力してください。';
  } elseif ($name) {
    try {
      $sql = "SELECT COUNT(id) FROM `sample-sites` WHERE `name` = :name";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':name', $name, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetch(PDO::FETCH_ASSOC);
      
      if ($count['COUNT(id)'] > 0) {
          $err_mesg[] = '記入されたお名前は既に登録されています。';
      }
    } catch (PDOException $e) {
      echo ("接続に失敗しました。" . $e->getMessage());
      die();
    }
  }
  
  // for email
  if (!$email) {
    $err_mesg[] = 'Eメールアドレスを入力してください。';
  } elseif (mb_strlen($email) > 100) {
    $err_mesg[] = 'アドレスが100文字以上です。';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err_mesg[] = '入力されたEメールアドレスは不正です。';
  } elseif ($email) {
    try {
      $sql = "SELECT COUNT(id) FROM `sample-sites` WHERE `email` = :email";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetch(PDO::FETCH_ASSOC);
      
      if ($count['COUNT(id)'] > 0) {
          $err_mesg[] = '記入されたEメールアドレスは既に登録されています。';
      }
    } catch (PDOException $e) {
      echo ("接続に失敗しました。" . $e->getMessage());
      die();
    }
  }

  // for password
  if (!$password) {
    $err_mesg[] =  'パスワードを入力してください。';
  } elseif (mb_strlen($password) > 17) {
    $err_mesg[] = 'パスワードは16文字以内で入力してください。';
  }
  
  // for confirm password
  if (!$confirm_password) {
    $err_mesg[] = '確認用のパスワードをにゅうりょくしてください。';
  } elseif ($password !== $confirm_password ) {
    $err_mesg[] = '確認用に入力されたパスワードが一致しません。';
  }

  // パスワードを暗号化する。
  $password = password_hash($password, PASSWORD_DEFAULT);

  if (!$err_mesg) {
    try {
      $date = date('Y-m-d H:i:s');
      $sql = "INSERT INTO `sample-sites`(`name`, `email`, `password`, `created`) VALUES (:name, :email, :password, '$date')";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':name', $name, PDO::PARAM_STR);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) {
      echo ("接続に失敗しました。" . $e->getMessage());
      die();
    }
  }
}


?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メンバー登録</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
</head>

<body id="entrance">
  <div class="entrance-form-wrapper">
    <h1>SIGN UP</h1>
    <form action="./register.php" method="POST">
      <div class="form-item">
        <label for="name"></label>
        <input type="name" name="name" required="required" placeholder="お名前" value="<?php echo forxss($_POST['name']) ?>"></input>
      </div>
      <div class="form-item">
        <label for="email"></label>
        <input type="email" name="email" required="required" placeholder="Eメールアドレス" value="<?php echo forxss($_POST['email']) ?>"></input>
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input type="password" name="password" required="required" placeholder="パスワード"></input>
      </div>
      <div class="form-item">
        <label for="confirm-password"></label>
        <input type="password" name="confirm_password" required="required" placeholder="パスワード（確認）"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Sign Up" value="Sign Up"></input>
      </div>
    </form>
    <div class="form-footer">
      <p><a href="./index.php">Back to HOME</a></p>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>