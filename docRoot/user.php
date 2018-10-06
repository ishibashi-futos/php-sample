<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>完了報告</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                <th class="col-md-6">実施予定日</th>
                <th class="col-md-3">曜日</th>
                <th class="col-md-3">完了</th>
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
                $workScheduleFile = fopen('workSchedule.csv', 'r');
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
                    print "<td><button class='btn btn-sm btn-primary btn-block' type='submit'>完了</button></td>";
                  } else if($schedule[$key] == "1") {
                    print "<td><span class='label label-success'>完了</span></td>";
                  } else {
                    print "<td><span class='label label-default'>-</span></td>";
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
