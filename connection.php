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

// データ全件取得
function selectAll() {
  $dbh = connectPdo();  // DBへの接続、PDOのインスタンスを代入する
  $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';  // 変数にSQL命令を代入する、(論理)削除をしていない全件のデータを取得する
  $todo = array();  // 新規に配列を生成初期化して変数に代入する
  foreach($dbh->query($sql) as $row) {  //$dbhに対してquery(問い合わせ)を行い、$sqlでデータを取得したところでそれを$rowに入れる
    array_push($todo, $row);  // $todo配列の最後にに$rowを追加する
  }
  return $todo;  // 変数$todoを返す
}

// 詳細取得
function getSelectData($id) {
  $dbh = connectPdo();  // DBへの接続、PDOのインスタンスを代入する
  $sql = 'SELECT todo FROM todos WHERE id = :id AND deleted_at IS NULL';
  // 変数にSQL命令を代入する、(論理)削除をしていないtodoのデータを取得する
  $stmt = $dbh->prepare($sql);  // prepareは値部分にパラメータを付けて実行待ち
  $stmt->execute(array(':id' => (int)$id));  // SQL命令を実行する (int)は$idを整数値に変換する
  $data = $stmt->fetch();  // 結果セットから次の行を取得する
  return $data['todo'];  // $data配列のtodoを返す
}

// 新規作成 insertDb関数の引数に$data持ってくる
function insertDb($data) {
  $dbh = connectPdo();  // DBへの接続、PDOのインスタンスを代入する
  $sql = 'INSERT INTO todos (todo) VALUES (:todo)';
  // 変数にSQL命令を代入する、:todoは$stmt->bindParam() で渡ってきたデータを渡す
  $stmt = $dbh->prepare($sql);  // prepareは値部分にパラメータを付けて実行待ち
  $stmt->bindParam(':todo', $data, PDO::PARAM_STR);  // (対象となる文字列(:name形式のパラメータ名)、保存したい値(変数名)、PDOで保存対象データの型を指定(今回は文字列))
  $stmt->execute();  // SQL命令を実行する
}

// 更新処理
function updateDb($id, $data) {
  $dbh = connectPdo();  // DBへの接続、PDOのインスタンスを代入する
  $sql = 'UPDATE todos SET todo = :todo WHERE id = :id';
  // UPDATE table名 SET カラム名 = 格納する値 WHERE カラム名 = 値
  // 変数にSQL命令を代入する、:todoは$stmt->bindParam() で渡ってきたデータを渡す
  $stmt = $dbh->prepare($sql);  // prepareは値部分にパラメータを付けて実行待ち
  $stmt->bindParam(':todo', $data, PDO::PARAM_STR);  // (対象となる文字列(:name形式のパラメータ名)、保存したい値(変数名)、PDOで保存対象データの型を指定(今回は文字列))
  $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);  // (対象となる文字列(:name形式のパラメータ名)、保存したい値(変数名)、PDOで保存対象データの型を指定(今回は文字列))未定義の配列を指定するとエラーが出る
  $stmt->execute();  // SQL命令を実行する
}
?>