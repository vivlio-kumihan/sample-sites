<?php
require_once('../../tmp/conf_common_thyme_jp.php');
require_once('./lib/function.php');
// // セッション開始
// // ログインフォームでの認証を経てWebPage内へ入場する。
// // その際セッションをスタートする宣言をする。
// // 一回入ったらブラウザを閉じるまでログインの認証は要らない、自由に往来できる切符を渡すようなイメージ。
// // 閲覧できる各ページには、この切符を最初の行に貼り付けてある。
// session_start();

// // エラーメッセージ対応。配列として初期化。
// $err_mesg = array();

// // POST情報が入ってきた場合の処理開始。
// if ($_POST) {
//   $email = $_POST['email'];
//   $password = $_POST['password'];

//   // 入力チェックをする。
//   // Eメールアドレス
//   // $_POSTに 'email'の値が無ければ、
//   if (!$email) {
//     $err_mesg[] = 'Eメールアドレスを入力してください。';
//     // 100文字以上の入力があれば、
//   } elseif (mb_strlen($email) > 100) {
//     $err_mesg[] = '100文字以内でアドレスを入力してください。';
//     // 入力されたEメールアドレスをvalidateしてみて不正であれば、
//   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     $err_mesg[] = '入力されたEメールアドレスは不正です。';
//   }
//   // パスワード
//   // $_POSTに'password'の値が無ければ、
//   if (!$password) {
//     $err_mesg[] = 'パスワードを入力してください。';
//     // 17文字以上の入力があれば、
//     // 要確認　0から9、a-zA-Z、-（ハイフン）、 _（アンダーバー）以外が入力されたらの条件も入れたい。
//   } elseif (mb_strlen($password) > 17) {
//     $err_mesg[] = 'パスワードは、16文字以内で入力してください。';
//   }

//   // DB接続に係る変数を生成
//   $dsn = DNS;
//   $user = DB_USER;
//   $pwd = DB_PASSWORD;
//   $dbh = new PDO($dsn, $user, $pwd);
//   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   // $dbh = get_db_connect();

//   try {
//     $sql = "SELECT * FROM `member` WHERE `email` = :email LIMIT 1";
//     $stmt = $dbh->prepare($sql);
//     $stmt->bindValue(':email', $email, PDO::PARAM_STR);
//     $stmt->execute();
//     if ($stmt->rowCount() > 0) {
//       $data = $stmt->fetch(PDO::FETCH_ASSOC);
//       if (password_verify($password, $data['password'])) {
//         $_SESSION['email'] = $email;
//         $host = $_SERVER['HTTP_HOST'];
//         $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//         header("Location: //$host$uri/member.php");
//         exit;
//       } else {
//         $err_mesg[] = 'ログイン情報が間違っています。再入力をお願いします。';
//       }
//       // この分岐大切。ユーザーに優しくしようと思うのならやならいといけない分岐。
//     } else {
//       $err_mesg[] = 'ログイン情報が間違っています。再入力をお願いします。';
//     }
//   } catch (PDOException $e) {
//     echo ("接続に失敗しました。" . $e->getMessage());
//     die();
//   }
// } else {
//   // GETの時の処理
//   // 初回アクセスで既にsessionの切符を持っている状態であれば、login手続きを通過させてindex.phpへ通す。
//   // 連想配列『$_SESSION['email']』要素があり、その内容が存在しているならばリダイレクトさせる。
//   if (isset($_SESSION['email']) && $_SESSION['email']) {
//     // リダイレクト処理
//     $host = $_SERVER['HTTP_HOST'];
//     $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//     header("Location: //$host$uri/index.php");
//     exit;
//   }
//   $_POST = array();
//   $_POST['email'] = '';
// }
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
    <h1>SIGN IN</h1>
    <form>
      <div class="form-item">
        <label for="email"></label>
        <input type="email" name="email" required="required" placeholder="Email Address"></input>
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input type="password" name="password" required="required" placeholder="Password"></input>
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Sign In" value="Sign In"></input>
      </div>
    </form>
    <div class="form-footer">
      <p><a href="#">Create an account</a></p>
      <p><a href="#">Forgot password?</a></p>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>