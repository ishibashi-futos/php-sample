<?php

$authorized = true;

if($authorized) {
  try {
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
    // fileStreamをclose
    fclose($workScheduleFile);
  
    $isFirst = true;
    foreach($resultArray as $key => $value) {
      if($isFirst) {
        // 最初は頭から書き込み
        file_put_contents($woskSchedulePath, "{$key},{$value}\n",LOCK_EX);
        $isFirst = false;
      } else {
        // つぎから追記
        file_put_contents($woskSchedulePath, "{$key},{$value}\n",FILE_APPEND | LOCK_EX);
      }
    }
    http_response_code(201);
  } catch(Exception $e) {
    $data = $e;
    http_response_code(500);
    echo json_encode(compact('data'));
  }
}

?>