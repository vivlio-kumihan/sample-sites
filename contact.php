<?php
// クロス・サイト・リクエスト・フォージェリー
// CSRF
// フォーム入力の際にトークン（合言葉）を忍ばせてサーバーに保存する。$_SESSION['token']
// 確認画面から送信ボタンを押す際に$_POST['token']を出して付き合わせる。
// $_POSTにデフォルトで$_POST['token']が含まれる。
// 暗号論的にセキュアな乱数が発生させる関数
// $token = bin2hex(random_bytes(32));

require_once('../../tmp/conf_common_thyme_jp.php');
require_once('./lib/function.php');

session_start();

// セッションで振り分け。
if (!$_SESSION['email']) {
  $host = $_SERVER['HTTP_HOST'];
  $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: //$host$uri/login.php");
  exit;

  // セッションに格納されているEメールアドレスから
  // 記入者のフルネームを割り出し変数に格納しておく。
} else {
  $dbh = get_db_connect();
  try {
    $sql = "SELECT * FROM `sample-sites` WHERE `email` = :email LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $profile = $stmt->fetch(PDO::FETCH_ASSOC);
      // 発信者のフルネームを変数に格納する。
      $full_name = $profile['last_name'] . $profile['first_name'];
    }
  } catch (PDOException $e) {
    echo ("Eメールアドレスからの接続でエラー発生" . $e->getMessage());
    die();
  }
}

// 方向分け（入力・確認・送信）。符号をここで格納する。
$toward = 'input';

// 確認のボタンを押した瞬間に行われること。
//   ・メッセージ内容のvalidation
//   ・入力されたメッセージ内ののXSS対策
//   ・トークンの生成とセッションへの追記・格納

