<?php
// functions.phpの設定したファイルを読み込み、一度だけ使用可能になる
require_once('functions.php');
setToken();  // setToken関数を実行する
$data = detail($_GET['id']);  // $_GET['id']でURLクエリのデータを取得しそれをdetail関数に渡す。変数$dataに戻り値を代入する
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集</title>
</head>
<body>
  <?php if(isset($_SESSION['err'])): ?>
    <p><?php echo $_SESSION['err'] ?></p>
  <?php endif; ?>
  <form action="store.php" method="post">  <!--store.phpに遷移-->
    <input type="hidden" name="token" value="<?php echo h($_SESSION['token']);?>">  <!--$_SESSIONのtokenを引数にh関数を出力-->
    <input type="hidden" name="id" value="<?php echo h($_GET['id']) ?>">  <!--$_GETで受け取った['id']を出力する-->
    <input type="text" name="todo" value="<?php echo h($data) ?>">  <!--$dataを出力する-->
    <input type="submit" value="更新">
  </form>
  <div>
    <a href="index.php">一覧へもどる</a>
  </div>
  <?php unsetSession(); ?>  <!--unsetSession関数の実行-->
</body>
</html>