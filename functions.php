<?php
// connection.phpの設定したファイルを読み込み、使用可能になる
require('connection.php');

// 関数createを実行する
function create($data) {
  insertDb($data['todo']);  // 関数insertDbを引数$dataを持ってきた上で実行する
}
?>