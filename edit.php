<?php
// functions.phpの設定したファイルを読み込み、一度だけ使用可能になる
require_once('functions.php');
$data = detail($_GET['id']);  // $_GET['id']でURLクエリのデータを取得しそれをdetail関数に渡す。変数$dataに戻り値を代入する
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集</title>
</head>
<body>
  <form action="store.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">  <!--$_GETで受け取った['id']を出力する-->
    <input type="text" name="todo" value="<?php echo $data ?>">  <!--$dataを出力する-->
    <input type="submit" value="更新">
  </form>
  <div>
    <a href="index.php">一覧へもどる</a>
  </div>
</body>
</html>