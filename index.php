<?php
// functions.phpの設定したファイルを読み込み、使用可能になる
  require('functions.php');
// unsetSession関数を実行
  unsetSession();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>
<body>
  welcome hello world
  <div>
     <a href="new.php">
       <p>新規作成</p>
     </a>
  </div>
  <div>
    <table>
      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      <?php foreach(index() as $todo): ?>  <!--繰り返し処理、index()の中から一個づつ取り出して$todoに入れる-->
        <tr>
          <td><?php echo h($todo['id']) ?></td>  <!--$todo配列のidを引数としたh関数の実行結果を出力-->
          <td><?php echo h($todo['todo']) ?></td>  <!--$todo配列のtodoを引数としたh関数の実行結果を出力-->
          <td>
            <a href="edit.php?id=<?php echo h($todo['id']) ?>">  <!--URLクエリをIDにくっつけて更新対象のデータが何であるかをPHP側に伝える-->更新</a>
          </td>
          <td>
            <form action="store.php" method="POST">
              <input type="hidden" name="id" value="<?php echo h($todo['id']) ?>">  <!--$todo配列のidを引数としたh関数の実行結果を出力-->
              <input type="hidden" name="type" value="delete">
              <button type="submit">削除</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>  <!--繰り返し処理を終了する-->
    </table>
  </div>
</body>
</html>