<?php
// functions.phpの設定したファイルを読み込み、使用可能になる
require('functions.php');

// functions.php内のcreate関数にPOSTデータを渡す
// create($_POST);
$res = checkReferer();  // 関数の実行後代入
if($res != 'back') {
  header('location: ./index.php');
}elseif($res == 'index') {
  header('location: ./index.php');  // index.phpに遷移
}else {
  header('location: '.$_SERVER['HTTP_REFERER'].'');  // 前に居たページに遷移
}
?>