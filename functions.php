<?php
// connection.phpの設定したファイルを読み込み、使用可能になる
require('connection.php');
session_start();  // セッションをスタートさせる

// エスケープ処理
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");  //特殊文字をHTMLの表現形式に変換する、クォート文字をどちらも変換する
}

// sessionに暗号化したtokenを入れる
function setToken() {
  $token = sha1(uniqid(mt_rand(),true));  // sha1ハッシュを計算する、uniqidユニークなidを生成する、mt_rand乱数を発生させる
  $_SESSION['token'] = $token;  // $_SESSIONのtokenに変数tokenを代入する
}

// sessionのチェックを行いcsrf対策を行う
function checkToken($data) {
  if (empty($_SESSION['token']) || ($_SESSION['token'] != $data)){  // $_SESSIONのtokenが空か確かめる
    $_SESSION['err'] = '不正な操作です';
    header('location: '.$_SERVER['HTTP_REFERER'].'');  // 前に居たページに遷移する
    exit();  // headerlocation後、処理を終わらせるために行う
  }
  return true;  // trueを返す
}

function unsetSession() {
  if(!empty($_SESSION['err'])) $_SESSION['err'] = '';  // $_SESSIONのerrが空でなかったらそれを空にする
}

// 関数createを実行する
function create($data) {
  if(checkToken($data['token'])) {
  insertDb($data['todo']);  // 関数insertDbを引数$dataを持ってきた上で実行する
  }
}

// 全件取得
function index() {
  return $todos = selectAll();  // selectAll()関数を代入して返す
}

// 更新
function update($data) {
  if(checkToken($data['token'])){  // checkToken関数の引数に$dataのtokenを入れて実行結果が0でなかったら中の処理を行う
    updateDb($data['id'], $data['todo']);  // updateDb関数の引数に$dataのidとtodoを入れる
  }
}

function checkReferer() {
  $httpArr = parse_url($_SERVER['HTTP_REFERER']);  //ユーザーが前にいたurlを取得し変数に代入する
  return $res = transition($httpArr['path']);  //transition関数の引数にhttpArrのpathを入れて実行後変数に代入
}

function transition($path) {
  unsetSession();  // unsetSession();関数を実行する
  $data = $_POST;  // $_POSTの連想配列を変数に代入する
  if(isset($data['todo'])) $res = validate($data['todo']);  //$dataのtodoに変数が定義されて入れば$resに、validate関数を実行し戻り値を代入する
  if($path === '/index.php' && $data['type'] === 'delete') {
    deleteData($data['id']);  // deleteData関数の引数に$dataのidを含め実行する
    return 'index';  // 文字列indexを返す
  }elseif(!$res || !empty($_SESSION['err'])){  //$resではない、または$_SESSION['err']が空でない場合は
    return 'back';
  }elseif($path === '/new.php'){
    create($data);  // create関数の引数に$_POSTを入れて実行する
  }elseif($path === '/edit.php'){
    update($data);  // update関数の引数に$_POSTを入れて実行する
  }
}

// 詳細の取得
function detail($id) {
  return getSelectData($id);  // getSelectData関数を返す
}

function deleteData($id) {
  deleteDb($id);  // deleteDbの引数に$idを入れて実行する
}

function validate($data) {
  return $res = $data != "" ? true : $_SESSION['err'] = '入力がありません';  // $dataの中身があった場合true。なかった場合$_SESSION['err']を$resに代入する
}
?>