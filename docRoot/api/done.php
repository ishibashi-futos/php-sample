<?php

// ヘッダから認証キーをチェック.
$authKey = isset($_SERVER["HTTP_AUTHKEY"]) ? $_SERVER["HTTP_AUTHKEY"] : null;
$authorized = false;


if($authKey) {
  $authKeys = base64_decode($authKey);
  $authKeys = explode(',', $authKeys);
  // authKeyがuserでもadminでもない場合
  if(!$authKeys[2] == "user" || !$authKeys[2] == "admin") {
    http_response_code(401);
  } else {
    $authorized = true;
  }
} else {
  http_response_code(401);
}

if($authorized) {
  $week = isset($_POST["week"]) ? $_POST["week"] : null;
  var_dump($week);
}

?>