<?php
require_once('../../tmp/conf_common_thyme_jp.php');
require_once('./lib/function.php');

$err_mesg = array();

if ($_POST) {
  $last_name = get_post('last-name');
  $first_name = get_post('first-name');
  $email = get_post('email');
  $password = get_post('password');
  $confirm_password = get_post('confirm_password');

  $dbh = get_db_connect();

  // for name
  if (!$last_name || mb_strlen($last_name) > 10) {
    $err_mesg[] = '苗字を入力してください。';
  } elseif (!$first_name || mb_strlen($first_name) > 10) {
    $err_mesg[] = '名前を入力してください。';
  } elseif ($last_name && $first_name) {
    try {
      $sql = "SELECT COUNT(id) FROM `sample-sites` WHERE `last_name` = :last_name AND `first_name` = :first_name";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
      $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($count['COUNT(id)'] > 0) {
        $err_mesg[] = '記入されたお名前は既に登録されています。';
      }
    } catch (PDOException $e) {
      echo ("名前の接続でエラー発生" . $e->getMessage());
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
      echo ("Eメールアドレスの接続でエラー発生" . $e->getMessage());
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
  } elseif ($password !== $confirm_password) {
    $err_mesg[] = '確認用に入力されたパスワードが一致しません。';
  }

  // パスワードを暗号化する。
  $password = password_hash($password, PASSWORD_DEFAULT);

  if (!$err_mesg) {
    try {
      $date = date('Y-m-d H:i:s');
      $sql = "INSERT INTO `sample-sites`(`last_name`, `first_name`, `email`, `password`, `created`) VALUES (:last_name, :first_name, :email, :password, '$date')";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
      $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) {
      echo ("接続に失敗しました。" . $e->getMessage());
      die();
    }

    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: //$host$uri/member.php");
    exit;
  }
} else {
  $_POST = array();
  $_POST['last-name'] = '';
  $_POST['first-name'] = '';
  $_POST['email'] = '';
  $_SESSION = array();
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
    <?php
    if ($err_mesg) {
      echo '<div class="alert">';
      echo implode('<br>', $err_mesg);
      echo '</div>';
    }
    ?>
    <h1>SIGN UP</h1>
    <form action="./register.php" method="POST">
      <div id="full-name" class="form-item">
        <!-- <label for="name-sei"></label> -->
        <input type="name" name="last-name" placeholder="氏名（姓）" value="<?php echo forxss($_POST['last-name']) ?>"></input>
        <!-- <label for="name-mei"></label> -->
        <input type="name" name="first-name" placeholder="（名）" value="<?php echo forxss($_POST['first-name']) ?>"></input>
      </div>
      <div class="form-item">
        <!-- <label for="email"></label> -->
        <input type="email" name="email" required="required" placeholder="Eメールアドレス" value="<?php echo forxss($_POST['email']) ?>"></input>
      </div>
      <div class="form-item">
        <!-- <label for="password"></label> -->
        <input type="password" name="password" required="required" placeholder="パスワード"></input>
      </div>
      <div class="form-item">
        <!-- <label for="confirm-password"></label> -->
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