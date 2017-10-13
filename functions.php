<?php
// connection.phpの設定したファイルを読み込み、使用可能になる
require('connection.php');

// 関数createを実行する
function create($data) {
  insertDb($data['todo']);  // 関数insertDbを引数$dataを持ってきた上で実行する
}

// 全件取得
function index() {
  return $todos = selectAll();  // selectAll()関数を代入して返す
}

// 更新
function update($data) {
  updateDb($data['id'], $data['todo']);  // updateDb関数の引数に$dataのidとtodoを入れる
}

function checkReferer() {
  $httpArr = parse_url($_SERVER['HTTP_REFERER']);  //ユーザーが前にいたurlを取得し変数に代入する
  return $res = transition($httpArr['path']);  //transition関数の引数にhttpArrのpathを入れて実行後変数に代入
}

function transition($path) {
  $data = $_POST;
 if($path === '/new.php'){
    create($data);
  }elseif($path === '/edit.php'){
    update($data);
  }
}

// 詳細の取得
function detail($id) {
  return getSelectData($id);  // getSelectData関数を返す
}
?>