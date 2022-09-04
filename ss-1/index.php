<?php
// クロス・サイト・リクエスト・フォージェリー
// CSRF
// フォーム入力の際にトークン（合言葉）を忍ばせてサーバーに保存する。$_SESSION['token']
// 確認画面から送信ボタンを押す際に$_POST['token']を出して付き合わせる。$_POSTにデフォルトで$_POST['token']が含まれる。
// 暗号論的にセキュアな乱数が発生させる関数
// $token = bin2hex(random_bytes(32));

// require_once('../../tmp/conf.php');
// require_once('./lib/function.php');

// // セッション開始
// session_start();
// // セッションの切符も持っていない訪問者にログインページへリダイレクト処理。
// if (!$_SESSION['email']) {
//   $host = $_SERVER['HTTP_HOST'];
//   $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//   header("Location: //$host$uri/login.php");
//   exit;
// }

// // 一つのファイルで複数の出力を実現させるための方法。
// // GET、POSTで行き先を振り分ける。

// // 関数解説 isset()
// // isset($_POST[key]) => is set ? => keyは設定されているか？

// $toward = 'input';
// // 配列に当該のkeyが設定されているのか？　かつ、keyに値は格納されているのか？
// if (isset($_POST['back']) && $_POST['back']) {
//   // 何もしない
//   // POSTに『confirm』で送られ来たら
// } elseif (isset($_POST['confirm']) && $_POST['confirm']) {
//   // validation開始
//   // お名前
//   if (!$_POST['name']) {
//     $err_mesg[] = 'お名前を入力してください。';
//   } elseif (mb_strlen($_POST['name']) > 100) {
//     $err_mesg[] = 'お名前は100文字以内で入力してください。';
//   }
//   // セッションに格納
//   $_SESSION['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);

//   // Eメールアドレス
//   if (!$_POST['contact_email']) {
//     $err_mesg[] = 'Eメールアドレスを入力してください。';
//   } elseif (mb_strlen($_POST['contact_email']) > 200) {
//     $err_mesg[] = 'Eメールアドレスは200文字以内で入力してください。';
//   } elseif (!filter_var($_POST['contact_email'], FILTER_VALIDATE_EMAIL)) {
//     $err_mesg[] = '入力されたEメールアドレスは不正です。';
//   }
//   // セッションに格納
//   $_SESSION['contact_email'] = htmlspecialchars($_POST['contact_email'], ENT_QUOTES);

//   // お問合せ
//   if (!$_POST['mesg']) {
//     $err_mesg[] = 'お問合せ内容を入力してください。';
//   } elseif (mb_strlen($_POST['name']) > 1000) {
//     $err_mesg[] = 'お名前は1000文字以内で入力してください。';
//   }
//   // セッションに格納
//   $_SESSION['mesg'] = htmlspecialchars($_POST['mesg'], ENT_QUOTES);

//   // 行き先の振り分け
//   if ($err_mesg) {
//     // エラーがあったらinputつまり、フォームの画面へ振り分けられる。
//     // フォーム入力画面への符号をここで格納する。
//     $toward = 'input';
//   } else {
//     // validationが正常に済めば、確認画面へ振り分けられる。
//     // ここにCSRF対策の合言葉（乱数）を忍び込ませる処理を追加する。
//     // 確が画面の送信ボタンを押す際にサーバーへ向かって発する合言葉をここで変数に格納する。
//     $token = bin2hex(random_bytes(32));
//     // サーバー側に保存させておく合言葉を先ほどの変数を使って格納する。
//     $_SESSION['token'] = $token;
//     // 確認画面への符号をここで格納する。
//     $toward = 'confirm';
//   }

//   // POSTに『send』で送られ来たら
// } elseif (isset($_POST['send']) && $_POST['send']) {
//   // そもそもトークンがなんらかの理由で無かった時、セッションにEメール情報が保存されなかった時
//   // エラーを返す。
//   if (!$_POST['token'] || !$_SESSION['token'] || !$_SESSION['contact_email']) {
//     $err_mesg = 'CSRFなどセキュリティ上、不正な処理を感ししました。最初から処理をやり直してください。';
//     // この作業で入力されたセッション情報を初期化し、
//     $_SESSION['name'] = '';
//     $_SESSION['contact_email'] = '';
//     $_SESSION['mesg'] = '';
//     // フォーム入力画面へ差し戻す符をを発行する。
//     $toward = 'input';

