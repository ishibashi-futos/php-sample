<?php
// ヘッダから認証キーをチェック.
$authKey = isset($_SERVER["HTTP_AUTHKEY"]) ? $_SERVER["HTTP_AUTHKEY"] : null;
$authorized = false;


if($authKey) {
  $authKeys = base64_decode($authKey);
  $authKeys = explode(',', $authKeys);
  // authKeyがuserでもadminでもない場合
  if(!$authKeys[2] == "admin") {
    http_response_code(401);
  } else {
    $authorized = true;
  }
} else {
  http_response_code(401);
}

if($authorized) {
  try {
    // workSchedule.csvを更新する
    $workScheduleData = array();
    $workScheduleData += array('0'=>"{$_POST[0]}");
    $workScheduleData += array('1'=>"{$_POST[1]}");
    $workScheduleData += array('2'=>"{$_POST[2]}");
    $workScheduleData += array('3'=>"{$_POST[3]}");
    $workScheduleData += array('4'=>"{$_POST[4]}");
    $workScheduleData += array('5'=>"{$_POST[5]}");
    $workScheduleData += array('6'=>"{$_POST[6]}");

    $woskSchedulePath = "../data/workSchedule.csv";
    $workScheduleFile = fopen($woskSchedulePath, 'r');
    $resultArray = array();
    if($workScheduleFile) {
      while($line = fgets($workScheduleFile)) {
        $line = rtrim($line, "\n");
        $lines = explode(',', $line);
        // 読込が完了したデータのうち、weekにマッチする行のステータスを1(終了)に書き換える.
        if($workScheduleData[$lines[0]] == "1") {
          if($lines[1]=="1" || $lines[1]=="0") {
            // すでに有効行の場合は、更新しない
            $resultArray += array($lines[0]=>$lines[1]);
          } else {
            // 無効行の時はフラグを立てる
            $resultArray += array($lines[0]=>"0");
          }
        } else {
          $resultArray += array($lines[0]=>"-");
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
    // alertControlを更新する
    $alertControlFilePath = "../data/alertControl.ini";
    if($_POST["checked"]) {
      $confData = fopen($alertControlFilePath, 'r');
      $alertControlFlag = 1;
      $alertControlDate = "";
      if($confData) {
        while($line = fgets($confData)) {
          $lines = explode("=", rtrim($line, "\r\n"));
          if($lines[0] == "alertControl") {
            $alertControlFlag = "1";
          } else if ($lines[0] == "refDate") {
            $alertControlDate = $_POST["calender"];
          }
        }
      }
      fclose($confData);
      // 加工
      $alertControlDate = str_replace('年', '-', $alertControlDate);
      $alertControlDate = str_replace('月', '-', $alertControlDate);
      $alertControlDate = str_replace('日', '', $alertControlDate);
      $alertControlDate = new DateTime($alertControlDate);
      file_put_contents($alertControlFilePath, "refDate={$alertControlDate->format('Ymd')}\n", LOCK_EX);
      file_put_contents($alertControlFilePath, "alertControl={$alertControlFlag}\n", FILE_APPEND | LOCK_EX);
    } else {
      $confData = fopen($alertControlFilePath, 'r');
      $alertControlFlag = 1;
      $alertControlDate = "";
      if($confData) {
        while($line = fgets($confData)) {
          $lines = explode("=", rtrim($line, "\r\n"));
          if($lines[0] == "alertControl") {
            $alertControlFlag = "0";
          } else if ($lines[0] == "refDate") {
            $alertControlDate = $lines[1];
          }
        }
      }
      fclose($confData);
      file_put_contents($alertControlFilePath, "refDate={$alertControlDate}\n", LOCK_EX);
      file_put_contents($alertControlFilePath, "alertControl={$alertControlFlag}\n", FILE_APPEND | LOCK_EX);
    }

    http_response_code(201);
  } catch(Exception $e) {
    $data = $e;
    http_response_code(500);
    echo json_encode(compact('data'));
  }
}


?>