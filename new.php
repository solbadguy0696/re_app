<?php
// functions.phpの設定したファイルを一度だけ読み込み、使用可能になる
require_once('functions.php');
setToken();  // setToken();関数を実行
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規作成</title>
</head>
<body>
  <?php if(isset($_SESSION['err'])): ?>  <!--$_SESSIONのerrに変数が入っているかチェックして、入って居ないなら$_SESSIONのerrを出力-->
    <p><?php echo $_SESSION['err'] ?></p>
  <?php endif; ?>
  <form action="store.php" method="post">  <!--store.phpに遷移する-->
    <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
    <input type="text" name="todo">
    <input type="submit" value="作成">
  </form>
  <div>
    <a href="index.php">一覧へもどる</a>  <!--トップページに戻る-->
  </div>
  <?php unsetSession(); ?>
</body>
</html>