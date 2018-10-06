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
  $woskSchedulePath = "../data/workSchedule.csv";
  $workScheduleFile = fopen($woskSchedulePath, 'r');
  $resultArray = array();
  if($workScheduleFile) {
    while($line = fgets($workScheduleFile)) {
      $line = rtrim($line, "\n");
      $lines = explode(',', $line);
      // 読込が完了したデータのうち、weekにマッチする行のステータスを1(終了)に書き換える.
      if($lines[0] == $week) {
        $resultArray += array($lines[0]=>1);
      } else {
        $resultArray += array($lines[0]=>$lines[1]);
      }
    }
  }
  fclose($workScheduleFile);

  foreach($resultArray as $key => $value) {
    file_put_contents($woskSchedulePath, "{$key},{$value}\n",LOCK_EX);
  }
}

?>