// POSTに『back』で送られ来たら
if (isset($_POST['back']) && $_POST['back']) {
  // 何もしない

  // $_POST['confirm'] => そもそもPOSTが送られてきたのか？
  // isset($_POST[key]) => is set ? => 且つ、keyは設定されているか？
} elseif ($_POST['confirm'] && isset($_POST['confirm'])) {
  if (!$_POST['mesg']) {
    $err_mesg[] = 'お問合せ内容を入力してください。';
  } elseif (mb_strlen($_POST['name']) > 1000) {
    $err_mesg[] = '内容は、1000文字以内で入力してください。';
  }
  // セッションに格納。
  $_SESSION['mesg'] = forxss($_POST['mesg']);

  // 行き先の振り分け
  if ($err_mesg) {
    // エラーがあったらinputつまり、フォームの画面へ振り分ける。
    // フォーム入力画面への符号をここで格納する。
    $toward = 'input';
  } else {
    // 確認画面へ振り分けるこの瞬間、
    // CSRF対策の合言葉（乱数）を忍び込ませる処理をする。
    // 確認画面の送信ボタンを引鉄にサーバーへ向かって発する『合言葉』を
    // セッションに追記・格納する。
    $_SESSION['token'] = bin2hex(random_bytes(32));
    // 確認画面への符号をここで格納する。
    $toward = 'confirm';
  }

  // POSTに『send』で送られ来たら
} elseif ($_POST['send'] && isset($_POST['send'])) {
  // そもそもトークンがなんらかの理由で無かった時、セッションにEメール情報が保存されなかった時
  // エラーを返す。
  if (!$_POST['token'] || !$_SESSION['token'] || !$_SESSION['email']) {
    $err_mesg = 'CSRFなどセキュリティ上、不正な処理を感ししました。最初から処理をやり直してください。';
    // この作業で入力されたセッション情報を初期化し、
    $_SESSION['mesg'] = '';
    // フォーム入力画面へ差し戻す符をを発行する。
    $toward = 'input';

    // 送信ボタンを押されてインスタンスと伴に合言葉がやってくる。
    // サーバーに保存しておいた合言葉とここで符合させる。
  } elseif ($_POST['token'] != $_SESSION['token']) {
    // エラーで警告し、
    $err_mesg = 'CSRFなどセキュリティ上、不正な処理を感ししました。最初から処理をやり直してください。';
    // この作業で入力されたセッション情報を初期化し、
    $_SESSION['mesg'] = '';
    // フォーム入力画面へ差し戻す符をを発行する。
    $toward = 'input';
  } else {
    $message_for_customer = "お問合せを受け付けました。\r\n\r\n"
      . "お名前: " . $full_name . "様\r\n"
      . "Eメールアドレス: " . $_SESSION['email'] . "\r\n"
      . "お問合せ内容:\r\n"
      . preg_replace("/\r\n|\r|\n/", "\r\n"
        . "担当者より連絡いたします。いましばらくお待ちください。", $_SESSION['mesg']);
    $message_to_staff = "問合せを受け付けました。\r\n対応をお願いします。\r\n\r\n_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/\r\n\r\n"
      . "お名前: " . $full_name . "様\r\n"
      . "Eメールアドレス: " . $_SESSION['email'] . "\r\n"
      . "お問合せ内容:\r\n"
      . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['mesg']);
    mail($_SESSION['email'], '【kumihan.com】お問合せを受け付けました。', $message_for_customer);
    mail('info@kumihan.com', "{$full_name}様からお問合せ受付の件", $message_to_staff);
    // お問合せで使ったセッションを解放する。もちろんEmailのセッションは残さないといけない。
    $_SESSION['mesg'] = '';
    $toward = 'send';
  }
  // GETで来た時の初回表示
} else {
  $_SESSION['mesg'] = '';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問合せ</title>
  <link rel="stylesheet" href="./assets/css/reset.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/fonts.css" />
  <link rel="stylesheet" href="./assets/css/ss-style.css" />
</head>

<body id="entrance">
  <div class="entrance-form-wrapper">
    <?php if ($err_mesg) { ?>
      <?php
      echo '<div class="alert">';
      echo implode('<br>', $err_mesg);
      echo '</div>';
      ?>
    <?php } ?>

    <?php if ($toward === 'input') { ?>
      <h1>contact</h1>
      <form action="./contact.php" method="POST">
        <div class="form-item">
          <label for="email">発信者<i class="fa-solid fa-angles-right"></i><?php echo $full_name ?>&nbsp;様</label>
          <!-- <input type="text" name="name" placeholder="お名前" value=""></input> -->
        </div>
        <div class="form-item">
          <label for=" email">Email<i class="fa-solid fa-angles-right"></i><?php echo $_SESSION['email'] ?></label>
          <!-- <input type="email" name="email" placeholder="Eメールアドレス" value=""></input> -->
        </div>
        <div class="form-item">
          <!-- <label for="textarea"></label> -->
          <textarea cols="40" rows="8" name="mesg" placeholder="お問い合せ内容">
            <div class="contact-input-area">
              <p><?php echo $_SESSION['mesg'] ?></p>
            </div>
          </textarea>
        </div>
        <div class="button-panel">
          <input type="submit" class="button" name="confirm" value="確認"></input>
        </div>
      </form>
    <?php } elseif ($toward === 'confirm') { ?>
      <form action="./contact.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <div class="form-item">
          <label for="name">発信者<i class="fa-solid fa-angles-right"></i>&emsp;<?php echo $full_name ?>&nbsp;様</label>
          <!-- <input type="text" name="name" placeholder="お名前" value=""></input> -->
        </div>
        <div class="form-item">
          <label for="email">Email<i class="fa-solid fa-angles-right"></i>&emsp;<?php echo $_SESSION['email'] ?></label>
          <!-- <input type="email" name="email" placeholder="Eメールアドレス" value=""></input> -->
        </div>
        <div class="form-item">
          <label for="mesg" style="display: inline-block; margin-bottom: 0.5rem;">お問合せ内容</label>
          <p><?php echo nl2br($_SESSION['mesg']) ?></p>
        </div>
        <div class="button-panel">
          <input type="submit" class="button" name="back" value="戻る"></input>
          <input type="submit" class="button" name="send" value="送信"></input>
        </div>
      </form>
    <?php } else { ?>
      <p>お問合せを受け付けました。担当から連絡をいたします。今しばらくおまちください。</p>
    <?php } ?>
    <div class="form-footer">
      <p><a href="./index.php">Back to HOME<i class="fa-solid fa-arrow-right-to-bracket"></i></a></p>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>