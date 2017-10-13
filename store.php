<?php
// functions.phpの設定したファイルを読み込み、使用可能になる
require('functions.php');

// functions.php内のcreate関数にPOSTデータを渡す
create($_POST);
?>