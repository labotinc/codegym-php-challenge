<?php

session_start();

//ログインしていない場合、login.phpを表示
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

//require('controller.php');
require_once('db.php');

/**
 * @param String $tweet_textarea
 * つぶやき投稿を行う。
 */
function newtweet($tweet_textarea)
{
    // 汎用ログインチェック処理をルータに作る。早期リターンで
    createTweet($tweet_textarea, $_SESSION['user_id']);
    //require_once('views/bbs.php');
}
/**
 * ログアウト処理を行う。
 */
function logout()
{
    $_SESSION = [];
    $msg = 'ログアウトしました。';
    //require_once('views/entrance.php');
}

if ($_POST) { /* POST Requests */
    // 新規ユーザ登録処理
    // if (isset($_POST['register_name'])) {
    //     register($_POST['register_name'], $_POST['register_password']);
    // ログイン処理
    // } else if (isset($_POST['login_name'])) {
    //     login($_POST['login_name'], $_POST['login_password']);
    // ログアウト処理
    //} else if (isset($_POST['logout'])) {
    if (isset($_POST['logout'])) {
        logout();
        header("Location: login.php");
    // 投稿処理
    } else if (isset($_POST['tweet_textarea'])) {
        newtweet($_POST['tweet_textarea']);
        header("Location: index.php");
    }
}

$tweets = getTweets();
$tweet_count = count($tweets);
/* 返信課題はここからのコードを修正しましょう。 */

/* 返信課題はここからのコードを修正しましょう。 */
?>

<!DOCTYPE html>
<html lang="ja">

<?php require_once('head.php'); ?>

<body>
  <div class="container">
    <h1 class="my-5">新規投稿</h1>
    <div class="card mb-3">
      <div class="card-body">
        <form method="POST">
          <textarea class="form-control" type=textarea name="tweet_textarea" ?><!-- 返信課題はここを修正しましょう。 --></textarea>
          <!-- 返信課題はここからのコードを修正しましょう。 -->
          <!-- 返信課題はここからのコードを修正しましょう。 -->
          <br>
          <input class="btn btn-primary" type=submit value="投稿">
        </form>
      </div>
    </div>
    <h1 class="my-5">コメント一覧</h1>
    <?php foreach ($tweets as $t) { ?>
      <div class="card mb-3">
        <div class="card-body">
          <p class="card-title"><b><?= "{$t['id']}" ?></b> <?= "{$t['name']}" ?> <small><?= "{$t['updated_at']}" ?></small></p>
          <p class="card-text"><?= "{$t['text']}" ?></p>
          <!--返信課題はここから修正しましょう。-->
          <a href=""><img class="retweet-image" src='/images/retweet-solid-blue.svg'> 2</a>
          <!--<a href=""><img class="retweet-image" src='/images/heart-solid-red.svg'></a>-->
          
          
          
          <?php if (isset($t['reply_id'])) { ?>
          <p>[返信する] <a href="/view.php?id=<?= "{$t['reply_id']}" ?>">[返信元のメッセージ]</a></p>
          <?php } ?>
          <!--返信課題はここまで修正しましょう。-->
        </div>
      </div>
    <?php } ?>
    <form method="POST">
      <input type="hidden" name="logout" value="dummy">
      <button class="btn btn-primary">ログアウト</button>
    </form>
    <br>
  </div>
</body>

</html>