//     // 送信ボタンを押されてインスタンスと伴に合言葉がやってくる。
//     // サーバーに保存しておいた合言葉とここで符合させる。
//   } elseif ($_POST['token'] != $_SESSION['token']) {
//     // エラーで警告し、
//     $err_mesg = 'CSRFなどセキュリティ上、不正な処理を感ししました。最初から処理をやり直してください。';
//     // この作業で入力されたセッション情報を初期化し、
//     $_SESSION['name'] = '';
//     $_SESSION['contact_email'] = '';
//     $_SESSION['mesg'] = '';
//     // フォーム入力画面へ差し戻す符をを発行する。
//     $toward = 'input';
//   } else {
//     $message_for_customer = "お問合せを受け付けました。\r\n\r\n"
//       . "お名前: " . $_SESSION['name'] . "様\r\n"
//       . "Eメールアドレス: " . $_SESSION['contact_email'] . "\r\n"
//       . "お問合せ内容:\r\n"
//       . preg_replace("/\r\n|\r|\n/", "\r\n"
//         . "担当者より連絡いたします。いましばらくお待ちください。", $_SESSION['mesg']);
//     $message_to_staff = "問合せを受け付けました。\r\n対応をお願いします。\r\n\r\n_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/\r\n\r\n"
//       . "お名前: " . $_SESSION['name'] . "様\r\n"
//       . "Eメールアドレス: " . $_SESSION['contact_email'] . "\r\n"
//       . "お問合せ内容:\r\n"
//       . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['mesg']);
//     mail($_SESSION['contact_email'], '【kumihan.com】お問合せを受け付けました。', $message_for_customer);
//     mail('info@quad9.sakura.ne.jp', "{$_SESSION['name']}様からお問合せ受付の件", $message_to_staff);
//     // お問合せで使ったセッションを解放する。もちろんEmailのセッションは残さないといけない。
//     $_SESSION['name'] = '';
//     $_SESSION['contact_email'] = '';
//     $_SESSION['mesg'] = '';
//     $toward = 'send';
//   }
//   // GETで来た時の初回表示
// } else {
//   $_SESSION['name'] = '';
//   $_SESSION['contact_email'] = '';
//   $_SESSION['mesg'] = '';
// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/normalize.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="assets/css/fonts.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <title>SS-1 OnePageWeb</title>
  <style>
    form dt::before {
      font-family: "Font Awesome 5 Free";
      content: "\f030";
      display: inline-block;
      font-style: normal;
      font-variant: normal;
      text-rendering: auto;
      line-height: 1;
    }
  </style>
</head>

<body>
  <header>
    <div class="header-logo">kumihan.com</div>
  </header>
  <main>
    <div class="main-visual">
      <img src="./assets/img/photographs-256888_1920.jpeg" alt="">
      <div class="catch-copy">売れる写真撮影徹底入門</div>
    </div>
    <section>
      <div class="st-inner">
        <h2>Web限定キャンペーン中！</h2>
        <p>9/30までにWebでお申し込みいただいた方限定で、特別価格を実施中です。写真道場は、〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓。</p>
      </div>
    </section>
    <section>
      <div class="st-inner">
        <h2>ポートレイト撮影術受講の流れ</h2>
        <ol>
          <li>講習—西洋絵画からひもとくポートレイト撮影の光と影を理解する。（5-6時間）</li>
          <li>スタジオ実習（1日）</li>
          <li>野外実習（1日）</li>
          <li>現像・講評（1日）</li>
        </ol>
        <table>
          <tr>
            <th>料金に含まれるもの</th>
            <td>教材費・実習費・機材レンタル代</td>
          </tr>
          <tr>
            <th>料金に含まれないもの</th>
            <td>交通費・宿泊費</td>
          </tr>
        </table>
      </div>
    </section>
    <section>
      <div class="st-inner">
        <!-- フォーム -->
        <h2>お申し込みフォーム</h2>
        <form action="./index.php" method="POST">
          <dl>
            <dt><label for="name">お名前</label></dt>
            <dd><input id="name" type="text" name="name" value="<?php echo $_SESSION['contact_name'] ?>"></dd>
            <dt><label for="email">Eメールアドレス</label></dt>
            <dd><input id="email" type="email" name="email" value="<?php echo $_SESSION['contact_email'] ?>"></dd>
            <dt>写真をはじめて何年くらいですか？</dt>
            <!-- ラジオボタンとラベルの並びは見たまま。 -->
            <dd>
              <input id="one-year" type="radio" name="contact_exp" value="<?php echo $_SESSION['contact_exp'] ?>"><label for="one-year">1年未満</label>
              <input id="three-year" type="radio" name="contact_exp" value="<?php echo $_SESSION['contact_exp'] ?>"><label for="three-year">3年未満</label>
              <input id="five-year" type="radio" name="contact_exp" value="<?php echo $_SESSION['contact_exp'] ?>"><label for="five-year">10年以上</label>
            </dd>
            <dt><label for="contact_mesg">お問合せ内容</label></dt>
            <dd><textarea id="contact_mesg" type="text" cols="40" rows="8" name="contact_mesg"><?php $_SESSION['contact_mesg'] ?></textarea></dd>
            <label class="form-label"></label>
            <textarea class="form-control" cols="40" rows="8" name="mesg"><? echo $_SESSION['contact_mesg'] ?></textarea>

          </dl>
          <div class="form-submit">
            <button id="submit" type="submit" name="submit">申し込む</button>
          </div>
        </form>
      </div>
    </section>
    <div class="form-visual">
      <img src="./assets/img/journey-1130732_1920.jpeg" alt="">
    </div>
  </main>
  <footer>
    <address>
      <span>写真道場</span><br>
      〒000-0000　大阪府〓〓〓〓〓〓〓〓〓〓<br>
      00-0000-0000<br>
    </address>
    <small>&copy; kumihan.com</small>
  </footer>
  <script src="https://kit.fontawesome.com/678cad97f5.js" crossorigin="anonymous"></script>
</body>

</html>