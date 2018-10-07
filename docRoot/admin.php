<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>作業スケジュール管理</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- DatePicker -->
    <script src="bootstrap-datepicker/bootstrap-datepicker.ja.min.js"></script>
    <script src="bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/common.js"></script>
    <link rel="stylesheet" href="bootstrap-datepicker/bootstrap-datepicker.min.css">
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
                <th class="col-md-6 col-xs-6">実施曜日</th>
                <th class="col-md-6 col-xs-6">実行制御</th>
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
                  print "<td>{$value}</td>";
                  print "<td><select class='selector form-control' name='work{$key}' style='width: 75px'>";
                  if($value == "1") {
                    print "<option value='0'>無効</option>";
                    print "<option value='1' selected='selected'>有効</option>";
                  } else {
                    print "<option value='0' selected='selected'>無効</option>";
                    print "<option value='1'>有効</option>";
                  }
                  print "</select></td>";
                  print "</tr>";
                  $refDate->modify('+1 days');
                }
              ?>
            </tbody>
          </table>
          <div class="form-group" id="datepicker-default">
            <label class="col-sm-3 control-label">Default</label>
            <div class="col-sm-9 form-inline">
              <div class="input-group date">
                <input type="text" class="form-control" value="20170621">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
