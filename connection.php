<?php
// config.phpの設定したファイルを一度だけ読み込み、使用可能になる
require_once('config.php');

// DB接続設定
function connectPdo() {
  try{  // 試す
    return new PDO(DSN,DB_USER,DB_PASSWORD);  // インスタンスの作成をし返す
  } catch (PDOException $e) {  // PDOException,エラー(例外)を掴む
    echo $e->getMessage();  // $eが例外メッセージを取得し出力する
    exit;  // 終わりにする
  }
}
?>