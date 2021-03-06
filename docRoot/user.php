<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>完了報告</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="js/user.js"></script>
    <script src="js/common.js"></script>
    <style>
    </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th class="col-xs-6 col-md-6">実施予定日</th>
                <th class="col-xs-2 col-md-2">曜日</th>
                <th class="col-xs-4 col-md-4">完了</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $now = new DateTime();
                // 設定ファイルから基準日を取得する
                $refDate = '';
                $refFile = fopen('./conf/refDate.ini', 'r');
                if($refFile) {
                  $refDate = new DateTime(rtrim(fgets($refFile), "\r"));
                }
                // 曜日を定義する
                $arrays = array(
                  0 => "月",
                  1 => "火",
                  2 => "水",
                  3 => "木",
                  4 => "金",
                  5 => "土",
                  6 => "日"
                );
                // 作業が必要な日、完了(1)/未完了(0)をファイルから取得する
                $workScheduleFile = fopen('./data/workSchedule.csv', 'r');
                $schedule = array();
                if($workScheduleFile) {
                  while($line = fgets($workScheduleFile)) {
                    $lines = explode(",", rtrim($line, "\r\n"));
                    $schedule += array($lines[0]=>$lines[1]); 
                  }
                }
                foreach($arrays as $key => $value) {
                  print "<tr>";
                  print "<td>{$refDate->format('Y年m月d日')}</td>";
                  print "<td>{$value}</td>";
                  // master情報に応じて、ボタンの表示、非表示を制御
                  if($schedule[$key] == "0"){
                    print "<td><button class='btn btn-sm btn-primary btn-block' type='button' onClick='doneWork({$key});'>未完了</button></td>";
                  } else if($schedule[$key] == "1") {
                    print "<td><button class='btn btn-sm btn-success btn-block' type='button' disabled='disabled' >完了</button></td>";
                  } else {
                    print "<td><button class='btn btn-sm btn-default btn-block' type='button' disabled='disabled' >OFF</button></td>";
                  }
                  print "</tr>";
                  $refDate->modify('+1 days');
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
