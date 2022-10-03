<?php
require_once('../../tmp/conf.php');
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
  $data = array();
  $err_mesg = array();
  try {
    $sql = "SELECT * FROM `member` WHERE `email` = :email LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $profile = $stmt->fetch(PDO::FETCH_ASSOC);
      // 発信者のフルネームを変数に格納する。
      $full_name = $profile['last_name'] . $profile['first_name'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $comment = get_post('comment');
  
      if (!check_words($comment, 2000)) {
        $err_mesg[] = 'コメント欄を修正してください。';
      }
      // DBにコメントを追加していく。
      if (count($err_mesg) === 0) {
        insert_comment($dbh, $full_name, $comment);
      }
    }

    // ここで生成された$data、
    // つまり、現状のDBの状態を連想配列に変換した変数が
    // 『view.php』を含める・組み込む（include）と命令することで、
    // インスタンが該当ファイルへ渡っていく。素敵だ。
    $data = all_select_comments($dbh);

  } catch (PDOException $e) {
    echo ("Eメールアドレスからの接続でエラー発生" . $e->getMessage());
    die();
  }
}

include_once('./board_view.php');

