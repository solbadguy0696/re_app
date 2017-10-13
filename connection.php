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

// insertDb関数の引数に$data持ってくる
function insertDb($data) {
  $dbh = connectPdo();  // DBへの接続、PDOのインスタンスを代入する
  $sql = 'INSERT INTO todos (todo) VALUES (:todo)';
  // 変数にSQL命令を代入する、:todoは$stmt->bindParam() で渡ってきたデータを渡す
  $stmt = $dbh->prepare($sql);  // prepareは値部分にパラメータを付けて実行待ち
  $stmt->bindParam(':todo', $data, PDO::PARAM_STR);  // (対象となる文字列(:neme形式のパラメータ名)、保存したい値(変数名)、PDOで保存対象データの型を指定(今回は文字列))
  $stmt->execute();  // SQL命令を実行する
}
?>